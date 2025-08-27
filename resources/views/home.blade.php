@extends('layouts.app')
@section('title', '- Home')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">🏦 MyBank</h3>
    <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
</div>

{{-- Mensagens globais --}}
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>* {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Informações do usuário --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">👤 Account Holder</h5>
        <p class="mb-1"><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p class="mb-0"><strong>Email:</strong> {{ Auth::user()->email }}</p>
    </div>
</div>

@if (Auth::user()->account == null)
<div class="alert alert-warning">
    You do not have a bank account.
    <a href="{{ route('new-account') }}" class="btn btn-success btn-sm ms-2">Open account</a>
</div>
@else
{{-- Dados da conta --}}
<div class="card mb-4 shadow-sm border-0" style="background: linear-gradient(135deg, #4e73df, #1cc88a); color:white;">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <span>Status:</span>
            <span class="fw-bold">{{ Auth::user()->account->status == 1 ? 'Active' : 'Blocked' }}</span>
        </div>
        <div class="d-flex justify-content-between">
            <span>Account Code:</span>
            <span class="fw-bold">{{ Auth::user()->account->code }}</span>
        </div>
        <hr class="border-light">
        <div class="text-center">
            <p class="mb-1">Current Balance</p>
            <h2 class="fw-bold">
                $ {{ number_format(Auth::user()->account->balance, 2, '.', ',') }}
            </h2>
        </div>
    </div>
</div>

{{-- Ações --}}
<div class="d-flex gap-2 mb-4">
    <button class="btn btn-outline-success w-50" data-bs-toggle="collapse" data-bs-target="#extractList">
        📄 Extract
    </button>
    <button class="btn btn-outline-primary w-50" data-bs-toggle="collapse" data-bs-target="#transferForm">
        💸 Transfer
    </button>
</div>

<!-- extratos -->
<div class="collapse" id="extractList">
    <h2 class="mb-4">Lista de Extratos</h2>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Origem</th>
                <th>Destino</th>
                <th>Price</th>
                <th>New Balance</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($extracts as $extract)
            <tr>
                <td>{{ $extract->origin }}</td>
                <td>{{ $extract->destination }}</td>
                <td>R$ {{ number_format($extract->balance, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($extract->newBalance, 2, ',', '.') }}</td>
                <td>{{ $extract->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Nenhum extrato encontrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $extracts->links('pagination::bootstrap-4') }}
    </div>

</div>

{{-- Formulário de transferência --}}
<div class="collapse" id="transferForm">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Transfer Money</h5>
            @if (Auth::user()->account->status == 0)
            <p class="text-danger">Your account is blocked; you cannot make any transactions.</p>
            @else
            <form action="{{ route('transfer') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="code" class="form-label">Destination Account</label>
                    <input type="number" id="code" name="code" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" id="amount" name="amount" class="form-control" min="1" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Confirm Transfer</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endif

@endsection
