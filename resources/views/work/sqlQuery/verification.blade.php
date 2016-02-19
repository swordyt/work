@extends('work.work')
@section('content')
<script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var val=$("#mobile").val();
                if(checkSubmitMobil()){
                    $.ajax({
                        type:"get",
                        url:"{{url('work/ajax/verification?phone=')}}"+val,
                        data:{},
                        cache:false,
                        success:function(data){
                            $("#verification").html(data);
                        },
                    });
                }
            });
        });
        function checkSubmitMobil() {
            var isPhone = /\d{11}/;
            if ($("#mobile").val() == "") {
                alert("手机号码不能为空！");
                $("#mobile").focus();
                return false;
            }
            if (!isPhone.test($("#mobile").val())) {
                alert("手机号码格式不正确！");
                $("#mobile").focus();
                return false;
            }
            return true;
        }
    </script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Verification</div>
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
                    <label for="mobile">电话号码:</label>
                    <input id="mobile" type="text">
                    <input type="button" id="submit" value="查询">
                    <br/>
                    <hr/>
                    <label id="verification"></label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection