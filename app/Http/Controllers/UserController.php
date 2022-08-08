<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
    //　ページの表示
    return view('user.register');
    }
    
    //　ユーザーの登録
    public function register(UserRegisterPost $request) {
    // データの取得
    $datum = $request->validated();
    //var_dump($datum); exit;
    
    // パスワードのハッシュ化
    $datum['password'] = Hash::make($datum['password']);
       
    // テーブルへのINSERT
    try {
        User::create($datum);
    } catch(\Throwable $e) {
        echo $e->getMessage();
        exit;
    }

    $request->session()->flash('front.user_register_success', true);

    return redirect('/');
    }
}