<?php

namespace App\Console\Commands;

use App\Http\Controllers\CurrencyController;
use Illuminate\Console\Command;

class UpdateCurrencyAndGold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    /**
     * The console command description.
     *
     * @var string
     */


    /**
     * Execute the console command.
     */
    protected $signature = 'currency:update-daily';
    protected $description = 'Update currency rates and gold prices daily';

    public function handle()
    {
        $controller = new CurrencyController();

        // Döviz kurlarını güncelle
        $controller->updateCurrencies();

        // Altın fiyatlarını güncelle
        $controller->getGoldPrice();

        $this->info('Currency and gold prices updated successfully.');
    }
}
