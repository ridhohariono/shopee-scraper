<?php

namespace App\Jobs\DataScraping;

use App\Jobs\InsertProduct;
use App\Models\Product;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopeeProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $BASE_URL = "https://shopee.co.id/";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Scrape shopee product');
        $req = True;
        $limit = 10;
        $newest = 0;
        Log::info('Scrape using keyword: ' . $this->keyword);
        while ($req == True) {
            $result = [];
            $endpoint = $this->search_products_endpoint([
                'keyword' => $this->keyword,
                'limit' => $limit,
                'newest' => $newest
            ]);
            Log::info('Using limit: ' . $limit . ' newest: ' . $newest);
            // Get json response from shopee search products endpoint
            $response = Http::get($endpoint)->json();
            if ($response['items'] != null) {
                foreach ($response["items"] as $all_item) {
                    $item = $all_item["item_basic"];
                    $data = [
                        "title" => $item["name"],
                        "url" => $this->parse_store_url($item["name"], $item["shopid"], $item["itemid"]),
                        "state" => $item["shop_location"],
                        "seller_name" => $this->get_store_name($item["shopid"]),
                        "price" => $item["price"],
                        "created_at" =>  NOW(),
                        "updated_at" => NOW(),
                    ];
                    $result[] = $data;
                }
                Log::info('Storing (' . count($result) . ') products into databse');
                // Register instert query to queue
                dispatch(new InsertProduct($result))->delay(10);
                if ($newest > 10) {
                    $req = false;
                }
                // Update newest value
                $newest += $limit;
            } else {
                $req = False;
            }
        }
    }

    /**
     * generate shopee product url
     *
     * @param [array] $config
     * @return void
     */
    private function search_products_endpoint($config)
    {
        $URL = $this->BASE_URL . "api/v4/search/search_items?by=relevancy&keyword={$config['keyword']}&limit={$config['limit']}&newest={$config['newest']}&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2";
        return $URL;
    }

    /**
     * Get store info using api call
     *
     * @param [int] $shopID
     * @return void
     */
    private function get_store_name($shopID)
    {
        $URL = $this->BASE_URL . "api/v4/product/get_shop_info?shopid={$shopID}";
        $response = Http::get($URL)->json();
        if ($response["data"]) {
            return $response["data"]["name"];
        }
        return null;
    }

    // Generate store url from store name
    private function parse_store_url($store_name, $shopID, $itemID)
    {
        $url = str_replace('/', '-', str_replace(' ', '-', $store_name)); // Replaces all spaces with hyphens.
        return $this->BASE_URL . preg_replace('/[^A-Za-z0-9\-\.]/', '', $url) . "-i.{$shopID}.{$itemID}"; // Removes special chars.
    }
}