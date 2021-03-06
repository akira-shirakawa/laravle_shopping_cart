@extends('layouts.appadmin')

@section('navbar')
<a href="/" class="navbar-item"><i class="fas fa-home"></i></a>
@endsection

@section('content')
  
<div class="box">
@foreach($errors->all() as $error)
  <li>{{ $error }}</li>
@endforeach
  <form method="POST" action="{{ route('admin.login') }}">
      @csrf
 
        <label for="email">メールアドレス</label>
        <input class="input" type="text" id="email" name="email" required value="{{ old('email') }}" >
    
        <label for="password">パスワード</label>
        <input class="input" type="password" id="password" name="password" required>
     
      <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
    </form>

    
              
</div>
  
          
@endsection
