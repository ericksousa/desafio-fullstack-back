<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Cache;
use App\Enums\CacheKeyEnum;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Cache::rememberForever(CacheKeyEnum::Products->value, function () {
            return Product::with('category')->get();
        });

        return $this->sendResponse(ProductResource::collection($products), 'Busca realizada com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->all();

        $validator = Validator::make($payload, [
            'name' => 'required|unique:products',
            'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('VALIDATION_ERROR', $validator->errors());
        }

        $product = Product::create($payload);

        return $this->sendResponse(new ProductResource($product), 'Produto cadastrado com sucesso');
    }
}
