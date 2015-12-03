@extends('work.work')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">蓝汛</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

<form action="{{url('work/refresh/chinacache')}}" method="post" class="form-horizontal" role="form">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<!--<div class="form-group">
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
	
-->
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
							</div>
				</form>
				<br>
				<br>
				@if (isset($contents)&&count($contents) > 0)
						<div >
							<hr><br><br>
							<ul style="list-style-type:none">
								@foreach ($contents as $content)
									<li><h4>{{ $content }}</h4></li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection