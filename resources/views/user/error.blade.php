<!-- ログイン前エラー画面 -->

@extends('layout.userapp')

@section('content')

<h1>エラー</h1>

<!-- ↓ログイン画面 -->
<h2><a href="{{ route('user.index') }}">ログイン</a></h2>

<br>
<!-- ↓リンクエラーなのかを真偽判定しています。 -->
@if (session('value') == '1')
    <h3 class="errorfont">リンクによるエラーです。</h3>
    <h3 class="errorfont">000-0000-0000</h3>
    <h3 class="errorfont">この電話番号にご連絡ください。</h3>
<!-- ↓原因不明エラーなのかを真偽判定しています。 -->
@elseif (session('value') == '3')
    <h3 class="errorfont">原因不明操作によるエラーです。</h3>
    <h3 class="errorfont">000-0000-0000</h3>
    <h3 class="errorfont">この電話番号にご連絡ください。</h3>
@endif

@endsection