<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

use function Pest\Livewire\livewire;

it('sends another verification email from the notice page', function () {
    $user = User::factory()->unverified()->create();

    Notification::fake();

    $this->actingAs($user);

    livewire('pages::auth.verify-email')
        ->call('sendVerificationNotification')
        ->assertHasNoErrors();

    Notification::assertSentTo($user, VerifyEmail::class);
});

it('marks the authenticated user email as verified from a signed link', function () {
    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        [
            'id' => $user->getKey(),
            'hash' => sha1($user->getEmailForVerification()),
        ],
    );

    $this->actingAs($user)
        ->get($verificationUrl)
        ->assertRedirect(route('dashboard'));

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

it('redirects authenticated unverified users away from protected routes', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertRedirect(route('verification.notice'));
});
