<?php

namespace App\DTOs\User;

class UserUpdateDTO
{
    private ?string $email;
    private ?string $name;
    private ?string $password;
    private ?string $role;


    public function __construct(array $data)
    {
        $this->email = $data['email'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;
    }
    public function toArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'role' => $this->role,
        ], [$this, "nullValueCheck"]);
    }

    private function nullValueCheck($value): bool
    {
        return $value !== null;
    }
}
