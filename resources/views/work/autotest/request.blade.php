<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <link href="main.css" rel="stylesheet" type="text/css">
    <script src="jquery-1.12.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#addfield").click(function(){
                $(".field").append("<h4>"+$("input[name=field]").val()+"<a href='#'></a></h4>");
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange=function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    }
                }
            });
            $(".field").delegate("h4 a","click",function(){
                $(this).parent().remove();
            });
            $("table").delegate("a","click",function(){
//                alert(this.name);
                name = $(this).attr("name");
                if(name == "edit"){
                    alert("edit");
                }
                if(name == "save"){
                    alert("save");
                }
                if(name == "addnew"){
                    var data;
                    $(".field h4").each(function(){
                        var fieldname=this.innerText;

                            });
                    $.ajax({
                        type:'post',
                        url:'http://laravel.sword.qa.anhouse.com.cn/work/ajax/adddata',
                        data:{

                        },
                    });
                    $(this).parent("td").parent("tr").before("<tr><form method='get' action='#'>"+
                            "<td><input type=\"text\" value=\"request\" disabled=\"true\"></td>"+
                            "<td><input type=\"text\" value=\"www.baidu.com\" disabled=\"disabled\"></td>"+
                            "<td><input type=\"text\" value=\"/url\" disabled=\"disabled\"></td>"+
                            "<td name=\"handle\"><a href=\"#\" name=\"edit\">编辑</a><a href=\"#\" name=\"qx\">取消</a></td>"+
                            "</form></tr>");
                }
                if(name == "qx"){
                    $(this).parent().parent().remove();
                }
            })
        });
    </script>
    <title>AutoTest</title>
</head>
<body>
<div class="body">
    <div class="head">
        <H3>请求实体构建</H3>
    </div>
    <div class="left">
        <h4>测试请求列</h4>
        @if(count(InterRequest::all())>0)
        @foreach($requests as InterRequest::all())
        <li><a href="{{url("work/autotest/showrequest/".$request.id)}}" name="{{$request->id}}">{{$request->name}}</a>&nbsp &nbsp5</li>
        @endforeach
        @endif
    </div>
    <div class="right">
        <div class="right_s">
            <form method="post" action="#">
                <div>
                    <label for="reqname">请求名：</label>
                    <input type="text" id="reqname" width="10px" disabled="disabled" value="{{$request->name}}" />
                    <label for="newfield">新增字段名：</label>
                    <input type="text" name="field" ID="newfield">
                    <input type="button" id="addfield" value="增加">
                </div>
                <div class="field">
                    <label for="reqfield">请求字段：</label>
                    @if(count($request->getFields())>0)
                    @foreach($request->getFields() as field)
                    <h4></h4>
                    @endforeach
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
    <div class="bottom">
    <fieldset>
        <legend>请求数据</legend>
        <table border="1"     cellspacing= "0 " cellpadding= "0 ">
            <tr>
                @if(count($request->getFields())>0)
                @foreach($request->getFields() as field)
                    <th>{{$field->name}}</th>
                @endforeach
                @endif
                <th>操作</th>
            </tr>
            <tr>
                <td><input type="text" value="request" disabled="true"></td>
                <td><input type="text" value="www.baidu.com" disabled="disabled"></td>
                <td><input type="text" value="/url" disabled="disabled"></td>
                <td name="handle"><a href="#" name="edit">编辑</a><a href="#" name="qx">取消</a></td>
            </tr>
            <tr>
                <td><input type="text" value="request" disabled=""></td>
                <td><input type="text" value="www.baidu.com" disabled=""></td>
                <td><input type="text" value="/url" disabled=""></td>
                <td name="handle"><a href="#" name="save">保存</a><a href="#" name="qx">取消</a></td>
            </tr>
            <tr>
                <td><input type="text" name=""></td>
                <td><input type="text"></td>
                <td><input type="text"></td>
                <td name="handle"><a href="#" name="addnew">新增</a></td>
            </tr>
        </table>
    </fieldset>
    </div>
</div>
</body>
</html>