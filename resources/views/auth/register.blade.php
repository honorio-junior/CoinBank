@extends('layouts.app')
@section('title', '- Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Título -->
                    <h2 class="text-center mb-4 fw-bold">Cadastro</h2>
                    <p class="text-center text-muted">Abra sua conta no <strong>CoinBank</strong> e comece a controlar suas finanças.</p>
                    <hr>
                    <!-- Erros -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulário -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Seu nome completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="seu@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmação de Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="********" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Registrar</button>
                    </form>

                    <!-- Link login -->
                    <div class="text-center mt-3">
                        <small class="text-muted">Já tem conta?</small>
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none"> Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
