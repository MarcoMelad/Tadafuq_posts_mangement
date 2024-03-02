<?php

namespace App\interfaces;

interface UserAuthRepositoryInterface
{
    public function login(array $data);

    public function register(array $data);

    public function user_profile();

    public function logout();
}
