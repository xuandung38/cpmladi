<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\StorePostRequest;
use App\Http\Requests\Backend\Blog\UpdatePostRequest;
use App\Models\BlogCategory;
use App\Models\Post;
use Arr;
use Illuminate\Http\Request;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = Post::with('category')->orderByDesc('id')->paginate(50);
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
	    $categories = BlogCategory::all();
	    return  view('backend.post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
    	$params = $request->parameters();

	    $imageName = time().'.'.$request->thumbnail->getClientOriginalExtension();

	    $request->thumbnail->move(public_path('images'), $imageName);

	    $params['thumbnail'] = $imageName;

	    $post = Post::create($params);

	    $post->slug = Str::slug($post->title) . '-' . $post->id;

	    $post->save();

	    return  redirect()->route('admin.post.index')->with('status', 'Tạo bài viết thành công!');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
    	$categories = BlogCategory::all();
        return view('backend.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
	    $params = $request->parameters();

	    if ($request->has('thumbnail')){
		    $imageName = time().'.'.$request->thumbnail->getClientOriginalExtension();

		    $request->thumbnail->move(public_path('images'), $imageName);

		    $params['thumbnail'] = $imageName;
	    }else{
	    	$params =  Arr::except($params, ['thumbnail']);
	    }

	    $params['slug'] =  Str::slug($params['title']) . '-' . $post->id;

	    $post->update($params);

	    return redirect()->route('admin.post.index')->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
	    $oldPost = clone($post);
	    $post->delete();
	    return response()->json(['status' => true, 'id' =>  $oldPost->id]);
    }
}
