<html>
  <head>
<meta http-equiv="pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate"> 
<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>书是通向文明的桥梁</title>
    <style>
    *{
      margin: 0px;
      padding: 0px;
    }
    body{
      padding-left: 25px;
    }
    </style>
  </head>
<body>
<a href="{{url('work/book')}}">返回首页</a>
@if(Auth::check())
<a href="{{ url('/auth/logout') }}">Logout</a>
@else
<a href="{{ url('/auth/login') }}">Login</a>
@endif
  @if (count($errors) > 0)
    <div >
      <h5>Prompt：</h5>
         <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
    @endif
  @foreach($records as $record)
  <ul>
    <li>书名：{{$record->BookName}}</li>
    <li>借阅时间：{{$record->BorrowDate}}</li>
    <li>登记UM号：{{$record->um_number}}</li>
    <li>备注：{{$record->remark}}</li>
    @if(Auth::check() && Auth::user()->id == 1)
    <li>
    <form action="{{url('work/book/').'/'.$record->id}}" method="post">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <input type="hidden" name="_method" value="delete">
      <input type="submit" value="删除" style="color: red" >
    </form>
    @endif
    </ul>
    <BR><BR>
  @endforeach
</body>
</html>