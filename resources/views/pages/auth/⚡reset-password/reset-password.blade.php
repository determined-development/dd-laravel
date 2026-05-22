
<div class="mx-auto flex min-h-dvh w-full max-w-md items-center px-4 py-12 sm:px-6">
  <flux:card class="w-full space-y-6">
    <div class="space-y-2">
      <flux:heading level="1" size="xl">{{ trans('auth.reset_password.title') }}</flux:heading>
      <flux:text>{{ trans('auth.reset_password.description') }}</flux:text>
    </div>

    <form class="space-y-4" wire:submit="resetPassword">
      <flux:field>
        <flux:label>{{ trans('auth.reset_password.email') }}</flux:label>
        <flux:input autocomplete="email" required type="email" wire:model="email"/>
        <flux:error name="email"/>
      </flux:field>

      <flux:field>
        <flux:label>{{ trans('auth.reset_password.password') }}</flux:label>
        <flux:input autocomplete="new-password" required type="password" wire:model="password"/>
        <flux:error name="password"/>
      </flux:field>

      <flux:field>
        <flux:label>{{ trans('auth.reset_password.password_confirmation') }}</flux:label>
        <flux:input autocomplete="new-password" required type="password" wire:model="password_confirmation"/>
      </flux:field>

      <flux:button class="w-full" type="submit" variant="primary">
        {{ trans('auth.reset_password.submit') }}
      </flux:button>
    </form>
  </flux:card>
</div>