
<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

@include('stinvoice-client::layouts.head')


<body class="g-sidenav-show  bg-gray-100">

  @include('stinvoice-client::layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    @include('stinvoice-client::layouts.header')

    <div class="container-fluid py-4">

      <div class="row">
        
        @yield('content')

      </div>

      @include('stinvoice-client::layouts.footer')

    </div>
  </main>

  @include('stinvoice-client::layouts.scripts')

</body>

</html>