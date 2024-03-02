<?php

namespace App\Repositories;

use App\Http\Requests\Posts\PostRequest;
use App\interfaces\PostPanelRepositoryInterface;
use App\Models\Post;

class PostPanelRepository implements PostPanelRepositoryInterface
{

    public function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store($request)
    {
        try {
            Post::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'contact_phone'=>$request->contact_phone,
                'user_id' => auth()->user()->id,
            ]);
            return redirect()->back()->with('success', 'Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update($request, $id)
    {
        try {
            $post = Post::findorFail($id);
            $post->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'contact_phone'=>$request->contact_phone,
                'user_id' => auth()->user()->id,
            ]);
            return redirect()->back()->with('edit', 'Data has been updated successfully');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {

            Post::destroy($id);
            return redirect()->back()->with('delete', 'Data has been deleted successfully');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
