<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <link href="{{url('css/main.css')}}" rel="stylesheet" type="text/css">
    <script src="{{url('js/jquery-1.12.0.min.js')}}"></script>
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
        <ol>
        @foreach(DB::table('interrequests')->get() as $request)
          <li><a href="{{url('work/autotest/request/'.$request->id)}}" target="_self">{{$request->name}}</a>&nbsp &nbsp5</li>
        @endforeach
      </ol>
    </div>
    <div class="right">
        <div class="right_s">
            <form method="post" action="#">
                <div>
                    <label for="reqname">请求名：</label>
                    <input type="text" id="reqname" width="10px" />
                    <label for="newfield">新增字段名：</label>
                    <input type="text" name="field" ID="newfield">
                    <input type="button" id="addfield" value="增加">
                </div>
                <div class="field">
                    <label for="reqfield">请求字段：</label>
                    <h4>domain</h4>
                    <h4>url</h4>
                    <h4>userid<a href="#"></a></h4>
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
				@foreach(array_keys($data[0]) as $key)
					<th>{{$key}}</th>
				@endforeach
				<th>操作</th>
			</tr>
			@foreach($data as $row)
			<tr>
				@foreach($row as $key=>$value)
					<td><input type="text" value="{{$value}}" disabled="true"></td>
				@endforeach
				<td name="handle"><a href="#" name="edit">编辑</a><a href="#" name="qx">取消</a></td>
			</tr>
			@endforeach
			<tr>
			@foreach(array_keys($data[0]) as $key)
				<td><input type="text" name="{{$key}}"></td>
			@endforeach
				<td name="handle"><a href="#" name="addnew">新增</a></td>
			</tr>
        </table>
    </fieldset>
    </div>
</div>
</body>
</html>
</body>
</html>