
<div class="mx-auto flex min-h-dvh w-full max-w-md items-center px-4 py-12 sm:px-6">
  <flux:card class="w-full space-y-6">
    <div class="space-y-2">
      <flux:heading level="1" size="xl">{{ trans('auth.forgot_password.title') }}</flux:heading>
      <flux:text>{{ trans('auth.forgot_password.description') }}</flux:text>
    </div>

    <form class="space-y-4" wire:submit="sendResetLink">
      <flux:field>
        <flux:label>{{ trans('auth.forgot_password.email') }}</flux:label>
        <flux:input autocomplete="email" required type="email" wire:model="email"/>
        <flux:error name="email"/>
      </flux:field>

      <flux:button class="w-full" type="submit" variant="primary">
        {{ trans('auth.forgot_password.submit') }}
      </flux:button>
    </form>

    <div class="text-sm">
      <flux:link class="text-sm" href="{{ route('login') }}" wire:navigate>
        {{ trans('auth.forgot_password.back_to_login') }}
      </flux:link>
    </div>
  </flux:card>
</div>