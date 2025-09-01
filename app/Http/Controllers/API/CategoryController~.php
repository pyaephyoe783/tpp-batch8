<?php

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        try{
            $categories = $this->categoryRepository->index();
            return $this->success($categories,"Categoris List", 200);
        } catch(Exception $e){
            return $this->error("Something Went Wrong", null , 500);
        }
    }

    public function show($id)
    {
        try {
            $category = $this->categoryRepository->show($id);
            return $this->success($category, "Category Detail", 200);
        } catch (Exception $e) {
            return $this->error("Category not found", null, 404);
        }
    }

     public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|unique:categories,name',
                'description' => 'nullable',
                'status' => 'boolean',
            ]);

            if ($validation->fails()) {
                return $this->error("Validation Error", $validation->errors(), 422);
            }

            $category = $this->categoryRepository->store($request->all());
            return $this->success($category, "Category Created Successfully", 201);

        } catch (Exception $e) {
            return $this->error("Something went wrong", null, 500);
        }
    }

    // GET /api/categories/{id}


    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|unique:categories,name,'.$id,
                'description' => 'nullable',
                'status' => 'boolean',
            ]);

            if ($validation->fails()) {
                return $this->error("Validation Error", $validation->errors(), 422);
            }

            $category = $this->categoryRepository->update($id, $request->all());
            return $this->success($category, "Category Updated Successfully", 200);

        } catch (Exception $e) {
            return $this->error("Category not found or error occurred", null, 500);
        }
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        try {
            $this->categoryRepository->destory($id);
            return $this->success(null, "Category Deleted Successfully", 200);
        } catch (Exception $e) {
            return $this->error("Category not found", null, 404);
        }
    }
}
