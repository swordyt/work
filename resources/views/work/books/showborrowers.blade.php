@extends('work.work')
@section('content')
<script>
  function defOnfocus(){
    var search = document.getElementById('search');
    if(search.value == '输入UM号'){
      search.value='';
    }
  }
  function defOnblur(){
    var search = document.getElementById('search');
    if(search.value == ''){
      search.value='输入UM号';
    }
  }
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Book
        @if(Auth::user()->id ==1)
          <div style="float:right;">
            <form action="{{url('work/book/search')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input id="search" type="text" name="search" value="输入UM号" onfocus="defOnfocus()" onblur="defOnblur()">
              <input type="submit" value="搜索" >
            </form>
          </div>
        @endif
        </div>
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
@if(isset($borrowers)&&count($borrowers)>0)
<ul>
  @foreach($borrowers as $borrower)
    <li>
      <h4>书名：{{$borrower->bookname}}</h4>
      <h5>作者：{{$borrower->author}}</h5>
      <h5>借阅日期：{{$borrower->borrowerdate}}</h5>
      @if(Auth::user()->id ==1 )
      <h5>借阅者名字：{{$borrower->name}}</h5>
      <h5>借阅者UM：{{$borrower->um_number}}</h5>
      @endif
      <h5>备注：{{$borrower->remark}}</h5>
      <p>简介：{{$borrower->introduction}}</p>
       @if(Auth::user()->id ==1 )
       <a href="{{url('work/book/deleteborrower/'.$borrower->id)}}"  class="btn btn-success">归还书籍</a>
       @endif
    </li>
  @endforeach
  </ul>
@endif
</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection