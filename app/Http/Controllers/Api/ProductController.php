<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\DataScraping\ShopeeProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Index will show products list
     * Use limit as query params to increase limit list
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $limit = $request->limit && $request->limit <= 100 ? $request->limit : 20;
        $data = Product::paginate($limit);
        return $this->data(200, false, $data);
    }

    /**
     * Get keyword as array and register keyword to scraper job
     *
     * @param Request $request
     * @return void
     */
    public function scrape(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keywords' => 'required|array',
        ]);
        if ($validator->fails()) {
            return $this->message(400, true, $validator->errors());
        }
        foreach ($request->keywords as $keyword) {
            dispatch(new ShopeeProduct($keyword));
        }
        return $this->message(200, false, "keywords are successfully registered in Queue");
    }

    private function message($code, $error, $message)
    {
        return response()->json(["status" => $code, "error" => $error, "message" => $message]);
    }

    private function data($code, $error, $data)
    {
        return response()->json(["status" => $code, "error" => $error, "items" => $data]);
    }
}