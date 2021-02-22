<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\StoreBlogCategoryRequest;
use App\Http\Requests\Backend\Blog\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function index()
    {
    	$categories = BlogCategory::with('parent')->orderByDesc('id')->paginate(50);
        return  view('backend.blog-category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function create()
    {
	    $categories = BlogCategory::all();

	    return  view('backend.blog-category.create',compact('categories'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreBlogCategoryRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(StoreBlogCategoryRequest $request)
    {

	    $category = BlogCategory::create($request->parameters());

	    $category->slug = Str::slug($category->title) . '-' . $category->id;

	    $category->save();

	    return  redirect()->route('admin.blogCategory.index')->with('status', 'Tạo danh mục thành công!');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function edit( BlogCategory $blogCategory)
    {
	    $categories = BlogCategory::where('id', '!=',$blogCategory->id )->get();
	    return  view('backend.blog-category.edit',compact('categories', 'blogCategory'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UpdateBlogCategoryRequest $request
	 * @param BlogCategory $blogCategory
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory)
    {
    	$params = $request->parameters();
    	$params['slug'] =  Str::slug($params['title']) . '-' . $blogCategory->id;
        $blogCategory->update($params);

	    return redirect()->route('admin.blogCategory.index')->with('status', 'Cập nhật thành công!');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param BlogCategory $blogCategory
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function destroy(BlogCategory $blogCategory)
    {
    	$oldCat = clone($blogCategory);
	    $blogCategory->delete();

	    return response()->json(['status' => true, 'id' =>  $oldCat->id]);

    }
}
