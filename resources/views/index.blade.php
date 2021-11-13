
@extends('layouts.app')
<div class="modal" id="edit-modal">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="box">

        <form action="/sale/update" method="post" id="js-edit-amount">
        @csrf
            <p class="is-size-3">個数を変更</p>
            <input type="number" value="" class="input js-sale-edit-target" name="amount" required>
            <input type="hidden" name="item_id" class="js-item_id" value="">
            <input type="submit" value="送信" class="button">
        </form>
    </div>
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>
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
<div class="modal" id="cart-modal">
  <div class="modal-background"></div>
  <div class="modal-content">
    <div class="box">

        <form action="/cart" method="post">
        @csrf
            <p class="is-size-3">カートに登録する前にコメントを入れてください</p>
            <input type="text" name="comment" class="input" required>
          
            <input type="submit" value="送信" class="button">
        </form>
    </div>
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>
@section('navbar')
    <a class="navbar-item" href="/item">
       item新規登録
    </a>
    <a class="navbar-item" href="/cart">
    <i class="fas fa-shopping-cart"></i>
    </a>
    <a class="navbar-item" href="/ajax">
   ajax通信確認
    </a>
@endsection
@section('content')
<p class="is-size-3 has-text-centered">商品一覧</p>
        <div class="wrapper">           
            @foreach($items as $value)
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="/uploads/{{$value->file_name}}" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <p class="is-size-4">{{$value->name}}</p>
                        <p>{{$value->caption}}</p>
                        <p class="has-text-centered has-text-danger">{{$value->price}}円</p>
                        <p>作成者：{{$value->user->name}}</p>
                        <p>カテゴリー:{{$value->category->category ?? '未分類'}}</p>
                        <button class="{{$value->id}} button is-success is-fullwidth has-text-centered js-add-target">add to cart<i class="fas fa-shopping-cart"></i></button>
                        
                    </div>
                </div>
            @endforeach  
        </div>
        <table class="table is-fullwidth">
            <tr><th>商品名</th><th>数量</th><th>単価</th><th>合計</th><th></th></tr>
            @foreach($sale as $value)
            <tr>
                <td>{{$value->item->name}}</td>
                <td>{{$value->amount}}</td>
                <td>{{$value->item->price}}</td>
                <td>{{$value->amount*$value->item->price}}</td>
                <td><button class="{{$value->id}} button is-success js-edit-target">編集</button><button class="<?php echo $value['id'] ?> button is-danger js-delete-target">消去</button></td>
               
            </tr>
            @endforeach
            <tr><td></td><td></td><td>カート合計</td><td><?php echo '¥'.number_format($sum) ?></td><td><button class="button js-cart-target-button is-hidden">カートを登録する</button></td></tr>
        </table>
    <form action="/sale" method="post" id="item">
        @csrf
        <input type="hidden" name="item_id" value="" id="item_id">
        <input type="hidden" name="user_id" value="" >
    </form>
  
    <form action="/sale/delete" method="post" class="form-js-delete-target">
    @csrf
        <input type="hidden" name="item_id" class="input-js-delete-target" value="" >
    </form>
@endsection   
