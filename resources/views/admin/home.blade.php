
@extends('layouts.appadmin')

@section('navbar')
<a class="navbar-item" href="./user">
ユーザー一覧
</a>
@endsection
@section('content')
<h2>カテゴリー登録</h2>
<form action="./category" method="post">
@csrf
<p id="js-ajax-alert"></p>
<input type="text" class="input" name="category" id="js-ajax-target" required>
<input type="submit" value="送信" class="button js-ajax-hide">
</form>
<table class="table">
<tr><th>カテゴリー</th><th>作成日</th><th>使用アイテム個数</th></tr>
@foreach($categories as $value)
<tr>
    <td>{{$value->category}}</td>
    <td>{{$value->created_at}}</td>
    <td>{{$value->categories->count()}}</td>
    <td>
    @if($value->categories->count() == 0)
        <form action="./category/delete" method="post">
            @csrf
            <input type="hidden" value="{{$value->id}}" name="id">
            <input type="submit" value="消去" class="button is-danger">
        </form>
    @endif
    </td>
    <td><a class="button" href="./category/{{$value->id}}">編集</td>
</tr>
@endforeach
</table>
@endsection   
