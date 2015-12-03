@extends('work.work')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">快网</div>
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
	<form action="{{url('work/refresh/cdn')}}" method="post" class="form-horizontal" role="form">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<!--
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
						-->
						<div class="form-group">
							<label class="col-md-4 control-label">urls:</label>
							<div class="col-md-6">
							<textarea  name="files" rows="3" class="form-control" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">dirs:</label>
							<div class="col-md-6">
							<textarea  name="dirs" rows="3" class="form-control" ></textarea>
							</div>
						</div>
	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">刷新</button>
							</div>
						</div>
</form>
				
				<br>
				<br>

				@if (isset($states)&&count($states) > 0)

						<div >
							<hr><br><br>
							<ul style="list-style-type:none">
								<li style="color:red"><h4>status:{{ $states->status }}</h4></li>
								<li style="color:red"><h4>info:{{ $states->info }}</h4></li>
								<li style="color:red"><h4>file_result:
									<ul style="list-style-type:none">
										<li><h5>sucess_count:{{ $states->file_result->sucess_count }}</h5></li>
										<li><h5>error_count:{{ $states->file_result->error_count }}</h5></li>
										@if(isset($states->file_result->error_list))
											<li><h5>error_list:{{each($states->file_result->error_list )}}</h5></li>
										@elseif(isset($states->file_result->error_info))
											<li><h5>error_info:{{ $states->file_result->error_info }}</h5></li>
										@endif
									</ul>
								</h4></li>
								<li style="color:red"><h4>dir_result:
									<ul style="list-style-type:none">
										<li><h5>sucess_count:{{$states->dir_result->sucess_count }}</h5></li>
										<li><h5>error_count:{{$states->dir_result->error_count }}</h5></li>
										@if(isset($states->dir_result->error_list))
											<li><h5>error_list:{{each($states->dir_result->error_list )}}</h5></li>
										@elseif(isset($states->dir_result->error_info))
											<li><h5>error_info:{{$states->dir_result->error_info}}</h5></li>
										@endif
									</ul>
								</h4></li>
							</ul>
						</div>
					@endif





				</div>
			</div>
		</div>
	</div>
</div>
@endsection