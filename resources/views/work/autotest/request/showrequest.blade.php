<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <link href="{{url('css/main.css')}}" rel="stylesheet" type="text/css">
    <script src="{{url('js/jquery-1.12.0.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#addfield").click(function(){
                $.ajax({
                    type:"get",
                    url:"{{url('work/autotest/createfield?id='.$id)}}"+"&name="+$('#newfield').val(),
                    data:{},
                    cache:false,
                    success:function(data){
                        $(".field").append("<h4>"+$("input[name=field]").val()+"<a href='{{url('work/autotest/modfield?id='.$id.'&fieldid=')}}"+data+"'></a></h4>");}
                    });
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
                    $('#adddata').submit();
                    // $(this).parent("td").parent("tr").before("<tr><form method='get' action='#'>"+
                    //         "<td><input type=\"text\" value=\"request\" disabled=\"true\"></td>"+
                    //         "<td><input type=\"text\" value=\"www.baidu.com\" disabled=\"disabled\"></td>"+
                    //         "<td><input type=\"text\" value=\"/url\" disabled=\"disabled\"></td>"+
                    //         "<td name=\"handle\"><a href=\"#\" name=\"edit\">编辑</a><a href=\"#\" name=\"qx\">取消</a></td>"+
                    //         "</form></tr>");
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
        <H3>请求实体构建</H3>
    </div>
    <div class="left">
        <h4>测试请求列</h4>
        <ol>
        @foreach(DB::table('interrequests')->get() as $request)
          <li><a href="{{url('work/autotest/request/'.$request->id)}}" target="_self">{{$request->name}}</a>&nbsp {{count(App\InterRequest::find($request->id)->Fields)}}</li>
        @endforeach
      </ol>
    </div>
    <div class="right">
        <div class="right_s">
            <form method="post" action="{{url('work/autotest/createrequest')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}" ></input>
                <div>
                    <label for="reqname">请求名：</label>
                    <input type="text" id="reqname" name="name" width="10px" value="@if(sizeof(App\InterRequest::find($id))>0){{App\InterRequest::find($id)->name}}@endif" />
                    <label for="newfield">新增字段名：</label>
                    <input type="text" name="field" ID="newfield">
                    <input type="button" id="addfield" value="增加">
                    <input type="submit" value="新建请求">
                </div>
                <div class="field">
                    <label for="reqfield">请求字段：</label>
                    @if(isset($fields) && sizeof($fields)>0)
                    <h4>{{$fields[1]->name}}</h4>
                    <h4>{{$fields[2]->name}}</h4>
                    <h4>{{$fields[3]->name}}</h4>
                    @for($i=4;$i<count($fields);$i++)
                     <h4>{{$fields[$i]->name}}<a href="{{url('work/autotest/modfield/'.$fields[$i]->id)}}"></a></h4>
                    @endfor
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
        @if(isset($fields)&&sizeof($fields)>0)
        	<tr>
				@foreach($fields as $field)
					<th>{{$field->name}}</th>
				@endforeach
				<th>操作</th>
			</tr>
			@foreach($data as $num=>$row)
			<tr>
				@foreach($row as $key=>$value)
					<td><input type="text" value="{{$value}}" disabled="true"></td>
				@endforeach
				<td name="handle"><a href="#" name="edit">编辑</a>
                <a href="{{URL('work/autotest/modrequestdata?id='.$id.'&row='.$num)}}" name="qx">取消</a>
                </td>
			</tr>
			@endforeach
			<tr>
            <form action="{{url('work/autotest/adddata?id='.$id)}}" method="post" id="adddata">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
			@foreach($fields as $field)
				<td><input type="text" name="{{$field->name}}"></td>
			@endforeach
				<!-- <td name="handle"><a href="{{url('work/autotest/request/'.$id)}}" name="addnew">新增</a></td> -->
                <td name="handle"><input type="submit" value="新增"></td>
            </form>
			</tr>
		 @endif
        </table>
    </fieldset>
    </div>
</div>
</body>
</html>
</body>
</html>