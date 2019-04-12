<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['only' => ['getLogin']]);
        $this->middleware('auth', ['only' => ['getLogout']]);
    }

    public function index(){
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        $posts->getFactory()->setViewName('pagination::simple');
        $this->layout->title = 'Laravelでブログ作成';

        $this->layout->main = View::make('home')->nest('content', 'index', compact('posts'));
    }

    public function search(){
        $searchTerm = Input::get('s');

        $posts = Post::where('title', 'LIKE', '%'.$searchTerm.'%')->paginate(10);

        $posts->getFactory()->setViewName('paginetion::slider');
        $posts->appends(['s'=>$searchTerm]);
        $this->layout->with('title', '検索:'.$searchTerm);
        $this->Layout->main = View::make('home')->nest('content', 'index', ($posts->isEmpty()) ? ['notFound'=>true] : compact('posts'));
    }

    public function getLogin(){
        $this->layout->title = 'ログインページ';
        $this->layout->main = View::make('users.login');
    }

    public function postLogin(){
        $credentials = [
            'username'=>Input::get('username'),
            'password'=>Input::get('password')
        ];

        $rules = [
            'username'=>'required',
            'password'=>'required'
        ];

        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {

            if (Auth::attempt($credentials)) {
                return Redirect::to('admin/dash_board');
            }else{
                return Redirect::back()->withInput()->with('failure', '正しいユーザー名／パスワードを入力してください。');
            }

        }else{
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('/');
    }

    // ユーザー管理
    public function getNewaccount(){
        $this->layout->title = '新規登録ページ';
        $this->layout->main = View::make('users.newaccount');
    }

    public function postCreate(){

        $rules = [
            'username'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed',
            'password_confirmation' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $user = new User;
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::to('/login')
                    ->with('success', '登録ありがとうございました。ログインしてください。');
        }
        return Redirect::to('/newaccount')
                ->with('message', 'エラーが起こりました。')
                ->withErrors($validator)
                ->withInput();
}

}
