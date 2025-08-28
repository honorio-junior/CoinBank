<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>CoinBank</title>
</head>

<body class="bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <!-- Logo / Nome -->
                <h1 class="d-flex align-items-center justify-content-center gap-2 fw-bold display-4"><img src="logo.png" alt="logo" height="60" width="60">CoinBank</h1>
                <p class="text-muted">
                    Gerencie sua conta, transfira valores e acompanhe seu saldo de forma simples, rápida e segura.
                </p>

                <!-- Botões -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                        Criar Conta
                    </a>
                </div>

                <!-- Informações adicionais -->
                <div class="mt-5">
                    <h5 class="fw-semibold">Por que escolher o CoinBank?</h5>
                    <ul class="list-unstyled text-muted mt-3">
                        <li>✔️ Transferências rápidas e seguras</li>
                        <li>✔️ Extratos claros</li>
                        <li>✔️ Controle total do seu dinheiro 24/7</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer class="container mt-5">
        <p class="text-secondary text-center">&copy; {{ date('Y') }} CoinBank. All rights reserved. <a href="https://github.com/honorio-junior" target="_blank">honorio-junior</a></p>
    </footer>

</body>

</html>
