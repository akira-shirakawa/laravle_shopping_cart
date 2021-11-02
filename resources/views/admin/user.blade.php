
@extends('layouts.app')

@section('navbar')
<a class="navbar-item" href="./home">
カテゴリー登録
</a>
@endsection
@section('content')

<table class="table ">
<tr><th>ユーザー名</th><th>作成日</th><th>登録カート個数</th></tr>
@foreach($users as $value)
<tr>
    <td>{{$value->name}}</td>
    <td>{{$value->created_at}}</td>
    <td>{{$value->carts->count()}}</td>
    <td>
       
</tr>
@endforeach
</table>
@endsection   
