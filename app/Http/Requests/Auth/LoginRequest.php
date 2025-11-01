<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $guard = $this->guard();

        if (! $guard->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }

    protected function guard(): StatefulGuard
    {
        return Auth::guard();
    }
}
