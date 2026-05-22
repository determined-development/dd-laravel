<x-app-layout>
  <flux:main container>
    <flux:heading size="xl" level="1">Welcome, {{ auth()->user()->name }}</flux:heading>
  </flux:main>
</x-app-layout>
