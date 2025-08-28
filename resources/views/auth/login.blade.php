@extends('layouts.app')
@section('title', '- Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Título -->
                    <h2 class="text-center mb-4 fw-bold">Login</h2>
                    <hr>

                    <!-- mensagens -->
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('awaiting'))
                    <div class="alert alert-info">{{ session('awaiting') }}</div>
                    @endif

                    @if (session('denied'))
                    <div class="alert alert-warning">{{ session('denied') }}</div>
                    @endif

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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-semibold">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="seu@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label fw-semibold">Senha</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="********">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
                    </form>

                    <!-- Link registrar -->
                    <div class="text-center mt-3">
                        <small class="text-muted">Não tem uma conta?</small>
                        <a href="{{ route('register') }}" class="fw-semibold text-decoration-none"> Criar agora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
