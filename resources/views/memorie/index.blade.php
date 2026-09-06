<!-- 閲覧画面 -->

@extends('layout.memorieapp')

@section('content')

<!-- メモ帳開発でのアドバイス -->
<!-- メモを更新したときのアクションが閲覧画面にほしい。 -->

<!-- ↓ログインをしたのかを真偽判定しています。 -->
@if (Auth::check() && session('count'))
    <script>
        alert('ようこそ、{{ Auth::user()->name }}さん');
    </script>
@endif

<!-- メモ帳開発でのアドバイス -->
<!-- 成功アラートではなく別の成功アクションをすれば良い。 -->

<!-- ↓メモ新規作成、更新が成功したのかを真偽判定しています。 -->
@if (session('insertupdatedeletemessage'))
    <script>
        alert('{{ session('insertupdatedeletemessage') }}');
    </script>
@endif

<h1>閲覧</h1>

<h2>
    <!-- ↓閲覧画面 -->
    <a href="{{ route('memorie.index') }}">閲覧</a>
    <!-- ↓ログアウト処理 -->
    <a href="{{ route('memorie.logout') }}" onclick="return confirm('ログアウトしますか？')">ログアウト</a>
</h2>

<!-- ↓検索処理 -->
<form action="{{ route('memorie.search') }}" class="search" method="get">
    <input type="text" name="searchname" placeholder="メモタイトル" class="text2" required>
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

<!-- メモ帳開発でのアドバイス -->
<!-- メモ作成リンクは上下にあったほうがいい。 -->
<h3>
    <!-- ↓ユーザー新規登録画面 -->
    <a href="{{ route('memorie.create') }}">メモ作成</a>
</h3>

@endsection