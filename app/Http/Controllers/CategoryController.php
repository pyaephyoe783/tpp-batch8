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
    }


    public function index()
    {
        // $categories = Category::all();
        // dd($categories);

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

        }

        $this->categoryRepo->store($data);
        return redirect()->route('categories.index');

        // Category::create([

        //     'name' => $request -> name,
        //     'image' => $imageName,
        // ]);
           // Category::create($request->validated());
           // $data = $request->validate([
        //     'name'=> 'required|string',
        //     'image' => 'required',
        // ]);
    }

    public function show($id)
    {
        $category = $this->categoryRepo->show($id);

        return view('categories.show',compact('category'));
    }

    public function edit($id)
    {
        // dd($id);
        $category = $this->categoryRepo->show($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        // dd($request->all());
        // $category = Category::find($request->id);

        $validateData = $request->validated();

       $category = $this->categoryRepo->update($request->id, $validateData);

        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        // dd('here');
        // dd($id);
        // $category = Category::find($id);
        // $category->delete();


        $cateory = $this->categoryRepo->destory($id);

        return redirect()->route('categories.index');
        // dd($category);
    }
}
