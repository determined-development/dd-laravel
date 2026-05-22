
<div class="mx-auto flex min-h-dvh w-full max-w-md items-center px-4 py-12 sm:px-6">
  <flux:card class="w-full space-y-6">
    <div class="space-y-2">
      <flux:heading level="1" size="xl">{{ trans('auth.login.title') }}</flux:heading>
      <flux:text>{{ trans('auth.login.description') }}</flux:text>
    </div>

    <form class="space-y-4" wire:submit="login">
      <flux:field>
        <flux:label>{{ trans('auth.login.email') }}</flux:label>
        <flux:input autocomplete="email" required type="email" wire:model="email"/>
        <flux:error name="email"/>
      </flux:field>

      <flux:field>
        <flux:label>{{ trans('auth.login.password') }}</flux:label>
        <flux:input autocomplete="current-password" required type="password" wire:model="password"/>
        <flux:error name="password"/>
      </flux:field>

      <div class="flex items-center justify-between gap-3">
      <flux:checkbox label="{{ trans('auth.login.remember') }}" wire:model="remember"/>

        <flux:link href="{{ route('password.request') }}" class="text-sm" wire:navigate>
          {{ trans('auth.login.forgot') }}
        </flux:link>
      </div>

      <flux:button class="w-full" type="submit" variant="primary">
        {{ trans('auth.login.submit') }}
      </flux:button>
    </form>
  </flux:card>
</div>