<?php
// ユーザーコントローラー

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Memorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ↓設定ファイルがない、DBが空などが原因のリンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.index')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }

        try {
            // ↓ログイン画面
            return view("user.index");
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "3");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ↓設定ファイルがない、DBが空などが原因のリンクエラーが起きたていないのかを真偽判定しています。
        if (!view()->exists('user.create')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }

        try {
            // ↓ユーザーアカウント登録画面
            return view("user.create");
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "3");
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // ↓パスワードとパスワード確認の値が一致しているのかを真偽判定しています。
        if ($request->input('pwasr') === $request->input('pw')) {

            // ↓データベースに同じID名があるのかを真偽判定しています。 
            if (User::where('name', $request->input('id'))->exists()) {
                // ↓ユーザーアカウント登録画面
                return redirect()->route('user.create')->with('errormessage', "そのIDはすでに使用されています。");
            }

            // ユーザー新規登録処理
            $name = $request->input("id");
            $pw = $request->input('pw');

            $user = new User();
            $user->name = $name;
            $user->pw = Hash::make($pw);
            $user->created_at = Carbon::now('Asia/Tokyo');
            $user->save();

            // メモ帳開発でのアドバイス
            // 成功アラートではなく別の成功アクションをすれば良い。

            // ↓ログイン画面
            return redirect()->route('user.index')->with('errorinsertmessage', "ユーザー登録に成功しました。");
        } else {
            // ↓ユーザーアカウント登録画面
            return redirect()->route('user.create')->with('errormessage', "ユーザー登録に失敗しました。");
        }
           
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(UserRequest $request) {
        // ログイン処理
        $login = [
            'name' => $request->input('name'),
            'password' => $request->input('pw'),
        ];

        // ↓ログインしているのかを真偽判定しています。
        if (Auth::attempt($login)) {
            // メモ帳開発でのアドバイス
            // 成功アラートではなく別の成功アクションをすれば良い。

            // ↓閲覧画面
            return redirect()->route('memorie.index')->with('count', "1");
        }
        // ↓ログイン画面
        return redirect()->route('user.index')->with('errorinsertmessage', "ログインに失敗しました。");
    }

    public function error(UserRequest $request) {
        // ↓エラー画面
        return view("user.error");
    }
}
