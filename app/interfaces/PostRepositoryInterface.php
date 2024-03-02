<?php

namespace App\interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts(int $paginate = 10);
    public function getPostById(int $post_id);
    public function createPost(array $data);
    public function updatePost(array $data, int $post_id);
    public function deletePost(int $post_id);
}
