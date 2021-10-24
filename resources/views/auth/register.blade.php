@extends('layouts.app')


@section('navbar')
<a href="/" class="navbar-item"><i class="fas fa-home"></i></a>
@endsection

@section('content')
  
<div class="box">
@foreach($errors->all() as $error)
  <li>{{ $error }}</li>
@endforeach
  <form method="POST" action="{{ route('register') }}">
      @csrf
      
        <label for="name">ユーザー名</label>
        <input class="input" type="text" id="name" name="name" required value="{{ old('name') }}">
       
      
     
        <label for="email">メールアドレス</label>
        <input class="input" type="text" id="email" name="email" required value="{{ old('email') }}" >
    
        <label for="password">パスワード</label>
        <input class="input" type="password" id="password" name="password" required>
     
        <label for="password_confirmation">パスワード(確認)</label>
        <input class="input" type="password" id="password_confirmation" name="password_confirmation" required>
    
      <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
    </form>

    <div class="mt-0">
      <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
    </div>
              
</div>
  
          
@endsection
