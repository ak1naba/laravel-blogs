<?php

namespace App\DTOs;

class UserCreateDTO
{
    private string $email;
    private string $name;
    private string $password;
    private string $role;


    public function __construct(array $data)
    {
        $this->email = $data['email'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password, // Чистый пароль (захешируется в модели)
            'role' => $this->role,
        ];
    }
}
