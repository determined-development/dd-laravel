<nav
  class="w-full max-w-screen-w sticky top-0 h-22 z-10 flex items-center jusitfy-between md:items-end"
  role="navigation"
  aria-label="main navigation"
  x-data="navigation"
  x-on:click.outside="close"
  x-on:focus.outside="close"
>
  <a class="sr-only" href="#main">Jump to content</a>
  <a href="{{ url('/') }}"><x-logo class="w-20 h-20" /></a>
  <div class="h-full max-w-7xl w-fit min-w-1/2-screen-w mx-auto px-2 grow shrink-0">
    <div class="gap-2 w-full flex items-center justify-end md:hidden h-full">
      <button
        role="button"
        class="rounded border-none bg-itc-blue text-gray-400 w-12 h-12 flex items-center justify-center focusable"
        x-on:click="toggle"
        x-bind:aria-label="title"
      >
        <x-heroicon-o-bars-3 class="h-10 w-10 pointer-events-none" />
      </button>
    </div>
    <div
      @class([
        'gap-1 w-full',
        'flex-col items-stretch justify-center absolute top-24 inset-x-0 bg-gray-200 max-h-screen-h overflow-y-auto md:overflow-y-visible',
        'md:right-0 md:left-auto md:flex md:flex-row md:items-center md:justify-end md:relative md:top-auto md:bg-transparent md:pt-4',
        'lg:gap-2',
      ])
      x-bind:class="menuClass"
      x-cloak
    >
      {{-- TODO: Add site menu --}}
    </div>
  </div>
</nav>