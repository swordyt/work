<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>蓝迅</title>
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
					<li><a href="{{url('/work/cc')}}">蓝迅</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{URL('work/cloud')}}">快网</a></li>
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
	
	
<form action="{{url('work/cc')}}" method="post" class="form-horizontal" role="form">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
							<label class="col-md-4 control-label">name:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" >
							</div>
						</div>
	
	
	<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
	
	
	
	
	<div class="form-group">
							<label class="col-md-4 control-label">url:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="url" >
							</div>
						</div>
	


	
		<div class="form-group">
							<label class="col-md-4 control-label">email:</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" >
							</div>
						</div>
	
	

	
			<div class="form-group">
							<label class="col-md-4 control-label">callback:</label>
							<div class="col-md-6">
								<select name="acptNotice" >
			<option value="true" selected="selected">ture</option>
			<option value="false"> false</option>
		</select>
							</div>
						</div>
	

			<div class="form-group">
							<label class="col-md-4 control-label">urls:</label>
							<div class="col-md-6">
							<textarea  name="urls" rows="3" class="form-control" ></textarea>
							</div>
						</div>


					<div class="form-group">
							<label class="col-md-4 control-label">dirs:</label>
							<div class="col-md-6">
							<textarea  name="dirs"  rows="3" class="form-control"></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">刷新</button>
								<a href="{{url('work/cc')}}" >查询</a>
							</div>
</form>
</body>
</html>