<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
   
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
   




</head>
<body>

  <?php  if (LaravelLocalization::getCurrentLocaleDirection()=='rtl' ) : ?>
  <style>
    body {
    /*  direction: rtl !important;*/

    }
    .wizard-tab-content {
      direction: rtl !important;
    }
    .flex.rightflex{
      text-align:right !important;
      direction: rtl !important;
    }
    .formulate-input-wrapper {
      text-align:right !important;

    }


  .vue-form-wizard .wizard-card-footer .wizard-footer-left {
     float: right !important;
;
}

.vue-form-wizard .wizard-card-footer .wizard-footer-right {
    float: left !important;
}


  </style>
  <?php endif  ?>

  <div id="app">
    <v-app>

        @yield('content')

  </v-app>
  </div>

    <script src="{{ asset('public/js/app.js') }}"></script>

</body>
</html>
