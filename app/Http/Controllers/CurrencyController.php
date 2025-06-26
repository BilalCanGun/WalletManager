<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::get()->all();
        return view('pages.currencies', compact('currencies'));
    }
    public function updateCurrencies()
    {
        $apiKey = env('EXCHANGE_API_KEY');
        $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD";
        $response = Http::get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'API request failed'], 500);
        }

        $data = $response->json();

        if ($data['result'] !== 'success') {
            return response()->json(['error' => 'API result not success'], 400);
        }

        $rates = $data['conversion_rates'];

        $wantedCurrencies = [
            'USD',
            'EUR',
            'JPY',
            'GBP',
            'CHF',
            'CNY',
            'AUD',
            'CAD',
            'HKD',
            'NZD',
            'SEK',
            'NOK',
            'SGD',
            'KRW',
            'INR',
            'RUB',
            'TRY',
            'MXN',
            'BRL',
            'ZAR'
        ];

        $names = [
            'USD' => 'Amerikan Doları',
            'EUR' => 'Euro',
            'JPY' => 'Japon Yeni',
            'GBP' => 'İngiliz Sterlini',
            'CHF' => 'İsviçre Frangı',
            'CNY' => 'Çin Yuanı',
            'AUD' => 'Avustralya Doları',
            'CAD' => 'Kanada Doları',
            'HKD' => 'Hong Kong Doları',
            'NZD' => 'Yeni Zelanda Doları',
            'SEK' => 'İsveç Kronu',
            'NOK' => 'Norveç Kronu',
            'SGD' => 'Singapur Doları',
            'KRW' => 'Güney Kore Wonu',
            'INR' => 'Hindistan Rupisi',
            'RUB' => 'Rus Rublesi',
            'TRY' => 'Türk Lirası',
            'MXN' => 'Meksika Pesosu',
            'BRL' => 'Brezilya Reali',
            'ZAR' => 'Güney Afrika Randı',
        ];

        foreach ($wantedCurrencies as $code) {
            if (isset($rates[$code])) {
                $rateInTRY = $rates[$code];
                $currencyName = $names[$code] ?? 'Bilinmeyen';

                Currency::updateOrCreate(
                    ['code' => $code],
                    ['name' => $currencyName, 'usd_rate' => $rateInTRY]
                );
            }
        }

        return response()->json(['message' => 'Secilen para birimleri basariyla güncellendi.']);
    }

    public function getGoldPrice()
    {
        $apiKey = env('GOLD_API_KEY');
        $url = 'https://www.goldapi.io/api/XAU/USD'; // Dolar cinsinden veri

        $response = Http::withHeaders([
            'x-access-token' => $apiKey,
            'Content-Type' => 'application/json'
        ])->get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'API erişimi başarısız'], 500);
        }

        $data = $response->json();

        $onsAltinUSD = $data['price']; // 1 ons altın USD cinsinden
        $gramAltinUSD = $onsAltinUSD / 31.1035;

        // Ortalama işçilik değerleri USD olarak tahmini verildi
        $ceyrekAltinUSD = ($gramAltinUSD * 1.75) + 5.5;
        $yarimAltinUSD = ($gramAltinUSD * 3.5) + 7.5;
        $tamAltinUSD   = ($gramAltinUSD * 7) + 10.0;

        // Veritabanına kaydet (USD cinsinden)
        $this->saveOrUpdateGoldCurrency('XAU-ONS', 'Ons Altın', $onsAltinUSD);
        $this->saveOrUpdateGoldCurrency('XAU-GRAM', 'Gram Altın', $gramAltinUSD);
        $this->saveOrUpdateGoldCurrency('XAU-CEYREK', 'Çeyrek Altın', $ceyrekAltinUSD);
        $this->saveOrUpdateGoldCurrency('XAU-YARIM', 'Yarım Altın', $yarimAltinUSD);
        $this->saveOrUpdateGoldCurrency('XAU-TAM', 'Tam Altın', $tamAltinUSD);

        return response()->json([
            'ons_altin_usd'   => round($onsAltinUSD, 2),
            'gram_altin_usd'  => round($gramAltinUSD, 2),
            'ceyrek_altin_usd' => round($ceyrekAltinUSD, 2),
            'yarim_altin_usd' => round($yarimAltinUSD, 2),
            'tam_altin_usd'   => round($tamAltinUSD, 2)
        ]);
    }
    private function saveOrUpdateGoldCurrency($code, $name, $usdValue)
    {
        Currency::updateOrCreate(
            ['code' => $code],
            [
                'name' => $name,
                'usd_rate' => round($usdValue, 2) // burada try_rate yerine usd saklıyoruz
            ]
        );
    }
}
