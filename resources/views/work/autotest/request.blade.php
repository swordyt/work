<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="pragma" content="no-cache"> 
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
    <meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
    <meta charset="UTF-8">
    <script src="{{url('js/jquery-1.12.0.min.js')}}"></script>
    <script src="{{url('js/jquery-tmpl-master/jquery.tmpl.js')}}" type="text/javascript" ></script>
    <link type="text/css" href="{{url('css/main.css')}}" rel="stylesheet" >
    <script>
        $(document).ready(
                function(){
                    function getLogs(){
                            $.ajax({
                                    type:'get',
                                    url:"{{url('work/ajax/logs/debug')}}",
                                    data:{
                                        id:this.name,
                                    },
                                    cache:false, 
                                    datatype:'json',
                                    success:function(data){
                                        $('#logs').html(data);
                                    }
                            });
                        }
                    var wait=null;
                    $(".left a").click(function(){
                        $.ajax({
                            type:'get',
                            url:"{{url('work/ajax/set/')}}"+"/"+this.id,
                            data:{
                                id:this.id,
                            },
                            cache:false,
                            datatype:'json',
                            success:function(data){
                                $("#setmsg").tmpl(data).appendTo("table");
                            }
                        });
                    });
                    $("table").delegate("a[title=qx]","click",function(){
                        $(this).parent().parent().remove();
                    });
                    $("table").delegate("a[title=zx]","click",function(){
                        clearInterval(wait);
                        wait = setInterval(getLogs,1000);
                        $('#exceset').append("<li><a href='#'>"+this.name+"</a></li>");
                    });
                    $("#exceset").delegate("a","click",function(){
                        clearInterval(wait);
                        wait = setInterval(getLogs,1000);
                    });
                }
        );
    </script>
    <title>AutoTest</title>
</head>
<body>
<div class="body">
<div class="nav">
    <ul>
        <li><a href="{{url('work/autotest')}}">首页</a></li>
        <li><a href="#">集合</a></li>
        <li><a href="{{url('work/autotest/request/'.DB::table('interrequests')->min('id'))}}">请求</a></li>
        <li><a href="#">检查点</a></li>
        <li><a href="#">数据源</a></li>
        <li><a href="#">配置</a></li>
    </ul>
    </div>
    <div class="head">
       <H3>自动化测试概述</H3>
        </div>
    <div class="left">
       <h4>测试集合列</h4>
        <ol>
        <!-- set列表 -->
        @foreach(App\Set::all() as $set)
        <li><a href="#" id="{{$set->id}}">{{$set->name}}</a></li>
        @endforeach
        </ol>
    </div>
    <div class="right">
    <table border="1">
        <caption><h4>执行测试集</h4></caption>
        <tr>
            <th>测试集</th>
            <th>接口数</th>
            <th>执行次数</th>
            <th>检查点</th>
            <th>检查点执行轮数</th>
            <th>操作</th>
        </tr>
        <!-- 被选择将要执行的set -->
        <script type="text/x-jquery-tmpl" id="setmsg">
            <tr>
                <td><a href="#${setid}" target="_blank">${setname}</a></td>
                <td>${reqnum}</td>
                <td>${execnum}</td>
                <td><input type="checkbox" name="" id="exec"><label for="exec">执行检查点</label></td>
                <td>${checkexecnum}</td>
                <td><a href="#zx" name="${setname}" title="zx">执行</a><a href="#qx" name="qx" title="qx">取消</a></td>
            </tr>
        </script>
    </table>
    <ol>
        <li></li>
    </ol>
    </div>
    <div class="clear"></div>
    <div class="control">
        <fieldset>
            <legend >Control</legend>
            <textarea rows="25" disabled id="logs">
            </textarea>
            <div>
                <ul id="exceset">
                    <!-- 正在执行的set -->
                </ul>
            </div>
        </fieldset>
    </div>
</div>
</body>
</html>