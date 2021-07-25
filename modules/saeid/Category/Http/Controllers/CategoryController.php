<?php

namespace saeid\Category\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use saeid\Category\Http\Requests\categoryRequest;
use saeid\Category\Model\Category;
use saeid\Category\Repositories\CategoryRepo;

class CategoryController extends Controller
{
    public $repo;
    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repo=$categoryRepo;
    }

    public function index(CategoryRepo $categoryRepo)
    {

        $this->authorize('index',\saeid\Category\Model\Category::class);
        $categories=$this->repo->all();

        return view('Category::index',compact('categories'));
    }
    public function store(categoryRequest $request)
    {
        $this->authorize('edit',\saeid\Category\Model\Category::class);
        $this->repo->store($request);
        return back();
    }
    public function edit($categoryId)
    {
        $this->authorize('edit',\saeid\Category\Model\Category::class);
        $category=$this->repo->findById($categoryId);
        $categories=$this->repo->allExpectId($categoryId);
        return view('Category::edit',compact('category','categories'));
    }
    public function update($categoryId,categoryRequest $request)
    {
        $this->authorize('edit',\saeid\Category\Model\Category::class);
        $this->repo->update($categoryId,$request);
        return back();
    }
    public function destroy(Category $category)
    {
        $this->authorize('edit',\saeid\Category\Model\Category::class);

        //$this->repo->deleteCat($categoryId);
        $category->delete();

    }
}
