<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Molla - Bootstrap eCommerce Template</title>

    <script>
        WebFontConfig = {
            google: { families: [ 'Poppins:400,500,600,700', 'PlayfairDisplay:400,400italic,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = "{{ asset('assets/js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('assets/images/icons/site.webmanifest') }}" />
    <link rel="mask-icon" href="{{ asset('assets/images/icons/safari-pinned-tab.svg') }}" color="#666666" />
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico') }}" />
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    @vite(['resources/css/app.css'])
    <!-- For line-awesome (if not processed through Vite) -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}" />
    @yield('style')
</head>