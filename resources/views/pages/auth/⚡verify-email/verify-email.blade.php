
<div class="mx-auto flex min-h-dvh w-full max-w-md items-center px-4 py-12 sm:px-6">
  <flux:card class="w-full space-y-6">
    <div class="space-y-2">
      <flux:heading level="1" size="xl">{{ trans('auth.verify_email.title') }}</flux:heading>
      <flux:text>{{ trans('auth.verify_email.description') }}</flux:text>
    </div>

    <flux:button class="w-full" type="button" variant="primary" wire:click="sendVerificationNotification">
      {{ trans('auth.verify_email.submit') }}
    </flux:button>

    <form action="{{ route('logout') }}" class="w-full" method="POST">
      @csrf

      <flux:button class="w-full" type="submit" variant="ghost">
        {{ trans('auth.verify_email.logout') }}
      </flux:button>
    </form>
  </flux:card>
</div>