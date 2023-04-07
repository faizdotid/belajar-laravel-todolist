@extends('user.layouts.header')
@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    @if(session('error'))
    <div class="row">
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    </div>
    @endif
    @if(session('success'))
    <div class="row">
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Login</h1>
            <p class="col-lg-10 fs-4">by <a target="_blank" href="#">{{ env('AUTHOR', 'LOL') }}</a></p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="user" placeholder="id" value="{{ old('username') }}">
                    <label for="user">User</label>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="password">
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection