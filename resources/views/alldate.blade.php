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
        
    </div>


       

    @if ($pureDates->count() > 0)
        <div class="pagination">
            <a href="{{ $pureDates->previousPageUrl() }}" rel="prev" aria-label="前の日へ" class="pagination-arrow">◀</a>
            <h1>{{ $pureDates->first()->start_time->format('Y年m月d日') }}</h1>
            <a href="{{ $pureDates->nextPageUrl() }}" rel="next" aria-label="次の日へ" class="pagination-arrow">▶</a>
        </div>
    @endif



        <div class="date_table">
        <table class="attendance_date_table">
    <tr>
        <th class="working_date">名前</th>
        <th class="working_date">勤務開始時間</th>
        <th class="working_date">勤務終了時間</th>
        <th class="working_date">合計労働時間</th>
        <th class="working_date">休憩時間合計時間</th>
    </tr>

    @foreach($pureDates as $pureDate)
        <tr>
            @php
                $user = $pureDate->user; // 純粋な日付データに関連付けられたユーザーを取得
            @endphp
            <td class="each_data">{{ $user->name }}</td>
            <td class="each_data">{{ $pureDate->start_time }}</td>
            <td class="each_data">{{ $pureDate->end_time }}</td>
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




</body>
</html>
