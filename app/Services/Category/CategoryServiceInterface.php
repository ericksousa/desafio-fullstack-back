<?php

namespace App\Services\Category;

interface CategoryServiceInterface
{
    public function all();
    public function store(array $data);
}
