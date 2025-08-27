<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FinTrade')</title>


</head>

<body class="bg-gray-100">

    @include('components.header')

    <main class="pt-20">
        @yield('content')
    </main>

</body>
<script>
      const i18n = {
        'base.Last_Sale': "{{ __('base.Last_Sale') }}",
        'base.Signal_Buy': "{{ __('base.Signal_Buy') }}",
        'base.Signal_Sell': "{{ __('base.Signal_Sell') }}",
        'base.Waiting': "{{ __('base.Waiting') }}",
        'base.Closed': "{{ __('base.Closed') }}"
    };
</script>

</html>
