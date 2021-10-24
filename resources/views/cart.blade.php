@extends('layouts.app')
@section('navbar')
<a class="navbar-item" href="/">
<i class="fas fa-home"></i>
</a>
@endsection
@section('content')
<div class="modal" id="delete-modal">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="notification has-text-centered">
        本当に削除しますか？</br>
        <button id="yes" class="button is-danger">はい</button>
        <button id="no" class="button" >いいえ</button>
    </div>
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>
<table class="table is-fullwidth">
    <tr><th>コメント</th><th>集計数</th><th>集計結果</th><th>作成日時</th><th>更新日時</th><th></th></tr>  
    @foreach($carts as $value)  
    <tr>
        <td>{{$value->comment}}</td>
        <td>{{$value->count}}</td>
        <td>{{ '¥'.number_format($value->sum) }}</td>
        <td>{{$value->created_at}}</td>                    
        <td>{{$value->updated_at}}</td>
        <td><button class="{{$value->id}} button is-danger js-delete-target">delete</button>
        <a href="/cart/{{$value->id}}" class="button is-info">update</a></td>                    
    </tr>   
    @endforeach
</table>
<form action="/cart/delete" method="post" class="form-js-delete-target">
@csrf
    <input type="hidden" name="cart_id" class="input-js-delete-target">
</form>
<script src="{{ asset('/js/cart.js') }}"></script>
@endsection