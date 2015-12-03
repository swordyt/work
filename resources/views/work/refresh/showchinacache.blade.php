@extends('work.work')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">蓝汛状态查询</div>
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

	<div  class="form-horizontal" role="form">
<script>
	function defOnblur(){
    var query = document.getElementById('query');
    var rid = document.getElementById('r_id');
    if(rid.value != ''){
      query.href="{{url('work/refresh/chinacache/')}}"+"/"+rid.value;
    }
  }
</script>
			<div class="form-group">
							<label class="col-md-4 control-label">r_id:</label>
							<div class="col-md-6">
							<input  type="text" class="form-control" id="r_id" onblur="defOnblur()">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a  id="query" class="btn btn-primary" href="">查询</a>
							</div>
				</form>
				<br>
				<br>
				@if (isset($states)&&count($states) > 0)
						<div >
							<hr><br><br>
							<ul style="list-style-type:none">
								@foreach($states as $state)
								<li style="color:red"><h4>status:{{ $state->status }}</h4></li>
								<li style="color:red"><h4>finishedTime:{{ $state->finishedTime }}</h4></li>
								<li style="color:red"><h4>totalTime:{{ $state->totalTime }}</h4></li>
								<li style="color:red"><h4>successRate:{{ $state->successRate }}</h4></li>
								<li style="color:red"><h4>username:{{ $state->username }}</h4></li>
								<li style="color:red"><h4>r_id:{{ $state->r_id }}</h4></li>
								<li style="color:red"><h4>createdTime:{{ $state->createdTime }}</h4></li>
								<li style="color:red"><h4>urlStatus:</h4><br>
									<ul style="list-style-type:none">
									@foreach($state->urlStatus as $url)
											<li><h5>url:{{$url->url.':'.$url->code}}</h5></li>
									@endforeach
									</ul>
								</li>
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