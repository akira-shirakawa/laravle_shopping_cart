<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" defer ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   
    <title>Document</title>
</head> 
<body>
<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
@guest
    <a href="/register" class="navbar-item">新規登録・ログイン</a>
@endguest
@auth
<a href="#" class="navbar-item">{{auth::user()->name}}</a>
<a href="#" class="navbar-item" id="logout">ログアウト</a>
<script>
   
</script>
<form  method="POST" action="{{ route('logout') }}" id="logout-form" class="is-hidden"> 
      @csrf 
      <input type="submit" class="button" value="ログアウト">
</form>   
@endauth
   @yield('navbar')
   
</nav>
<div class="columns">
    <div class="column"></div>
    <div class="column is-half">
        @yield('content')
    </div>
    <div class="column"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('/css/main.css')}}">
<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>