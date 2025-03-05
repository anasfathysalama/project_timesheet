<?php

namespace App\Services\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterService
{
    private array $data;
    private User $user;
    private string $token;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function make(array $data): static
    {
        return new self($data);
    }

    public function create(): static
    {
        $this->user = User::create($this->data);

        return $this;
    }

    public function generateToken(): static
    {
        $this->token = $this->user->createToken('Personal Access Token')->accessToken;

        return $this;
    }

    public function get(): JsonResponse
    {
        return response()->json([
            'token' => $this->token,
            'user' => UserResource::make($this->user)
        ]);
    }
}
