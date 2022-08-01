@extends('layouts.app')

@section('title', 'ホーム画面')

@section('content')

@guest
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body text-center mt-5">
                        <div class="mb-5">
                            <h1 class="font-weight-bold">Twitterクローンへようこそ。</h1>
                        </div>
                        <div class="mb-5">
                            <h3>Twitterクローンを始めよう</h3>
                            <a href="{{ route('register') }}" class="register-btn rounded-pill mt-3 text-white">
                                メールアドレスで新規登録
                            </a>
                        </div>
                        <div>
                            <h5>アカウントをお持ちの場合</h5>
                            <a href="{{ route('login') }}" class="login-btn rounded-pill my-3 text-info">
                                ログイン
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest

@auth
    <div id='app'></div>
@endauth

@endsection
