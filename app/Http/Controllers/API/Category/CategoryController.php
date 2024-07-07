<?php

namespace App\Http\Controllers\API\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\CategoryResource;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Validation\ValidationException;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->all();

        return $this->sendResponse(CategoryResource::collection($categories), 'Busca realizada com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $category = $this->categoryService->store($request->all());
            return $this->sendResponse($category, 'Categoria cadastrada com sucesso');
        } catch (ValidationException $e) {
            return $this->sendError('VALIDATION_ERROR', $e->errors());
        }
    }
}
