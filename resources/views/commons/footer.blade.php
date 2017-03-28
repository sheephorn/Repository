@section('footer')
    <div id="data-holder" datadata="888">
        <data-holder :sub.sync="{{{ isset($data)?json_encode($data):"999" }}}"></data-holder>
    </div>

    @yield('addJs')
    <script src="{{{asset('assets/js/vue.js')}}}"></script>
    <script src="{{{asset('assets/js/jquery-3.2.0.js')}}}"></script>
    <script src="{{{asset('assets/js/js.cookie.js')}}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{{asset('assets/js/sha256.js')}}}"></script>
    <script src="{{{asset('assets/js/common.js?').str_random(5)}}}"></script>
    <script src="{{{asset('assets/js/startup.js?').str_random(5)}}}"></script>
    <script>
        LOADING_IMAGE = '{{ asset('assets/images/ajax-loader.gif') }}';
    </script>
    @yield('endJs')
  </body>
</html>
@stop
