<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="h-full">
    <div class="min-h-full" x-data="{ isOpenMobile: false }">

        <!-- 1. Navigation Bar (Dark Nav) -->
        <x-navbar />

        <!-- 2. Page Header (White Header) -->
        <x-header :title="$title" />

        <!-- 3. Main Content Area -->
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
