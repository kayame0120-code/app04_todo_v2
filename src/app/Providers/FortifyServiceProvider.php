<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // 会員登録時にusersテーブルへINSERTする処理を指定
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン画面のBladeを指定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 会員登録画面のBladeを指定
        Fortify::registerView(function () {
            return view('auth.register');
        });
        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレスはメール形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]);

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
