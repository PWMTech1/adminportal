@include('layouts.navbars.sidebar')
<div id="content" class="main-content">
  @include('layouts.navbars.navs.auth')
  @yield('content')
  @include('layouts.footers.auth')
</div>