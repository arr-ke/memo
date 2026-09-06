<!-- ログイン画面 -->

@extends('layout.userapp')

@section('content')

<!-- メモ帳開発でのアドバイス -->
<!-- 成功アラートではなく別の成功アクションをすれば良い。 -->

<!-- 失敗、登録メッセージ表示処理 -->
@if (session('errorinsertmessage'))
    <script>
        alert("{{ session('errorinsertmessage') }}");
    </script>
@endif

<!-- ログアウトメッセージ表示処理 -->
@if (session('logoutmessage'))
    <script>
        alert("{{ session('logoutmessage') }}");
    </script>
@endif

<h1>ログイン</h1>

<br>
<br>
<br>

<!-- ↓ログイン画面 -->
<form action="{{ route('user.login') }}" method="post">
    @csrf

    <h3>
        ID <input type="text" name="name" class="text1" required>
    </h3>

    <h3>
        PW <input type="password" name="pw" class="text2" required>
    </h3>

    <br>
    
    <h3>
    <button type="submit" class="submit">ログイン</button>
    </h3>
</form>

<h3>
    <!-- ↓ユーザー新規登録画面 -->
    <a href="{{ route('user.create') }}">ユーザー新規登録</a>
</h3>

@endsection