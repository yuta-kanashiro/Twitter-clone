@extends('layouts.app')

@section('title', 'ログイン画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row justify-content-center my-4">
                            <div class="col-lg-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror py-2" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="アカウント名" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror py-2" name="password" required autocomplete="current-password" placeholder="パスワード">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('ログインを保持する') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill px-5">
                                {{ __('ログインする') }}
                            </button>

                            {{-- @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れましたか？') }}
                                </a>
                            @endif --}}
                        </div>

                        <div class="d-flex justify-content-center mt-5 mb-2">
                            アカウントをお持ちでない場合は<a href="{{ route('register') }}">登録する</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
