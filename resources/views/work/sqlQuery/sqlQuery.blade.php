@extends('work')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">DATE</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/work/date') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Startdate:</label>
							<div class="col-md-6">
								<input type="text" class="form-control readonly" name="startdate" onclick="WdatePicker()">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Enddate:</label>
							<div class="col-md-6">
								<input type="text" class="form-control readonly" name="enddate" onclick="WdatePicker()">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" >query</button>
								<a class="btn btn-link" href="{{ url('/work/sql.txt') }}">查看查询SQL</a>
							</div>
						</div>
					</form>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
							<h4>| 用户ID | 推荐人代码 | 用户手机号 | 实名认证姓名 | 推荐时间 |</h4>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
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
