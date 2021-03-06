<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>个人文件</title>
    <link rel="stylesheet" href="{{asset('resources/views/home/static/css/pintuer.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/home/static/css/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/home/static/css/jquery-ui.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/home/static/css/main.css')}}">
    <script src="{{asset('resources/views/home/static/js/jquery.js')}}"></script>
    <script src="{{asset('resources/views/home/static/js/pintuer.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/home/static/js/jquery-ui-1.10.4.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/home/static/js/jquery.ui.datepicker-zh-CN.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/home/static/js/jquery-ui-timepicker-addon.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/home/static/js/jquery-ui-timepicker-zh-CN.js')}}"></script>

</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong>个人文件</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">
            <div class="form-group ml3" style="width:30%;">
                <div class="label">
                    <label>上传时间：</label>
                </div>
                <div class="field" style="width:75%;">
                    <div class="doc-dd">
                        <input name="act_start_time" type="text" class="input w25" value="" placeholder="开始时间" title="开始时间" readonly="readonly" style="cursor:pointer;" id="begin_time"/>

                        <input  style="margin-left:2%;" name="act_stop_time" type="text" class="input w25" value="" placeholder="结束时间" title="结束时间" readonly="readonly" style="cursor:pointer;" id="end_time"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>素材类型：</label>
                </div>
                <div class="field">
                    <select class="input" id="material_type_id">
                        <option value="all">请选择</option>
                        @foreach($materialType as $v)
                        <option value="{{$v->_id}}">{{$v->material_type_name}}</option>
                        @endforeach
                    </select>
                    <div class="tips"></div>
                </div>
            </div>


            <div class="form-group">
                <div class="label">
                    <label>审核状态：</label>
                </div>
                <div class="field">
                    <select class="input" id="check_status">
                        <option value="all">请选择</option>
                        <option value="0">未审核</option>
                        <option value="1">通过</option>
                        <option value="2">未通过</option>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>素材名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_name" value="" id="material_name"/>
                    <div class="tips"></div>
                </div>
            </div>

        </form>
        <form method="post" action="" class="form-x mt15">
            <div class="form-group w100">
                {{--<div class="label">--}}
                    {{--<label>全部素材</label>--}}
                {{--</div>--}}
                <div class="field ml10">
                    <a href="{{url('home/userfile/addmaterial')}}"><button class="button bg-main" type="button">上传素材</button></a>
                    {{--<button class="button bg-main" type="button">下载</button>--}}
                </div>
                <button class="button bg-main r mr20" type="button" id="reset">重置</button>
                <button class="button bg-main r mr20" type="button" id="search">查询</button>
            </div>
            <div class="panel admin-panel">
                <table class="table table-hover text-center" id="list">
                    {{--<tr>--}}
                        {{--<th width="120">ID</th>--}}
                        {{--<th>素材名</th>--}}
                        {{--<th>素材类型</th>--}}
                        {{--<th>附件数量</th>--}}
                        {{--<th>审核状态</th>--}}
                        {{--<th>审核备注</th>--}}
                        {{--<th>支付状态</th>--}}
                        {{--<th>操作</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td width="120"><input type="checkbox" name="id[]" value="1" />神夜</td>--}}
                        {{--<td>13420925611</td>--}}
                        {{--<td>2016-04-12 12:30</td>--}}
                        {{--<td>深圳市民治街道</td>--}}
                        {{--<td>视频</td>--}}
                        {{--<td>xx</td>--}}
                        {{--<td>xx</td>--}}
                        {{--<td><div class="button-group">--}}
                                {{--<a type="button" class="button border-main" href="#"><span class="icon-download"></span></a>--}}
                            {{--</div></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td width="120"><input type="checkbox" name="id[]" value="1" />神夜</td>--}}
                        {{--<td>13420925611</td>--}}
                        {{--<td>2016-04-12 12:30</td>--}}
                        {{--<td>深圳市民治街道</td>--}}
                        {{--<td>视频</td>--}}
                        {{--<td>xx</td>--}}
                        {{--<td>xx</td>--}}
                        {{--<td><div class="button-group">--}}
                                {{--<a type="button" class="button border-main" href="#"><span class="icon-download"></span></a>--}}
                            {{--</div></td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td colspan="14"><div class="pagelist"> <a href="">上一页</a> <span class="current">1</span><a href="">2</a><a href="">3</a><a href="">下一页</a><a href="">尾页</a> </div></td>--}}
                    {{--</tr>--}}
                </table>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">$( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();</script>
