<?php

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Queue;

use function Pest\Livewire\livewire;

it('sends a password reset link to a known user', function () {
    $user = User::factory()->create([
        'email' => 'foo@example.com',
    ]);

    Notification::fake();

    livewire('pages::auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendResetLink')
        ->assertHasNoErrors();

    Notification::assertSentTo($user, ResetPassword::class);
});

it('resets the password with a valid token', function () {
    Event::fake([PasswordReset::class]);
    Queue::fake();

    $user = User::factory()->create([
        'email' => 'foo@example.com',
        'password' => 'old-password',
    ]);
    $oldRememberToken = $user->remember_token;

    $token = Password::broker()->createToken($user);

    livewire('pages::auth.reset-password', [
        'token' => $token,
    ])
        ->set('email', $user->email)
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('resetPassword')
        ->assertRedirect(route('login'));

    expect(auth()->validate([
        'email' => $user->email,
        'password' => 'new-password',
    ]))->toBeTrue();

    Event::assertDispatched(PasswordReset::class);
    expect($user->fresh()->remember_token)->not->toBe($oldRememberToken);
});
