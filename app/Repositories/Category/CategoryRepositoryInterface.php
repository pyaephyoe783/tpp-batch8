<?php

namespace App\Repositories\Category;


interface CategoryRepositoryInterface
{
    public function index();
    public function store($data);
    public function show($id);
    public function update($id,$data);
    public function destory($id);
}
