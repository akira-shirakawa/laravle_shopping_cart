
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
    <p class="is-size-3 has-text-centered">商品登録</p>
    <div class="box">
        <form enctype="multipart/form-data" action="/item" method="post">
        @csrf
            <p>商品名</p>
            <input type="text" class="input" id="js-text1" name="name" required>
            <p>キャプション</p>
            <input type="text" class="input" id="js-text2" name="caption" required>
            <p>値段</p>
            <input type="number" class="input" id="js-number1" name="price" required>
            <input type="hidden" name="user_id" value="{{auth::user()->id}}">
            <div class="file is-boxed">
                <label class="file-label">
                    <input class="file-input" type="file" name="image" id="file" >
                    <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-images"></i>
                    </span>
                    <span class="file-label">
                        画像を選択(任意)
                    </span>
                    </span>
                </label>
            </div>
            <input type="submit" value="送信" class="button">
        </form>       
    </div> 
    <p class="is-size-3 has-text-centered">商品一覧</p>
        <div class="wrapper"> 
        @foreach($item as $value)
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
                    <a class="button is-success is-full-width has-text-centered" href="/item/edit/{{$value->id}}">edit item</a>
                    <button class="{{$value->id}} button is-danger js-delete-target"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        @endforeach 
        </div>  
<form action="item/delete" method="post" class="form-js-delete-target">
@csrf
<input type="hidden" name="id" value="" class="input-js-delete-target">
</form> 

@endsection   
<script src="{{ asset('/js/item.js') }}"></script>