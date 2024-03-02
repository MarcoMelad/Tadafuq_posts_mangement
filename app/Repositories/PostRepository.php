<?php

namespace App\Repositories;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository implements PostRepositoryInterface
{

    public function getAllPosts(int $limit = 10)
    {
        $posts = Post::with('user:id,user_name')->latest()->paginate($limit);
        return successResponse(200, $posts);
    }

    public function getPostById(int $post_id)
    {
        $post = Post::with('user:id,user_name')->findOrFail($post_id);
        return successResponse(200, new PostResource($post));
    }

    public function createPost(array $data): array
    {
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'contact_phone' => $data['contact_phone'],
            'user_id' => getCurrentUser()->id,
        ]);

        $results = new PostResource($post);

        return successResponse(201, $results);
    }

    public function updatePost(array $data, int $post_id): array
    {
        try {
            $post = Post::with('user:id,name')->findOrFail($post_id);
            $post->update(array_filter($data));
            return successResponse(200, new PostResource($post));
        } catch (ModelNotFoundException $e) {
            return failedResponse(404, ['error' => 'Post not found']);
        }
    }

    public function deletePost(int $post_id)
    {
        try {
            $post = Post::byUser()->findOrFail($post_id);
            $post->delete();
            return successResponse(200, ['message' => __('Product deleted successfully')]);
        } catch (ModelNotFoundException $e) {
            return failedResponse(404, ['error' => 'Post not found']);
        }
    }
}
