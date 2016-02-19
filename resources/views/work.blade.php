<!DOCTYPE html>
<html lang="utf-8">
<head>
	<meta http-equiv="pragma" content="no-cache"> 
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PingAn</title>
	<link type="image/x-icon" rel="shortcut icon" href="favicon.ico">
	<link type="image/x-icon" rel="bookmark" href="favicon.ico">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="{{asset('My97DatePicker/WdatePicker.js')}}"></script>
	<link href="{{asset('My97DatePicker/skin/WdatePicker.css')}}" rel="stylesheet" type="text/css">
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var val=$("#mobile").val();
                if(checkSubmitMobil()){
                    $.ajax({
                        type:"get",
                        url:"{{url('work/ajax/verification?phone=')}}"+val,
                        data:{},
                        cache:false,
                        success:function(data){
                            $("#verification").html(data);
                        },
                    });
                }
            });
        });
        function checkSubmitMobil() {
            var isPhone = /\d{11}/;
            if ($("#mobile").val() == "") {
                alert("手机号码不能为空！");
                $("#mobile").focus();
                return false;
            }
            if (!isPhone.test($("#mobile").val())) {
                alert("手机号码格式不正确！");
                $("#mobile").focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">PingAn</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ asset('/work/date') }}">Query</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	@yield('content')

	
</body>
</html>
