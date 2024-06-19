<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function createUser(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $password
    ): User {
        return User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ])->fresh();
    }

    public function getUserByEmail(string $email): Builder|Model|User|null
    {
        $viewer = Auth::user();

        if ($viewer && $viewer->email === $email) {
            return $viewer;
        }

        return User::query()->where("email", $email)->first();
    }

    public function getUserByUsername(string $username): Builder|Model|User|null
    {
        $viewer = Auth::user();

        if ($viewer && $viewer->username === $username) {
            return $viewer;
        }

        return User::query()->where("username", $username)->first();
    }

    public function getUserByLogin(string $login): Builder|Model|User|null
    {
        if (str_contains($login, "@")) {
            return $this->getUserByEmail(email: $login);
        } else {
            return $this->getUserByUsername(username: $login);
        }
    }

    public function getUserWithUsernameExistsStatus(string $username): bool
    {
        $viewer = Auth::user();

        if ($viewer && $viewer->username === $username) {
            return true;
        }

        return User::query()->where('username', $username)->exists();
    }

    public function getUserWithEmailExistsStatus(string $email): bool
    {
        $viewer = Auth::user();

        if ($viewer && $viewer->email === $email) {
            return true;
        }

        return User::query()->where('email', $email)->exists();
    }
}
