
@extends('layouts.app')
@section('navbar')
<a class="navbar-item" href="/">
<i class="fas fa-home"></i>
</a>
@endsection
@section('content')
    <p class="is-size-3 has-text-centered">商品登録</p>
    <div class="box">
        <form enctype="multipart/form-data" action="/item/update" method="post">
        @csrf
            <p>商品名</p>
            <input type="text" class="input" id="js-text1" name="name" value="{{$item->name}}" required>
            <p>キャプション</p>
            <input type="text" class="input" id="js-text2" name="caption" value="{{$item->caption}}" required>
            <p>値段</p>
            <input type="number" class="input" id="js-number1" name="price" value="{{$item->price}}" required>
            <input type="hidden" name="user_id" value="{{auth::user()->id}}">
            <input type="hidden" name ="item_id" value="{{$item->id}}">
            <p>カテゴリー</p>
            <select name="category_id">
                @foreach($categories as $value)
                @if($item->category->category == $value->category)
                <option value="{{$value->id}}" selected>{{$value->category}}</option> 
                @else
                <option value="{{$value->id}}">{{$value->category}}</option>
                @endif
                @endforeach
            </select>
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
   
@endsection   
