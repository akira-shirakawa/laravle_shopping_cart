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

<article class="message">
            <div class="message-header">データ検索</div>
            <div class="message-body">
                <form action="/search" method="get">
                    <div class="columns">
                        <div class="column">
                            <p>comment</p>
                            <input type="text" name="comment" class="input" value="{{session('comment')}}">
                            
                            
                            <div class="columns">
                                <div class="column">
                                    <p>作成日で絞り込み　</p>
                                <input type="datetime-local" name="created_at_from" value ="{{session('created_at_from')}}">
                                <p>更新日時で絞り込み</p>
                                <input type="datetime-local" name="updated_at_from" value ="{{session('updated_at_from')}}">
                                </div>
                                <div class="column">
                                    <p>to</p>
                                <input type="datetime-local" name="created_at_to" value ="{{session('created_at_to')}}">
                                    <p>to</p>
                                <input type="datetime-local" name="updated_at_to" value ="{{session('updated_at_to')}}">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            
                            <div class="columns">
                                <div class="column">
                                        <p>集計数(from)</p>
                                    <input type="number" name="count_from" class="input" value="{{session('count_from')}}">
                                        <p>集計結果(from)</p>
                                    <input type="number" name="sum_from" class="input" value="{{session('sum_from')}}">
                                </div>
                                <div class="column">
                                    <p>集計数(to)</p>
                                        <input type="number" name="count_to" class="input" value="{{session('count_to')}}">
                                    <p>集計結果(to)</p>
                                        <input type="number" name="sum_to" class="input" value="{{session('sum_to')}}">
                                        <input type="submit" class="button" value="検索">
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </form>
            </div>
        </article>
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