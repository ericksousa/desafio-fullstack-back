<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryService implements CategoryServiceInterface
{
    public function all()
    {
        return Category::all();
    }

    public function store(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Category::create($data);
    }
}
