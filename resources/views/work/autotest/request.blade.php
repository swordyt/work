<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <script src="{{url('js/jquery-1.12.0.min.js')}}"></script>
    <script src="{{url('js/jquery-tmpl-master/jquery.tmpl.js')}}" type="text/javascript" ></script>
    <link type="text/css" href="{{url('css/main.css')}}" rel="stylesheet" >
    <script>
        $(document).ready(
                function(){
                    $(".left a").click(function(){
//                        xmlhttp=new XMLHttpRequest();
//                        xmlhttp.onreadystatechange = function(){
//                            if(xmlhttp.readyState==4 &&　xmlhttp.status == 200){
//                                $("table").append(xmlhttp.responseText);
//                            }
//                        }
//                        xmlhttp.open("GET","get.html?id="+this.name,true);
//                        xmlhttp.send();
                        $.ajax({
                            type:'get',
                            url:"{{url('work/ajax/set/')}}"+this.name,
                            data:{
                                id:this.name,
                            },
                            cache:false,
                            datatype:'json',
                            success:function(data){
                                $("#setmsg").tmpl(data).appendTo("table");
                            }
                        });
                    });
                    $("table").delegate("a[name=qx]","click",function(){
                        $(this).parent().parent().remove();
                    })
                }
        );
    </script>
    <title>AutoTest</title>
</head>
<body>
<div class="body">
    <div class="head">
       <H3>自动化测试概述</H3>
        </div>
    <div class="left">
       <h4>测试集合列</h4>
        <ol>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
            <li><a href="#" name="1">test</a></li>
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
        <tr>
            <td><a href="#" target="_blank">test</a></td>
            <td>4</td>
            <td>5</td>
            <td><input type="checkbox" name="" id="exec"><label for="exec">执行检查点</label></td>
            <td>3</td>
            <td><a href="#" name="zx">执行</a><a href="#" name="qx">取消</a></td>
        </tr>
        <script type="text/x-jquery-tmpl" id="setmsg">
            <tr>
                <td><a href="#"+${setid} target="_blank">${setname}</a></td>
                <td>${reqnum}</td>
                <td>${execnum}</td>
                <td><input type="checkbox" name="" id="exec"><label for="exec">执行检查点</label></td>
                <td>${checkexecnum}</td>
                <td><a href="#" name="zx">执行</a><a href="#" name="qx">取消</a></td>
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
            <textarea rows="20" disabled>
                日志显示
            </textarea>
            <div>
                <ol>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                </ol>
            </div>
        </fieldset>
    </div>
</div>
</body>
</html>