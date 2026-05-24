@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-button')
<a href="/login">ログイン</a>
@endsection

@section('content')
<div class="auth-form__content">
    <div class="auth-form__heading">
        <h2>Register</h2>
    </div>
    <div class="auth-form__card">
        <form class="auth-form" action="/register" method="POST">
            @csrf
            <div class="auth-form__group">
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" placeholder="名前" value="{{ old('name') }}">
                <div class="form__error">
                    @error('name')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワード">
                <div class="form__error">
                    @error('password')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="パスワード確認">
                <div class="form__error">
                    @error('password_confirmation')
                    <p class="auth-form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="auth__form-button">
                <button type="submit" class="btn-primary">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection