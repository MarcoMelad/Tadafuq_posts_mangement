<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\PostRequest;
use App\interfaces\PostPanelRepositoryInterface;
use Illuminate\Http\Request;

class PostPanelController extends Controller
{
    protected $posts;
    public function __construct(PostPanelRepositoryInterface $posts)
    {
        return $this->posts = $posts;
    }

    public function index()
    {
        return $this->posts->index();
    }

    public function create()
    {
        return $this->posts->create();
    }

    public function store(PostRequest $request)
    {
        return $this->posts->store($request);
    }

    public function edit($id)
    {
        return $this->posts->edit($id);
    }

    public function update(PostRequest $request, int $id)
    {
        return $this->posts->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->posts->destroy($id);
    }
}
