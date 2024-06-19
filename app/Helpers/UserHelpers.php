<?php

namespace App\Helpers;

class UserHelpers
{
    public function checkEmailIsValid(string $email): bool
    {
        return preg_match(
            '/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/',
            $email
        );
    }
}
