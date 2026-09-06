<!-- ユーザー新規登録画面 -->

@extends('layout.userapp')

@section('content')

<!-- 失敗メッセージ表示処理 -->
@if (session('errormessage'))
    <script>
        alert("{{ session('errormessage') }}");
    </script>
@endif

<h1>ユーザー登録</h1>

<br>
<br>
<br>

<!-- ↓ユーザー新規登録 -->
<form action="{{ route('user.store') }}" method="post">
    @csrf

    <h3>
        ID <input type="text" name="id" minlength="5" maxlength="10" pattern="^[a-zA-Z0-9]{5,10}" placeholder="5～10文字の半角英字のみ" class="text3" required>
    </h3>

    <h3>
        PW <input type="password" name="pw" minlength="10" maxlength="20" pattern="^[a-zA-Z0-9]{10,20}" placeholder="10～20文字の半角英字のみ" class="text4" required>
    </h3>

    <h3>
        PW確認 <input type="password" name="pwasr" minlength="10" maxlength="20" pattern="^[a-zA-Z0-9]{10,20}" placeholder="10～20文字の半角英字のみ" class="text5" required>
    </h3>
    <br>

    <h3>
    <button type="submit" class="submit">作成</button>
    </h3>
</form>

<h3>
    <!-- ↓ログイン画面 -->
    <a href="{{ route('user.index') }}">ログイン</a>
</h3>

@endsection