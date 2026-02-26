<?php


namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;



class CategoryRespository implements CategoryRepositoryInterface
{

    public function index()
    {
        return Category::all();
    }

    public function store($data)
    {
        return Category::create($data);
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update($id,$data)
    {
        $category = $this->show($id);
        $category->update($data);

        return $category;
    }

    public function destory($id)
    {
        $category = $this->show($id);
        $category->delete($id);
        return $category;
    }



}






