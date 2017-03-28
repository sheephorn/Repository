@section('header')
@inject('FunctionsDefinition', 'App\Definitions\FunctionsDefinition')
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <title> {{{ getTitle() }}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{{asset('assets/css/common.css?').str_random(5)}}}">
    @yield('addCss')
  </head>
  <div id="loading-bg" v-show="ret">
      <div id="loading">
          <img src="{{{ asset('assets/images/ajax-loader.gif') }}}" >
      </div>
  </div>
@stop
