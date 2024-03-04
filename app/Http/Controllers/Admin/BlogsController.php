<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('blogImages')->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteMedia(Request $request) {
        $file = $request->file_name;
        File::delete(storage_path('tmp/uploads/'.$file));

        return 'success';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {

        logger($request->input('images'));

        $blog = Blog::create($request->all());

        foreach($request->input('images') as $image) {
            File::move(storage_path('tmp/uploads/'.$image), public_path('storage/images/'.$image));
            File::delete(storage_path('tmp/uploads/'.$image));

            BlogImage::create([
                'image'     => $image,
                'blog_id'   => $blog->id,
            ]);
        }

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //Deleting Removed Images
        $removedImages = collect($blog->blogImages)->pluck('image')->diff($request->input('images'));

        foreach($removedImages as $removedImage) {
            File::delete(public_path('storage/images/'.$removedImage));
            $blog->blogImages()->where('image', $removedImage)->delete();
        }

        //Adding Nes Images
        foreach($request->input('images') as $image) {
            if(!$blog->blogImages()->where('image', $image)->exists()) {
                File::move(storage_path('tmp/uploads/'.$image), public_path('storage/images/'.$image));

                BlogImage::create([
                    'image'     => $image,
                    'blog_id'   => $blog->id
                ]);
            }
        }

        $blog->update($request->all());

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //delete photo
        foreach($blog->blogImages as $img) {

            Storage::disk('public')->delete('images/'.$img->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index');
    }
}
