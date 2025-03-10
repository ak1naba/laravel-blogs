<?php

namespace App\DTOs;

class UserCreateDTO
{
    public string $email;
    public string $name;
    public string $password;
    public string $role;


    public function __construct(array $data)
    {
        $this->email = $data['email'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['role'] ?? '';
    }

}
