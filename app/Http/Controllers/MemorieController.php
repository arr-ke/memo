<?php
// メモリーコントローラー

namespace App\Http\Controllers;

use App\Http\Controllers\MemoController;
use Illuminate\Http\Request;
use App\Http\Requests\MemorieRequest;
use App\Models\Memorie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;

class MemorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MemorieRequest $request)
    {
        // ↓設定ファイルがない、DBが空、未ログインなどが原因のリンクエラーが起きたのかを真偽判定しています。
        if (!view()->exists('memorie.index') || !Auth::check()) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "1");
        }

        try {
            $memories = Memorie::orderBy("id", "desc")->get();

            // ↓閲覧画面
            return view("memorie.index", compact("memories"));
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "3");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ↓設定ファイルがない、DBが空、未ログインなどが原因のリンクエラーが起きたのかを真偽判定しています。
        if (!view()->exists('memorie.create') || !Auth::check()) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "1");
        }

        try {
            // ↓メモ作成画面
            return view("memorie.create");
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "3");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemorieRequest $request)
    {
        // ↓タイトルとメッセージに値があるのかを真偽判定しています。
        if ($request->filled('title') && $request->filled('memo')) {
            // メモ新規作成処理
            $title = $request->input('title');
            $message = $request->input('memo');

            $memorie = new Memorie();
            $memorie->user_id = Auth::user()->id;
            $memorie->titlename = $title;
            $memorie->message = $message;

            // ↓画像1があるのかを真偽判定しています。
            if ($request->hasFile('img1')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img1')->store('image', 'public');
                $memorie->image_name_1 = 'storage/' . $path;
            } else {
                $memorie->image_name_1 = null;
            }

            // ↓画像2があるのかを真偽判定しています。
            if ($request->hasFile('img2')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img2')->store('image', 'public');
                $memorie->image_name_2 = 'storage/' . $path;
            } else {
                $memorie->image_name_2 = null;
            }

            // ↓画像3があるのかを真偽判定しています。
            if ($request->hasFile('img3')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img3')->store('image', 'public');
                $memorie->image_name_3 = 'storage/' . $path;
            } else {
                $memorie->image_name_3 = null;
            }
            
            $memorie->created_at = Carbon::now('Asia/Tokyo');
            $memorie->updated_at = Carbon::now('Asia/Tokyo');
            $memorie->save();
            
            // メモ帳開発でのアドバイス
            // 成功アラートではなく別の成功アクションをすれば良い。

            // ↓閲覧画面
            return redirect()->route("memorie.index")->with('insertupdatedeletemessage', "メモの新規作成に成功しました。");
        } else {
            // ↓メモ作成画面
            return redirect()->route("memorie.create")->with('errormessage', "メモの新規作成に失敗しました。");
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
        // メモ編集

        // ↓設定ファイルがない、DBが空、未ログインなどが原因のリンクエラーが起きたのかを真偽判定しています。
        if (!view()->exists('memorie.edit') || !Auth::check()) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "1");
        }

        try {
            $memorie = Memorie::findOrFail($id);

            // ↓メモ編集画面
            return view("memorie.edit", compact("memorie"));
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "3");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemorieRequest $request, string $id)
    {
        // ↓タイトルとメッセージに値があるのかを真偽判定しています。
        if ($request->filled('title') && $request->filled('memo')) {
            // メモ更新処理
            $titlename = $request->input("title");
            $message = $request->input('memo');

            $memorie = Memorie::findOrFail($id);

            $memorie->user_id = Auth::user()->id;
            $memorie->titlename = $titlename;
            $memorie->message = $message;

            // メモ帳開発でのアドバイス
            // 画像更新のときに画像の更新をするのかの処理がほしい。

            // ↓画像1があるのかを真偽判定しています。
            if ($request->hasFile('img1')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img1')->store('image', 'public');
                $memorie->image_name_1 = 'storage/' . $path;
            } else {
                $memorie->image_name_1 = null;
            }

            // ↓画像2があるのかを真偽判定しています。
            if ($request->hasFile('img2')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img2')->store('image', 'public');
                $memorie->image_name_2 = 'storage/' . $path;
            } else {
                $memorie->image_name_2 = null;
            }

            // ↓画像3があるのかを真偽判定しています。
            if ($request->hasFile('img3')) {
                // ↓画像を画像フォルダーに保存しています。
                $path = $request->file('img3')->store('image', 'public');
                $memorie->image_name_3 = 'storage/' . $path;
            } else {
                $memorie->image_name_3 = null;
            }

            $memorie->updated_at = Carbon::now('Asia/Tokyo');

            $memorie->save();

            // メモ帳開発でのアドバイス
            // 成功アラートではなく別の成功アクションをすれば良い。
            // メモを更新したときのアクションが閲覧画面にほしい。

            // ↓閲覧画面
            return redirect()->route("memorie.index")->with('insertupdatedeletemessage', "メモの更新に成功しました。");
        } else {
            // ↓メモ編集画面
            return redirect()->route("memorie.edit")->with('errormessage', "メモの更新に失敗しました。");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // メモ削除処理
        $memorie = Memorie::findOrFail($id);

        // ↓メモが削除できているのかを真偽判定しています。 
        if ($memorie->delete()) {
            // メモ帳開発でのアドバイス
            // 成功アラートではなく別の成功アクションをすれば良い。

            // ↓閲覧画面
            return redirect()->route("memorie.index")->with('insertupdatedeletemessage', "メモの削除に成功しました。");
        } else {
            // ↓メモ編集画面
            return redirect()->route("memorie.edit")->with('errormessage', "メモの削除に失敗しました。");
        }

    }

    public function error(MemorieRequest $request) {
        // ↓エラー画面
        return view("memorie.error");
    }

    public function logout(MemorieRequest $request) {

        try {
            // ログアウト処理
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // ↓ログアウトしているのかまたは、リンクエラーが起きていないのかを真偽判定しています。
            if (!Auth::check() || !view()->exists('memorie.logout')) {
                // ↓ログイン画面
                return redirect()->route('user.index')->with('logoutmessage', "ログアウトに成功しました。");
            } else {
                // ↓エラー画面
                return redirect()->route('memorie.error')->with('value', "1");
            }
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "3");
        }
    }

    public function search(MemorieRequest $request) {
        /* メモ帳開発でのアドバイス
           ➀検索機能はタイトル機能だけではなく、本文検索したほうがいい。
           ➁検索機能で、タイトルと本文の検索それぞれにヒットした数をカウントしてほしい。（あとヒットした部分にも色をつけてほしい。）　*/
    

        //検索処理 

        // ↓未ログインなのかを真偽判定しています。
        if (!Auth::check()) {
            return redirect()->route('memorie.error')->with('value', "2");
        }

        try {
            // ↓検索値が入力されているのかを真偽判定しています。
            if ($request->filled('searchname')) {
                $query = Memorie::orderBy("id", "desc");

                // ↓検索キーワードをデータベースのtitlenameにあるのかを探しています。
                $query->where('titlename', 'LIKE', '%' . $request->input('searchname') . '%');

                $memories = $query->get();

                $memotitlename = $request->input('searchname');

                return view('memorie.search', compact("memories", "memotitlename"));
            } else {
                // ↓エラー画面
                return redirect()->route('memorie.error')->with('value', "2");
            }
        // ↓原因不明エラーが起きた場合
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('memorie.error')->with('value', "3");
        }
    }
}
