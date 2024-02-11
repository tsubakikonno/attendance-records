<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">


    <link rel="stylesheet" href="css/atte.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header_logo_menu" >
    <header class="logo">Atte</header> 
    <header class=""><form action="/logout" method="post">
    @csrf
  <button class="logout_button">ログアウト</button>
  </form></header> 
  <a href="date" class="logo_menu">日付一覧</a>

</div>
    <div class="attendance_btn">
@if (Auth::check())
  <p class="user_name">{{$user->name}}さんおつかれ様です！</p>
@else
  <p>ログインしてください。（<a href="/login">ログイン</a>｜
  <a href="/register">登録</a>）</p>
@endif


<div class="attendance_box1">
    <form action="/workStart" method="post">
        @csrf
        <button id="workStart" class="attendance_box" {{ session('workStartDisabled') ? 'disabled' : '' }}>出勤開始</button>
    </form>

    <form action="/workEnd" method="post" >
        @csrf
        <button id="workEnd" class="attendance_box" {{ session('workEndDisabled') ? 'disabled' : '' }}>勤務終了</button>
    </form>

    <form action="/breakStart" method="post"  >
        @csrf
        <button id="breakIn" class="attendance_box" {{ session('breakInDisabled') ? 'disabled' : '' }}>休憩開始</button>
    </form>

    <form action="/breakEnd" method="post">
    @csrf
    <button id="breakOut" class="attendance_box" {{ session('breakOutDisabled') ? 'disabled' : '' }}>休憩終了</button>
</form>


    
</div>

  </div>
    
  
</body>

</html>