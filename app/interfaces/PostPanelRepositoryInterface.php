<?php

namespace App\interfaces;

use App\Http\Requests\Posts\PostRequest;

interface PostPanelRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}
