<!-- メモ編集画面 -->

@extends('layout.memorieapp')

@section('content')

<!-- ↓メモ更新に失敗したのかを真偽判定しています。 -->
@if (session('errormessage'))
    <script>
        alert('{{ session('errormessage') }}');
    </script>
@endif

<h1>メモ新規作成</h1>


<!-- ↓閲覧画面 -->
<h2>
    <!-- ↓閲覧画面 -->
    <a href="{{ route('memorie.index') }}">閲覧</a>
    <!-- ↓ログアウト処理 -->
    <a href="{{ route('memorie.logout') }}" onclick="return confirm('ログアウトしますか？')">ログアウト</a>
</h2>

<br>
<br>
<br>

<!-- ↓メモ更新処理 -->
<form action="{{ route('memorie.update', $memorie->id) }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('更新しますか？')">
    @csrf

    @method('PUT')

    <h3>
        メモタイトル <input type="text" name="title" minlength="5" maxlength="10" placeholder="5～10文字以内" value="{{ old('titlename', $memorie->titlename) }}" class="text2" required>
    </h3>

    <h3>
        メモ <textarea name="memo"minlength="1" maxlength="1000" placeholder="1～1000文字以内" rows="25" cols="100" class="text2" required>{{ old('message', $memorie->message) }}</textarea>
    </h3>

    <!-- メモ帳開発でのアドバイス -->
    <!-- 画像更新のときに画像の更新をするのかの処理がほしい。 -->
    
    <!-- 画像 -->

    <!-- ↓画像1があるのかを真偽判定しています。 -->
    @if ($memorie->image_name_1)
        <h3>
            <img src="{{ asset(str_replace('storage/app/public/', 'storage/', $memorie->image_name_1)) }}" height="250" width="300" alt="画像">
        </h3>
    @endif
        
    <h3>
        画像1 <input type="file" name="img1">
    </h3>

    <!-- ↓画像2があるのかを真偽判定しています。 -->
    @if ($memorie->image_name_2)
        <h3>
            <img src="{{ asset(str_replace('storage/app/public/', 'storage/', $memorie->image_name_2)) }}" height="250" width="300" alt="画像">
        </h3>
    @endif 

    <h3>
        画像2 <input type="file" name="img2">
    </h3>

    <!-- ↓画像3があるのかを真偽判定しています。 -->
    @if ($memorie->image_name_3)
        <h3>
            <img src="{{ asset(str_replace('storage/app/public/', 'storage/', $memorie->image_name_3)) }}" height="250" width="300" alt="画像">
        </h3>
    @endif

    <h3>
        画像3 <input type="file" name="img3">
    </h3>

    <h3>
        <button type="submit" class="submit2">更新</button>
    </h3>

    
</form>

<!-- ↓メモ削除処理 -->
<form action="{{ route('memorie.destroy', $memorie->id) }}" method="post" onsubmit="return confirm('削除しますか？')">
    @csrf

    @method('DELETE')

    <h3>
        <button type="submit" class="submit2">削除</button>
    </h3>
</form>

@endsection