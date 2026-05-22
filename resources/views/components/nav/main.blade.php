<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
  <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
  <a class="sr-only" href="#main">Jump to content</a>
  <flux:brand href="{{ url('/') }}" name="{{ config('app.name', 'Laravel') }}" class="max-lg:hidden">
    <x-slot:logo>
      <x-logo class="h-6"/>
    </x-slot:logo>
  </flux:brand>

  <flux:navbar class="-mb-px max-lg:hidden">
    {{-- Main navigation --}}
  </flux:navbar>

  <flux:spacer/>

  <flux:navbar class="-mb-px max-lg:hidden">
    @auth
      <form action="{{ route('logout') }}" method="POST">
        @csrf

        <flux:button icon="arrow-right-start-on-rectangle" type="submit" variant="ghost">
          {{ trans('auth.logout') }}
        </flux:button>
      </form>
    @else
      <flux:navbar.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle">
        {{ trans('auth.login.submit') }}
      </flux:navbar.item>
    @endauth
  </flux:navbar>
</flux:header>

<flux:sidebar
  sticky
  collapsible="mobile"
  class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700"
>
  <flux:sidebar.header>
    <flux:sidebar.brand
      href="{{ url('/') }}"
      name="{{ config('app.name', 'Laravel') }}"
    >
      <x-slot:logo>
        <x-logo class="h-6"/>
      </x-slot:logo>
    </flux:sidebar.brand>

    <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"/>
  </flux:sidebar.header>

  <flux:sidebar.nav>
    {{-- Mobile navigation --}}
  </flux:sidebar.nav>

  <flux:sidebar.spacer />

  <flux:sidebar.nav>
    @auth
      <form action="{{ route('logout') }}" method="POST">
        @csrf

        <flux:button icon="arrow-right-start-on-rectangle" type="submit" variant="ghost">
          {{ trans('auth.logout') }}
        </flux:button>
      </form>
    @else
      <flux:sidebar.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle">
        {{ trans('auth.login.submit') }}
      </flux:sidebar.item>
    @endauth
  </flux:sidebar.nav>
</flux:sidebar>