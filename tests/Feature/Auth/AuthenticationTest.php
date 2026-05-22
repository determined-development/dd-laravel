<?php

use App\Models\User;

use function Pest\Livewire\livewire;

it('authenticates a verified user and redirects to dashboard', function () {
    $user = User::factory()->create([
        'email' => 'foo@example.com',
        'password' => 'password',
    ]);

    livewire('pages::auth.login')
        ->set('email', 'foo@example.com')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect(route('dashboard'));

    $this->assertAuthenticatedAs($user);
});

it('redirects unverified users to the verification notice after login', function () {
    $user = User::factory()->unverified()->create([
        'email' => 'foo@example.com',
        'password' => 'password',
    ]);

    livewire('pages::auth.login')
        ->set('email', 'foo@example.com')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect(route('verification.notice'));

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid credentials', function () {
    User::factory()->create([
        'email' => 'foo@example.com',
        'password' => 'password',
    ]);

    livewire('pages::auth.login')
        ->set('email', 'foo@example.com')
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors(['email']);

    $this->assertGuest();
});

it('redirects authenticated users away from login route', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('login'))
        ->assertRedirect(route('dashboard'));
});

it('logs the current user out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
