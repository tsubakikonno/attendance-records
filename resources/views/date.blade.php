<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/atte.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header_logo_menu">
        <header class="logo">Atte</header> 
        <header>
            <form action="/logout" method="post">
                @csrf
                <button class="logout_button">ログアウト</button>
            </form>
        </header> 
        <a href="/" class="logo_menu">勤怠</a>
    </div>

    <div class="attendance_btn">
        @if (Auth::check())
            <p class="user_name">{{$user->name}}さんおつかれ様です！</p>
        @else
            <p>ログインしてください。<a href="/login">ログイン</a>｜<a href="/register">登録</a></p>
        @endif

        <div class="date_table">
        <table class="attendance_date_table">
    <tr>
        <th class="working_date">勤務開始時間</th>
        <th class="working_date">勤務終了時間</th>
        <th class="working_date">合計労働時間</th>
        <th class="working_date">休憩時間合計時間</th>
    </tr>
   

    @foreach($pureDates as $pureDate)
        <tr>
            <td class="each_data">{{$pureDate->start_time}}</td>
            <td class="each_data">{{$pureDate->end_time}}</td>
             <td class="each_data">
            {{ floor($pureDate->work_total / 60) }}時間{{ $pureDate->work_total % 60 }}分
        </td>
        <td class="each_data">
            {{ floor($pureDate->break_total / 60) }}時間{{ $pureDate->break_total % 60 }}分
        </td>
        </tr>
        
    @endforeach
</table>
<h1 class="pagination-array">{{$pureDates->links('bootstrap-4')}}</h1>



        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/path/to/js/jquery.validate.min.js"></script>
    <script src="js/atte.js"></script>
</body>
</html>
