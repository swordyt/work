<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>玄天剑宗</title>
        <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
        <link type="image/x-icon" rel="bookmark" href="favicon.ico">
        <link href="{{url('css/header.css')}}" rel="stylesheet" type="text/css" />
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<style>
        body{
            background: url('{{url('cat.jpg')}}') 0 0 repeat;
            height:930px ;
            color: #080808;
        }
</style>
<body>
    <div class="head">
        <a href="/"><img src="{{url('xtjz04.gif')}}" alt="玄天剑宗"/></a>
    </div>
    <div class="body">
        <nav class="nav">
            <ul>
                <li><a href="#home">前往宗门</a></li>
                <li><a href="#news">前往藏书阁</a></li>
                <li><a href="#contact">前往任务部</a></li>
                <li><a href="#about">前往比武场</a></li>
                <li><a href="#about">前往理事部</a></li>
            </ul>
        </nav>
        <hr class="hr"/>

        @yield('content')
        
<div class="footer">
    <hr style="margin-top:510px;margin-bottom: 5px " />
             <p >
                  © 2010-2015 FishC.com GMT+8, 2015-11-20 13:56 Powered by Discuz! X2.5 Theme by dreambred
             </p>
</div>
        
        </div>
    </body>
</html>