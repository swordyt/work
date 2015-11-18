<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>快网</title>
	<link href="/css/app.css" rel="stylesheet">
	<!-- Fonts -->
  <link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

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
				<a class="navbar-brand" href="#">CDN缓存刷新</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
					<li><a href="{{url('/flush')}}">蓝迅</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{URL('/flush/cloud')}}">快网</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
						@if (count($errors) > 0)
						<div class="alert alert-danger">
							<h5>Prompt：</h5>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
	
	
	
<form action="{{url('flush/cloud')}}" method="post" class="form-horizontal" role="form">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
							<label class="col-md-4 control-label">appid:</label>
							<div class="col-md-6">
							<input type="text" name="appid" class="form-control" />
							</div>
						</div>
	<div class="form-group">
							<label class="col-md-4 control-label">appsecret:</label>
							<div class="col-md-6">
							<input type="password" name="appsecret" class="form-control"/>
							</div>
						</div>
		<div class="form-group">
							<label class="col-md-4 control-label">files:</label>
							<div class="col-md-6">
							<textarea  name="files" rows="3" class="form-control" ></textarea>
							</div>
						</div>
	
	
							<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">刷新</button>
							</div>
						</div>
</form>


</body>
</html>