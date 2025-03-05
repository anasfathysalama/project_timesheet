<?php

namespace App\Services\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    private array $data;
    private ?User $user;
    private string $token;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function make(array $data): static
    {
        return new self($data);
    }

    public function check(): static
    {
        $this->user = User::where('email', $this->data['email'] ?? null)->first();

        throw_if(
            !$this->user || !Hash::check($this->data['password'], $this->user?->password),
            new AuthenticationException('Invalid credentials')
        );

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
