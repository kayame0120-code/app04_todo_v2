@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-button')
<a href="/register">新規登録</a>
@endsection

@section('content')
<div class="auth-form__content">
    <div class="auth-form__heading">
        <h2>Login</h2>
    </div>
    <div class="auth-form__card">
        <form class="auth-form" action="/login" method="POST">
            @csrf
            <div class="auth-form__group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="test@example.com" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="coachtech1106">
                <div class="form__error">
                    @error('password')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth__form-button">
                <button type="submit" class="btn-primary">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection