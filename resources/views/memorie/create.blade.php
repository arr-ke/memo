<!-- メモ新規作成画面 -->

@extends('layout.memorieapp')

@section('content')

<!-- ↓メモの新規作成に失敗したのかを真偽判定しています。 -->
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

<!-- ↓メモ新規作成処理 -->
<form action="{{ route('memorie.store') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('作成しますか？')">
    @csrf
    <h3>
        メモタイトル <input type="text" name="title" minlength="5" maxlength="10" placeholder="5～10文字以内" class="text2" required>
    </h3>

    <h3>
        メモ <textarea name="memo"minlength="1" maxlength="1000" placeholder="1～1000文字以内" rows="25" cols="100" class="text2" required></textarea>
    </h3>

    <h3>
        画像1 <input type="file" name="img1">
    </h3>

    <h3>
        画像2 <input type="file" name="img2">
    </h3>

    <h3>
        画像3 <input type="file" name="img3">
    </h3>

    <h3>
        <button type="submit" class="submit2">作成</button>
    </h3>
</form>

@endsection