

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
        <!-- Validation Errors -->
        <x-auth-validation-errors  :errors="$errors" />

        <form method="POST" action="/register">
            @csrf
            <ul>
            <!-- Name -->
            <li class="information_each"><input id="name"  type="text" name="name" class="input_field" value="{{ old('name') }}" placeholder="名前"  /></li>
            <!-- Email Address -->
                <li class="information_each"><input id="email" class="input_field" type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス" /></li>
            <!-- Password -->
            <li class="information_each"><input id="password" class="input_field" type="password" name="password" placeholder="パスワード" value="{{ old('passeord') }}"
                               /></li>


            <!-- Confirm Password -->



            <li class="information_each">
                <input id="password_confirmation" 
                placeholder="確認パスワード"　 class="input_field"
                                type="password"
                                name="password_confirmation" /></li>
                                <li class="information_each"><button class="button" >
                    {{ __('会員登録') }}
                </button></li>

                <li class="information_each">アカウントお持ちの方はこちらから</li>
                <a class="" href="{{ route('login') }}">
                   ログイン
                </a>
        </form></ul>
</div>
</div>
</body>
</html>
