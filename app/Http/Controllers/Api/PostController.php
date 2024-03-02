<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(private readonly PostRepositoryInterface $postRepository)
    {

    }

    public function index(): JsonResponse
    {
        $result = $this->postRepository->getAllPosts(10);
        return response()->json($result, $result['status_code']);
    }

    public function show($id): JsonResponse
    {
        $post = $this->postRepository->getPostById($id);
        return response()->json($post,$post['status_code']);
    }

    public function store(PostRequest $request): JsonResponse
    {
        $result = $this->postRepository->createPost($request->validated());
        return response()->json($result,$result['status_code']);
    }

    public function update(PostRequest $request, int $post_id): JsonResponse
    {
        $result = $this->postRepository->updatePost($request->validated(),$post_id);
        return response()->json($result,$result['status_code']);
    }

    public function destroy(int $post_id): JsonResponse
    {
        $result = $this->postRepository->deletePost($post_id);
        return response()->json($result,$result['status_code']);
    }
}
