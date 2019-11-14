<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * 管理画面ログイン直後のviewを表示
     * @return Factory|View
     */
    public function index()
    {
        return view('auth.home');
    }

    /**
     * 画像アップローダ画面の表示
     * @return Factory|View
     */
    public function files()
    {
        return view('auth.files.index');
    }
}
