<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap');

        :root {
            font-family: "Inter", system-ui, Avenir, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            font-weight: 400;
        }
    </style>

    <!-- Scripts -->
    @routes
    <!-- @vite(['resources/js/app.ts']) -->
    @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

<script>
    // Where there is a will, there is a way.
    // Stupid syncfusion error message terminator
    // Reason: The syncfusion need the license key directly in the registerLicense method. To protect my key, I hid it in the .env file and the method is not recognizing it, and therefore giving an error message. This is the eradicator for the STUPID METHOD'S ERROR
    const page = window.document.location.pathname;
    window.setTimeout(() => {
        if (page != '/login' || page != '/register' || page != '/verify-email') {
            document.body.lastElementChild.remove()
        }
    }, 400)
</script>

</html>