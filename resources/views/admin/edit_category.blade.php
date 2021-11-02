
@extends('layouts.app')

@section('navbar')
<a class="navbar-item" href="/">
カテゴリー登録
</a>
@endsection
@section('content')
<h2>カテゴリー登録</h2>
<form action="../../../admin/category/update" method="post">
@csrf
<input type="hidden" value="{{$category->id}}" name="id">
<input type="text" class="input" name="category"  value="{{$category->category}}" required>
<input type="submit" value="送信" class="button">
</form>

@endsection   
