<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ __('PinnacleWoundCare - Admin Panel') }}</title>
<script src="https://cdn.tailwindcss.com/"></script>
<script src="/js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
@livewireStyles
<body class="">
<div class="min-h-full">
  <main class="flex">
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include("layouts.navbars.sidebar-new")
    @endauth
    @guest()
        @include('layouts.page_templates.guest')
    @endguest

    <div class="w-5/6 mx-auto py-3 sm:px-6 lg:px-8">
      <!-- Replace with your content -->
      <div class="px-4 sm:px-0">
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="">
                  @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /End replace -->
    </div>
  </main>
</div>
@livewireScripts
</body>
</html>