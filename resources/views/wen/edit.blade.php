<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>行家编辑-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
    <div id="pageAll">
        <div class="pageTop">
            <div class="page">
                <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                    href="#">公共管理</a>&nbsp;-</span>&nbsp;行家编辑
            </div>
        </div>
    <form action="/wen/update" method="post"  enctype="multipart/form-data">
    <script src="/js/jquery.js"></script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="page ">
        {{csrf_field()}}

            <!-- 上传广告页面样式 -->
            <div class="banneradd bor">
                <div class="baTopNo">
                    <span>行家编辑</span>
                </div>
                <div class="baBody">
                    <input type="hidden" name="id" value="{{$dat->id}}" />
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章标题：<input type="text"
                            class="input3" name="title" id="title" value="{{$dat->title}}"/>
                    </div>
                     <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章分类：<select class="input3"name="w_id">
                        @if($data)
                        @foreach($data as $v)

                        <option value="{{$v->w_id}}" @if($dat->w_id==$v->w_id) selected="selected" @endif>{{str_repeat('一',$v->level)}}{{$v->w_name}}</option>

                        @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章重要性：<label><input
                            type="radio" checked="checked" name="zhongyao" value="普通" @if($dat->zhongyao=='普通') checked="checked" @endif>&nbsp;普通</label> <label><input
                            type="radio" name="zhongyao" value="置顶" @if($dat->zhongyao=='置顶') checked="checked" @endif/>&nbsp;置顶</label> 
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否显示：<label><input
                            type="radio" checked="checked" name="show" value="√" @if($dat->show=='√') checked="checked" @endif/>&nbsp;显示</label><label><input
                            type="radio" name="show" value="×" @if($dat->show=='×') checked="checked" @endif/>&nbsp;不显示</label>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章作者：<input type="text"name="author" value="{{$dat->author}}"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者email：<input type="text"name="email"value="{{$dat->email}}"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;关键字：<input type="text"name="guanjian"value="{{$dat->guanjian}}"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网页描述：
                        <div class="btext2">
                            <textarea class="text2"name="desc">{{$dat->desc}}</textarea>
                        </div>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上传文件：<input type="file"name="file" value="{{$dat->file}}">
                            
                    </div>
                    <br />
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原图：<img src="{{config('app.img_url')}}{{$dat->file}}" alt="" width="40"/>
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                       
                            
                            <button class="btn_ok btn_yes"> 提交</button>
                            <input type="reset" class="btn_ok btn_no"value="重置" />
                        </p>
                    </div>
                </div>
            </div>

            <!-- 上传广告页面样式end -->
        </div>
    </form>
    </div>
</body>
</html>

