<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
    <meta charset="UTF-8">
    <link href="{{url('css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/set.css')}}" rel="stylesheet" type="text/css">
    <script src="http://laravel.sword.qa.anhouse.com.cn/js/jquery-1.12.0.min.js"></script>
    <title>AutoTest</title>
    <script>
        $(document).ready(function(){
            $("#drivertype").change(function(){
                var val=$("#drivertype option:selected").val();
                if(val=="0"){
                    $("#datatype").html(
                            "<select name='datatype'> <option value='0'>MIN</option> <option value='1'>MAX</option> </select>");
                }else if(val=="1"){
                    $("#datatype").html(
                            "<input type='text' name='datatype'>");
                }
            });
            $(".set_left a").click(function(){
                var val=$("input[name=requests]").val();
                var id=this.name;
                var reqname=this.text;
                if(val.indexOf(","+id+",")>=0){
                    return;
                }
                if(val==""){
                    val=","+id+",";
                }else{
                    val=val+id+",";
                }
                $("input[name=requests]").val(val);
                $(".set_center ol").append("<li><a href='#' target='_self' name='"+id+"'>"+reqname+"</a></li>")
            });
            $(".set_center ol").delegate("a","click",function(){
               var id=this.name;
                var val=$("input[name=requests]").val();
                $("input[name=requests]").val(val.replace(","+id+",",","));
                $(this).parent().remove();
            });
            $("#reset").click(function(){
                $("input[name=setid]").val("");
            });
        });
    </script>
</head>
<body>
<div class="body">
    <div class="nav">
        <ul>
            <li><a href="http://laravel.sword.qa.anhouse.com.cn/work/autotest">首页</a></li>
            <li><a href="{{url('work/set/set')}}">集合</a></li>
            <li><a href="{{url('/work/autotest/request/').'/'.App\InterRequest::all()->min('id')}}">请求</a></li>
            <li><a href="#">检查点</a></li>
            <li><a href="#">数据源</a></li>
            <li><a href="#">配置</a></li>
        </ul>
    </div>
    <div class="head">
        <H3>集合实体构建</H3>
    </div>
    <div class="set_left">
        <h4>测试请求列</h4>
        <ol>
            <!--动态添加请求列表-->
            @foreach(App\InterRequest::all() as $request)
            <li><a href="#" target="_self" name="{{$request->id}}">{{$request->name}}
                &nbsp{{App\Field::where("requestid","=",$request->id)->count()}}
            </a></li>
            @endforeach
        </ol>
    </div>
    <div class="set_center">
        <h4>集合</h4>
        <form action="{{url('work/set/addset')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}" >
            <input type="hidden" name="setid" value="{{$set->id}}" >
            <input type="submit" value="提交">
            <button><a href="{{url("work/set/set")}}" id="reset">重置</a></button>
        <label for="setname">集合名：</label>
            <input type="text" id="setname" name="setname" value="{{$set->name}}">
        <br/>
        <label for="drivertype">驱动方式：</label>
            <select id="drivertype" name="drivertype">
                <option value="0">EXCEL</option>
                <option value="1" 
                    @if($set->drivertype ==1)
                    selected
                    @endif
                >CONSTANT</option>
            </select>
        <label for="datatype">执行次数：</label>

        <span id="datatype">
                @if($set->drivertype ==1)
                    <input type="text" name="datatype" value="{{$set->datatype}}">
                @else
            <select name="datatype">
                <option value="0">MIN</option>
                <option value="1" @if($set->datatype ==1)
                    selected
                    @endif
                >MAX</option>
            </select>
        @endif
        </span>
            <input type="hidden" name="requests" value="<?php
            $val=",";
            DB::select("select * from runners where deleted_at is null and state=''");
            foreach (App\Runner::where("setid","=",$set->id)->where("state","=","static")->get() as $runner) {
               $val=$val.$runner->requestid.",";
            }
            echo $val;
            ?>">
        </form>
        <br/>
        <ol>
            <!--动态添加请求-->
            @foreach(App\Runner::where("runners.setid","=",$set->id)->where("runners.state","=","static")->get() as $runner)
            <li><a href='#' target='_self' name="{{$runner->requestid}}">{{App\InterRequest::find($runner->requestid)->name}}&nbsp
            {{App\Field::where("requestid","=",$runner->requestid)->count()}}
            </a></li>
            @endforeach
        </ol>
    </div>
    <div class="set_right">
        <h4>测试集合列</h4>
        <ol>
            <!--动态添加集合列表 -->
            @foreach(App\Set::all() as $set)
                <li><a href="{{url('work/set/set?id=').$set->id}}" target="_self" name="{{$set->id}}">{{$set->name}}&nbsp
               {{App\Runner::where("setid","=",$set->id)->where("state","=","static")->count()}}
                </a></li>
            @endforeach
        </ol>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>