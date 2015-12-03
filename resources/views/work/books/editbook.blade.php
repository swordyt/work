@extends('work.work')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Book</div>
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


				<form action="{{url('work/book/editbook/'.$book->id)}}" method="post" class="form-horizontal" role="form">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
							<label class="col-md-4 control-label">书名：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bookname" value="{{$book->bookname}}">
							</div>
						</div>
	
	
					<div class="form-group">
							<label class="col-md-4 control-label">作者：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="author" value="{{$book->author}}">
							</div>
						</div>
					<div class="form-group">
							<label class="col-md-4 control-label">简介：</label>
							<div class="col-md-6">
							<textarea  name="introduction"  rows="3" class="form-control">{{$book->introduction}}</textarea>
							</div>
						</div>
					<div class="form-group">
							<label class="col-md-4 control-label">数量：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="count" value="{{$book->count}}">
							</div>
						</div>
					<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">修改</button>
							</div>
				</form>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection