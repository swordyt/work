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
<script language="javascript" type="text/javascript" src="{{url('My97DatePicker/WdatePicker.js')}}"></script>
<link href="{{url('My97DatePicker/skin/WdatePicker.css')}}" rel="stylesheet" type="text/css">
			<form class="form-horizontal" role="form" action="{{url('work/book/addborrow')}}" method="post">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<label class="col-md-4 control-label">书名</label>
						<div class="col-md-6">
							<select class="form-control" name="id">
								@foreach($books as $book)
									<option value="{{$book->id}}">{{$book->bookname}}--------{{$book->count}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">借阅时间</label>
							<div class="col-md-6">
								<input  class="form-control" type="text" onclick="WdatePicker()" name="borrowdate" >
							</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">借阅人UM号</label>
							<div class="col-md-6">
								<input  class="form-control" type="text"  name="um_number" >
							</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">备注</label>
						<div class="col-md-6">
							<textarea name="remark" rows="5" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">提交</button>
						</div>
					</div>
			</form>











				</div>
			</div>
		</div>
	</div>
</div>
@endsection