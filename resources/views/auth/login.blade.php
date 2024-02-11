<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/atte_auth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    
<header class="header_atte">
        Atte
</header>
<div class="atte">
<div class="information">

        
        @foreach ($errors as $error)
<p>{{$error}}</p>
@endforeach
<x-auth-validation-errors  :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <ul>

            <li class="information_each"><input id="email"  class="input_field" type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス" /></li>



            <li class="information_each"><input type ="password" id="password"　 class="input_field"
                placeholder="パスワード"　value="{{ old('password') }}"
                                name="password" 　
                                /></li>


<li class="information_each">
    <button class="button">{{ __('ログイン') }}</button>
        </form>
    </li>
    <li class="information_each">アカウントお持ちでない方はこちらから</li>
    <li class="information_each"><a class="" href="{{ route('register') }}">
                   会員登録
                </a></li>
        </ul>        
</div>
</div>

</body>

</html>