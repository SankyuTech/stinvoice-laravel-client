  <script src="{{asset('vendor/stinvoice-client/js/core/popper.min.js')}}"></script>
  <script src="{{asset('vendor/stinvoice-client/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('vendor/stinvoice-client/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('vendor/stinvoice-client/js/plugins/smooth-scrollbar.min.js')}}"></script>


  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>


  <script src="{{asset('vendor/stinvoice-client/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>