</body>
</html>

<!--附件弹框开始-->
<div class="MsgBox clearfix" style="display: none;width:400px;left:45%;" id="uploadBox">
    <div class="top">
        <div class="title" class="MsgTitle">素材下载列表</div>
    </div>
    <div class="body l">
        <form method="post" action="" class="alert-form">
            <div class="panel admin-panel">
                <table class="table table-hover text-center" id="uploadurllist">
                    {{--<tr>--}}
                        {{--<th>文件名</th>--}}
                        {{--<th>格式</th>--}}
                        {{--<th>操作</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>xxx</td>--}}
                        {{--<td>xxx</td>--}}
                        {{--<td>--}}
                            {{--<div class="button-group">--}}

                                {{--<a type="button" class="button border-main" href="#"><span class="icon-download"></span>下载</a>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>xxx</td>--}}
                        {{--<td>xxx</td>--}}
                        {{--<td>--}}
                            {{--<div class="button-group">--}}

                                {{--<a type="button" class="button border-main" href="#"><span class="icon-download"></span>下载</a>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                </table>
            </div>
        </form>
    </div>
    <div class="bottom l" class="MsgBottom" style="height: 45px;">
        <div class="btn MsgBtns">
            <div class="height"></div>
            <input type="button" class="btn" value="关闭" onclick="uploadurlclose()">
        </div>
    </div>
</div>
<!--附件弹框结束-->

<script type="text/javascript">
    var page_cur = 1; //当前页
    var total_num, page_size, page_total_num; //总记录数,每页条数,总页数
    var status
    function getData(page) { //获取当前页数据
        var material_name=$("#material_name").val();
        var material_type_id=$("#material_type_id").val();
        var begin_time=$("#begin_time").val();
        var end_time=$("#end_time").val();
        var check_status=$("#check_status").val();
//        var pay_status=$("#pay_status").val();
        $.ajax({
            type: 'post',
            url: '{{url('home/userfile/ajax')}}',
            data: {'page': page, 'action': 'getlist', 'material_name': material_name, 'material_type_id': material_type_id, 'begin_time': begin_time, 'end_time': end_time,'check_status': check_status},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(XMLHttpRequest) {
//                $('body').showLoading();
            },
            success: function(json) {
                if (json.status == 1) {
                    $("#list").empty();
                    total_num = json.total_num; //总记录数
                    page_size = json.page_size; //每页数量
                    page_cur = page; //当前页
                    page_total_num = json.page_total_num; //总页数businessScope unix_to_datetime(unix);   getLocalTime(parseInt(array.ctime,10)) SProductName out_logi_no
                    var li = "<tr><th width='120'>ID</th><th>素材名称</th><th>素材类型</th><th>素材数量</th><th>审核状态</th><th>金额</th><th>审核备注</th><th>支付状态</th><th>上传时间</th><th>操作</th></tr>";
                    var list = json.list;
                    $.each(list, function(index, array) { //遍历返回json
                        showbutton ='';
                        if(array.check_status ==0){
                            array.check_status='未审核';
                            array.pay_amount= 0;
                            showbutton +="<a type='button' class='button border-red' href='javascript:void(0)' onclick='delete1(this)' data='" + array._id + "' style='margin-left:5px;'><span class='icon-money'></span>删除</a>";
                        }else if(array.check_status ==1){
                            array.check_status='审核通过';
                        }else{
                            array.check_status='审核未通过';
                            array.pay_amount=0;
                        }
                        if(array.pay_status !=0){
                            array.pay_status='已支付';
                        }else{
                            array.pay_status='未支付';
                        }
                        {{--var downloadUrl ="{{url('home/userfile/downloadfile/')}}"+"/"+array._id;--}}
//                        <input type='checkbox' name='id[]' value='1' />1
                        li +="<tr><td>"+(page_size*(page_cur-1)+index+1)+"</td><td>"+array.material_name+"</td><td >"+array.material_type_name+"</td><td>"+array.attachments+"</td><td>"+array.check_status+"</td><td>"+array.pay_amount+"</td><td>"+array.comment+"</td> <td>"+array.pay_status+"</td> <td>"+array.created_at+"</td><td><div class='button-group'><a type='button' class='button border-main' href='javascript:;' onclick='uploadurl(this)' doctor_id='" + array.doctor_id + "' upload_code='" + array.upload_code + "'><span class='icon-download'>下载</span></a>";
                        li += showbutton +"</div></td></tr>";
                    });

                    li +="<tr id ='page-tag'></tr>"
                    $("#list").append(li);
                    getPageBar();
                } else {
                    $("#list").empty();
                    $("#list").append("<tr><td colspan='14'><div class='pagelist' id='pagelist'></div>暂无数据</tr>");
                    alert(json.msg);
                }
            },
            complete: function() {
//                getPageBar(); //js生成分页，可用程序代替
//                $('body').hideLoading();
            },
            error: function() {
//                $('body').hideLoading();
                alert("数据异常！");
            }
        });
    }
    function getPageBar() { //js生成分页
        if (page_cur > page_total_num)
            page_cur = page_total_num; //当前页大于最大页数
        if (page_cur < 1)
            page_cur = 1; //当前页小于1
        page_str ="<td colspan='14'><div class='pagelist' id='pagelist'>";
        page_str += "<span>共" + page_total_num + "页</span><span>" + page_cur + "/" + page_total_num + "</span>";
//        page_str ="<tr>";
        //若是第一页
        if (page_cur == 1) {
            page_str += "<span>首页</span><span>上一页</span>";
        } else {
            page_str += "<a href='javascript:void(0)' onclick='aclick(this);' data-page='1'>首页</a><a href='javascript:void(0)' onclick='aclick(this);' data-page='" + (page_cur - 1) + "'>上一页</a>";
        }
        //若是最后页
        if (page_cur >= page_total_num) {
            page_str += "<span>下一页</span><span>尾页</span>";
        } else {
            page_str += "<a href='javascript:void(0)' onclick='aclick(this);' data-page='" + (parseInt(page_cur) + 1) + "'>下一页</a><a href='javascript:void(0)' onclick='aclick(this);' data-page='" + page_total_num + "'>尾页</a>";
        }
        page_str +="</div></td>";
        $("#page-tag").html(page_str);
    }

    $(function() {
        getData(1); //默认第一页
        $("#list tr").on('click', function() { //live 向未来的元素添加事件处理器,不可用bind
            var page = $(this).attr("data-page"); //获取当前页
            getData(page)
        });
    });

    function aclick(obj){
        var page = $(obj).attr("data-page"); //获取当前页
        getData(page);
    }
    $('#search').click(function() {
        getData(1);
    });

    $('#reset').click(function() {
        $("#material_name").val('');
        $("#material_type_id").val('all');
        $("#begin_time").val('');
        $("#end_time").val('');
        $("#check_status").val('all');
        getData(1);
    });

    function delete1(obj){
        var id=$(obj).attr('data');
        if(!confirm("确定要删除该条素材吗？")){
            return false;
        }
        $.ajax({
            type: 'post',
            url: '{{url('home/userfile/ajax')}}',
            data: {'action': 'delete','id':id},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(XMLHttpRequest) {
//                $('body').showLoading();
            },
            success: function(json) {

                if (json.status == 1) {
                    window.location.href="{{url("home/userfile/index")}}";
                } else {
                    alert(json.msg);
                }
            },
            complete: function() {

            },
            error: function() {
                alert("数据异常！");
            }
        });

    }


    function uploadurl(obj){
        var doctor_id=$(obj).attr('doctor_id');
        var upload_code=$(obj).attr('upload_code');
        $.ajax({
            type: 'post',
            url: '{{url('home/userfile/ajax')}}',
            data: { 'action': 'getuploadurllist', 'doctor_id': doctor_id, 'upload_code': upload_code},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(XMLHttpRequest) {
//                $('body').showLoading();
            },
            success: function(json) {
                if (json.status == 1) {
                    $("#uploadurllist").empty();
                    var li = "<tr><th>文件名</th><th>下载地址</th></tr>";
                    var list = json.list;
                    $.each(list, function(index, array) { //遍历返回json

                        li +="<tr><td style='max-width:150px;'>"+array.filename+"</td><td><div class='button-group'><a type='button' class='button border-main' href='"+array.lenovoUrl+"'><span class='icon-download'></span>下载</a></div></td></tr>";

                    });
                    $("#uploadurllist").append(li);
                    $("#uploadBox").css('display','block');
                } else {
                    alert(json.msg);
                }
            },
            complete: function() {
//                getPageBar(); //js生成分页，可用程序代替
//                $('body').hideLoading();
            },
            error: function() {
//                $('body').hideLoading();
                alert("数据异常！");
            }
        });

    }


    function uploadurlclose(){
        $("#uploadBox").css('display','none');

    }
</script>