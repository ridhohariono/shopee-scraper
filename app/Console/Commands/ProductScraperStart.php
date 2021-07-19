<?php

namespace App\Console\Commands;

use App\Jobs\DataScraping\ShopeeProduct;
use Illuminate\Console\Command;

class ProductScraperStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:scrape {keyword*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start scraper for shopee product (use --keyword argument ex: product:scrape "keyword1" "keyword2")';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $keywords = $this->argument("keyword");
        foreach ($keywords as $keyword) {
            ShopeeProduct::dispatch($keyword)->onQueue('scrape')->delay(10);
        }
        return 0;
    }
}