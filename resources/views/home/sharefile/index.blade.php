<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>共享文件</title>
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
    <div class="panel-head"><strong>共享文件</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="">

            <div class="form-group">
                <div class="label">
                    <label>工具名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="s_name" value="" id="file_name"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="field ml10">
                    <button class="button bg-main" type="button" id="search">查询</button>
                </div>
            </div>

        </form>
        <form method="post" action="" class="form-x mt15">
            <div class="form-group w100">
                {{--<div class="label">--}}
                    {{--<label>全部素材</label>--}}
                {{--</div>--}}
                {{--<div class="field ml10">--}}
                    {{--<button class="button bg-main" type="submit">下载</button>--}}
                {{--</div>--}}
            </div>
            <div class="panel admin-panel">
                <table class="table table-hover text-center" id="list">
                    {{--<tr>--}}
                        {{--<th width="120">ID</th>--}}
                        {{--<th>素材名称</th>--}}
                        {{--<th>大小</th>--}}
                        {{--<th>操作</th>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td width="120"><input type="checkbox" name="id[]" value="1" />神夜</td>--}}
                        {{--<td>13420925611</td>--}}
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


<script type="text/javascript">
    var page_cur = 1; //当前页
    var total_num, page_size, page_total_num; //总记录数,每页条数,总页数
    var status
    function getData(page) { //获取当前页数据
        var file_name=$("#file_name").val();
        $.ajax({
            type: 'post',
            url: '{{url('home/sharefile/ajax')}}',
            data: {'page': page, 'action': 'getlist', 'file_name': file_name},
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
                    page_total_num = json.page_total_num; //总页数businessScope unix_to_datetime(unix);
                    var li = "<tr><td>ID</td><th>工具名称</th><th>上传时间</th><th>文件大小</th><th>操作</th></tr>";
                    var list = json.list;
                    $.each(list, function(index, array) { //遍历返回json

                        var downloadUrl ="{{url('home/sharefile/downloadfile/')}}/"+array._id;
                        li +="<tr><td>"+(page_size*(page_cur-1)+index+1)+"</td><td>"+array.file_name+"</td> <td>"+array.created_at+"</td><td>"+array.file_weight+"</td><td><div class='button-group'><a type='button' class='button border-main' href='"+downloadUrl+"'><span class='icon-download'></span></a></div></td></tr>";
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
        getData(1);
    });
</script>