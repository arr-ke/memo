<!-- ログイン後エラー画面 -->

@extends('layout.userapp')

@section('content')

<h1>エラー</h1>

<h2>
    <!-- ↓閲覧画面 -->
    <a href="{{ route('memorie.index') }}">閲覧</a>
    <!-- ↓ログアウト処理 -->
    <a href="{{ route('memorie.logout') }}" onclick="return confirm('ログアウトしますか？')">ログアウト</a>
</h2>

<br>
<!-- ↓リンクエラーなのかを真偽判定しています。 -->
@if (session('value') == '1')
    <h3 class="errorfont">リンクによるエラーです。</h3>
    <h3 class="errorfont">000-0000-0000</h3>
    <h3 class="errorfont">この電話番号にご連絡ください。</h3>
<!-- ↓ボタン操作エラーなのかを真偽判定しています。 -->
@elseif (session('value') == '2')
    <h3 class="errorfont">ボタン操作によるエラーです。</h3>
    <h3 class="errorfont">000-0000-0000</h3>
    <h3 class="errorfont">この電話番号にご連絡ください。</h3>
<!-- ↓原因不明エラーなのかを真偽判定しています。 -->
@elseif (session('value') == '3')
    <h3 class="errorfont">原因不明操作によるエラーです。</h3>
    <h3 class="errorfont">000-0000-0000</h3>
    <h3 class="errorfont">この電話番号にご連絡ください。</h3>
@endif


@endsection