<!-- 検索画面 -->

<!-- メモ帳開発でのアドバイス
     ➀検索機能はタイトル機能だけではなく、本文検索したほうがいい。
     ➁検索機能で、タイトルと本文の検索それぞれにヒットした数をカウントしてほしい。（あとヒットした部分にも色をつけてほしい。）　-->

@extends('layout.memorieapp')

@section('content')

<!-- ↓メモ新規作成、更新が成功したのかを真偽判定しています。 -->
@if (session('insertupdatedeletemessage'))
    <script>
        alert('{{ session('insertupdatedeletemessage') }}');
    </script>
@endif

<h1>検索画面</h1>

<h2>
    <!-- ↓閲覧画面 -->
    <a href="{{ route('memorie.index') }}">閲覧</a>
    <!-- ↓ログアウト処理 -->
    <a href="{{ route('memorie.logout') }}" onclick="return confirm('ログアウトしますか？')">ログアウト</a>
</h2>

<!-- ↓検索処理 -->
<form action="{{ route('memorie.search') }}" class="search" method="get">
    <input type="text" name="searchname" value="{{ $memotitlename }}" placeholder="メモタイトル" class="text2" required>
    <button type="submit" class="submit1">検索</button>
</form>

<br>
<br>
<br>

<!-- ↓ログイン画面 -->
@foreach ($memories as $memorie)
    <!-- ↓ログインユーザーの値とユーザが作った作品の値なのかを真偽判定しています。 -->
    @if ($memorie->user_id == Auth::user()->id)
        <h3 class="text1">
            <!-- ↓メモ編集画面 -->
            <a href="{{ route('memorie.edit', $memorie->id) }}">
                {{ $memorie->created_at->format('Y年m月d日') }}　{{ $memorie->titlename }}
            </a>
        </h3>
    @endif
@endforeach

<h3>
    <!-- ↓ユーザー新規登録画面 -->
    <a href="{{ route('memorie.create') }}">メモ作成</a>
</h3>

@endsection