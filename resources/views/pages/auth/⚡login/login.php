<?php

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

return new #[Layout('layouts::guest')] class () extends Component {
    #[Validate(['required', 'email'])]
    public string $email = '';

    #[Validate(['required', 'string'])]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $validated = $this->validate();

        $throttleKey = Str::lower($validated['email']) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => RateLimiter::availableIn($throttleKey),
                ]),
            ]);
        }

        if (! Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $this->remember)) {
            RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($throttleKey);

        session()->regenerate();

        $this->redirect(
            session()->pull(
                'url.intended',
                auth()->user()->hasVerifiedEmail()
                ? route('dashboard')
                : route('verification.notice')
            )
        );
    }
};
