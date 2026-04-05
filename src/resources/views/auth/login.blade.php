@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__content-wrapper">
            <div class="auth-form__heading">
                <h1 class="auth-form__heading-title">Login</h1>
            </div>
            <form action="{{ route('login') }}" method="POST" class="auth-form" novalidate>
                @csrf
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="email" class="auth-form__label-item">メールアドレス</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                class="auth-form__input" placeholder="例: test@example.com">
                        </div>
                        <div class="auth-form__error">
                            @if ($errors->has('email') && !str_contains($errors->first('email'), 'ログイン情報'))
                                {{ $errors->first('email') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="auth-form__group">
                    <div class="auth-form__group-title">
                        <label for="password" class="auth-form__label-item">パスワード</label>
                    </div>
                    <div class="auth-form__group-content">
                        <div class="auth-form__input-text">
                            <input type="password" name="password" id="password" class="auth-form__input"
                                placeholder="例: coachtech1106">
                        </div>
                        <div class="auth-form__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                            @if ($errors->has('email') && str_contains($errors->first('email'), 'ログイン情報'))
                                {{ $errors->first('email') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="auth-form__button">
                    <button class="auth-form__button-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection
