<?php

namespace App\Auth;

use Illuminate\Auth\TokenGuard as BaseTokenGuard;

use Illuminate\Http\Request;

class TokenGuard extends BaseTokenGuard
{
    public function __construct(Request $request)
    {
        parent::__construct($this->provider, $request, $this->inputKey, $this->storageKey);
    }
    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (empty($credentials) ||
            (count($credentials) === 1 && isset($credentials['token']))) {
            return false;
        }

        $user = $this->provider->retrieveByCredentials($credentials);

        return $user && $this->provider->validateCredentials($user, $credentials);
    }
}