@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection
@section('content')
    <div class="login-form__content form__content">
        <div class="login-form__heading">
            <h1 class="heading-title login-form__heading-title">Login</h1>
        </div>
        <form action="{{ route('login') }}" method="POST" class="form" novalidate>
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="email" class="form__label-item">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form__input" placeholder="例: test@example.com">
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="password" class="form__label-item">パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input-text">
                        <input type="password" name="password" id="password" class="form__input" placeholder="例: coachtech1106">
                    </div>
                    <div class="form__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection
