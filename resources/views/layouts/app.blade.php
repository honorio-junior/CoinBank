<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>CoinBank @yield('title')</title>
</head>

<body class="bg-light">

    <main>
        <h1 class="fw-semibold fs-2 d-flex justify-content-start align-items-center gap-2 shadow-sm p-3 mb-5 rounded"><img src="logo.png" alt="logo" height="60" width="60">CoinBank</h1>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <br>
    <footer class="container">
        <p class="text-secondary text-center">&copy; {{ date('Y') }} CoinBank. All rights reserved. <a href="https://github.com/honorio-junior" target="_blank">honorio-junior</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>
