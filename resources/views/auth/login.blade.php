@extends('layouts.app')
@section('title', '- Login')

@section('content')

<h2>Login</h2>

<!-- register -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- register -->

<!-- status user -->
@if (session('awaiting'))
<div class="alert alert-info">
    {{ session('awaiting') }}
</div>
@endif
@if (session('denied'))
<div class="alert alert-warning">
    {{ session('denied') }}
</div>
@endif
<!-- status user -->

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form class="border p-2 rounded" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>

@endsection
