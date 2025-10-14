<header class="bg-white dark:bg-gray-900">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      @include('components.header.logo')
      @include('components.header.navigation')

      <div class="flex items-center gap-4">
        <div class="sm:flex sm:gap-4">
            <x-common.button>
                <a href="/sign-in"> Sign In </a>
            </x-common.button>

          <div class="hidden sm:flex">
            <x-common.button variant="secondary">
                <a href="/sign-up"> Sign Up </a>
            </x-common.button>
          </div>
        </div>

        <div class="block md:hidden">
          <x-common.button variant="secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </x-common.button>
        </div>
      </div>
    </div>
  </div>
</header>
