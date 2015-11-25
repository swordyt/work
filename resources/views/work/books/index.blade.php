<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>书是通向文明的桥梁</title>
	<script language="javascript" type="text/javascript" src="{{url('My97DatePicker/WdatePicker.js')}}"></script>
<!--<link href="{{url('image/books/title-picture.ico')}}" rel="shortcut icon"/>-->
<link rel="stylesheet" type="text/css" href="{{url('css/info1.css')}}"/>
<link href="{{url('My97DatePicker/skin/WdatePicker.css')}}" rel="stylesheet" type="text/css">
<!--<script language="javascript" type="text/javascript"  src="My97DatePicker/WdatePicker.js></script>  -->
<base target="_blank">
	<script>
		function Url(state){
				var el = document.getElementById('form');
				el.setAttribute("action","{{url('work/book')}}"+"/"+state);
			document.form.submit();
		}
	</script>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-size: 18px
		}
		</style>
</head>
<body>　
 	<div class="div1">
    <img src ="{{url('image/books/book.PNG')}}" />

    </div>
	<div class="div2" align="center" >
	　　<form id="form" method="post" name="form">
		<input type="hidden" name="_method" value ="PUT">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
	　　书名：<input type="text" name="bookname" required="required" >
		<BR><BR>
	　　姓名：<input type="text" name="remark" >
		<BR><BR>
		员工UM号：<input type="text" name="username" required="required">
		<BR><BR>
		借阅时间：<input  class="Wdate" type="text" onclick="WdatePicker()" name="borrowDate" required="required"><BR><BR>
		<div style="margin:0px">
		<input type="button" value="提交" onclick="Url('1')">
		<input type="reset"  value="重新填写">
		</div>
		<div style="margin-top:5px">
		<input type="button" value="还书" onclick="Url('2')">
		<input type="button" value="查看记录" onclick="Url('3')">
			</div>
		<br/>
</form>
			@if(count($errors) > 0)
			<div style="color:red">
					<strong>Whoops!</strong> <br><br>
						<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
			</div>
			@endif

	<marquee direction=right scrollamount=6 onmouseover="this.stop()" onmouseout="this.start()">
	<a href="http://www.w3school.com.cn/php/" ><img src="{{url('image/books/marquee_picture/php.PNG')}}"></a>
	<a href="http://www.runoob.com/java/java-tutorial.html"> <img src="{{url('image/books/marquee_picture/java.PNG')}}"></a>
	<a href="http://www.runoob.com/python/python-intro.html"><img src="{{url('image/books/marquee_picture/python.PNG')}}"></a>
	<a href="http://www.w3school.com.cn/html5/html_5_draganddrop.asp"><img src="{{url('image/books/marquee_picture/html5.PNG')}}"></a>
	<a href="http://www.runoob.com/cprogramming/c-tutorial.html"><img src="{{url('image/books/marquee_picture/c.PNG')}}"></a>
	<a href="http://www.phpstudy.net/e/asp/"><img src="{{url('image/books/marquee_picture/asp.PNG')}}"></a>
	<a href="http://www.w3school.com.cn/b.asp"><img src="{{url('image/books/marquee_picture/javascript.PNG')}}"></a>
	<a href="#"><img src="{{url('image/books/marquee_picture/ruby.PNG')}}"></a>
	<a href="#"><img src="{{url('image/books/marquee_picture/c++.PNG')}}"></a>
	</marquee>

</body>
</html>