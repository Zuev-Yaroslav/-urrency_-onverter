<?php

namespace App\Console\Commands;

use App\HttpClients\CurrencyHttpClient;
use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencies = CurrencyHttpClient::make()->index();
    }
}
