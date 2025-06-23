<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
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
                    ['name' => $currencyName, 'try_rate' => $rateInTRY]
                );
            }
        }

        return response()->json(['message' => 'Seçilen para birimleri başarıyla güncellendi.']);
    }
}
