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

		<div>
			<ul style="">
			@foreach ($books as $book)
			<li style="margin: 50px 0;list-style-type:none;display: block;">
				<div >
						<h4>{{ $book->bookname }}</h4>
					</a>
					<hr>
					<h5>作者：{{$book->author}}<h5>
					<h5>库存：{{$book->count}}本</h5>
				</div>
				<div >
					<p>书本简介：{{ $book->introduction }}</p>
					@if(Auth::user()->id == 1)
					<a href="{{url('work/book/showbook/'.$book->id)}}"  class="btn btn-success">编辑</a><a href="{{url('work/book/deletebook/'.$book->id)}}" class="btn btn-danger">下架</a>
					@endif
				</div>
			</li>
			@endforeach
			</ul>
		</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection