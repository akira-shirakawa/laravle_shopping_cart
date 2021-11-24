
@extends('layouts.appadmin')

@section('navbar')
<a class="navbar-item" href="./home">
カテゴリー登録
</a>
@endsection
@section('content')
<p class="hit">ユーザを検索</p>
<div  class="search_box">
    <input  class="input is-rounded ds-input" id="js-input3" type="text" placeholder="Search the User" >
    <!-- <button id="js-ajax-button" class="button is-rounded" ><i class="fas fa-search"></i></button> -->
    
</div>
<table class="table ">
<tr><th>ユーザー名</th><th>作成日</th></tr>
@foreach($users as $value)
<tr>
    <td>{{$value->name}}</td>
    <td>{{$value->created_at}}</td>
   
    <td>
       
</tr>
@endforeach
</table>
@endsection   
@section('src')
<link rel="stylesheet" href="{{asset('/css/element.css')}}">
<script src="{{ asset('/js/search_ajax.js') }}"></script>
@endsection