@extends('layouts.app')

@section('title', 'ユーザー新規登録画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row justify-content-center my-4">
                            <div class="col-lg-6">
                                <input id="account_name" type="text" class="form-control @error('account_name') is-invalid @enderror py-2" name="account_name" value="{{ old('account_name') }}" required autocomplete="account_name" placeholder="アカウント名" autofocus>

                                @error('account_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror py-2" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror py-2" name="password" required autocomplete="new-password" placeholder="パスワード（半角英数字8文字以上）">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-6">
                                <input id="password-confirm" type="password" class="form-control py-2" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード確認">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill px-5">
                                {{ __('登録する') }}
                            </button>
                        </div>

                        <div class="d-flex justify-content-center mt-5 mb-2">
                            アカウントをお持ちの場合は<a href="{{ route('login') }}">ログイン</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
