<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller


{
   protected $categoryRepo;


    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
            $this->categoryRepo = $categoryRepo;
            $this->middleware('auth');
    }


    public function index()
    {
      $categories = $this->categoryRepo->index();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest  $request)
    {


        $data = $request->validate([
            'name' => 'required|string',
            'image' => 'required',
        ]);

        if($request->hasFile('image'))
        {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('categoryImage'),$imageName);

            $data = array_merge($data, ['image' => $imageName]);

        }

        $this->categoryRepo->store($data);
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = $this->categoryRepo->show($id);

        return view('categories.show',compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->show($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        $validateData = $request->validated();

       $category = $this->categoryRepo->update($request->id, $validateData);

        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $cateory = $this->categoryRepo->destory($id);

        return redirect()->route('categories.index');
    }
}
