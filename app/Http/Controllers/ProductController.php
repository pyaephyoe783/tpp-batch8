<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRespository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Products\ProductService;

class ProductController extends Controller
{
    protected $ProductRespository;
    protected $CategoryReposittory;
    protected $ProductService;

    public function __construct(ProductRepositoryInterface $ProductRespository,CategoryRepositoryInterface $CategoryRepository ,ProductService $ProductService)
    {
        $this->ProductRespository = $ProductRespository;
        $this->CategoryReposittory = $CategoryRepository;
        $this->ProductService = $ProductService;
        $this->middleware('auth');

    }

    public function index()
    {
        $products = $this->ProductRespository->index();
        return view('products.index', compact('products'));

        // $products = Product::with('category')->get();


    }

    public function show($id)
    {
        $product = $this->ProductRespository->show($id);

        if (!$product) {
            abort(404, 'Product nottt found');
        }

        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {

        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'status' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('ProductsImage'), $imageName);

            // dd($imageName);

        }

        $this->ProductRespository->store($data);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->ProductRespository->show($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request)
    {
        $validateData = $request->validated();

        $validateData['status'] = $request->has('status') ? 1 : 0;

        $category = $this->ProductRespository->update($request->id, $validateData);

        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        $product = $this->ProductRespository->delete($id);
        return redirect()->route('products.index')->with('delete success');
    }

    public function status($id)
    {
        $this->ProductService->status($id);

        return redirect()->route('products.index');
    }
}
