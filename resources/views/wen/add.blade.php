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
                <img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                    href="#">公共管理</a>&nbsp;-</span>&nbsp;行家编辑
            </div>
        </div>
    <form action="/wen/add_do" method="post"  enctype="multipart/form-data">
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
                    
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章标题：<input type="text"
                            class="input3" name="title" id="title"/><span id="span"></span>
                    </div>
                     <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章分类：<select class="input3"name="w_id">
                        @if($data)
                        @foreach($data as $v)

                        <option value="{{$v->w_id}}">{{str_repeat('一',$v->level)}}{{$v->w_name}}</option>

                        @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章重要性：<label><input
                            type="radio" checked="checked" name="zhongyao" value="普通"/>&nbsp;普通</label> <label><input
                            type="radio" name="zhongyao" value="置顶"/>&nbsp;置顶</label> 
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否显示：<label><input
                            type="radio" checked="checked" name="show" value="√"/>&nbsp;显示</label><label><input
                            type="radio" name="show" value="×"/>&nbsp;不显示</label>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文章作者：<input type="text"name="author"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者email：<input type="text"name="email"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;关键字：<input type="text"name="guanjian"
                            class="input3" />
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网页描述：
                        <div class="btext2">
                            <textarea class="text2"name="desc" id="desc"></textarea>
                        </div>
                    </div>
                    <div class="bbD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上传文件：<input type="file"name="file">
                            
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                           <input type="submit" value="提交" class="btn_ok btn_yes"/>
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

<script>
   $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
    $('input[name=title]').blur(function(){
     


      var title=$(this).val();
      if(title==''){
        alert('标题不能空');
        return;
      }
      var reg=/^[\u4e00-\u9fa5\w]{3,30}$/;
      if(!reg.test(title)){
        alert('品牌名称格式为中文字母数字下划线3-30位');
        return;
      }


        $.post(
          'wen/checkName',{title:title},function(msg){
            if(msg.count){
              alert('品牌名称已存在');
            }
        },'json');
      


      })
      $('#desc').blur(function(){
          var desc=$(this).val();
          // alert();
          if(desc==''){
            alert('描述不能空');
            return;
      }
      });




      $('.btn_yes').click(function(){
        var obj_html = $('input[name=title]');
        var title=obj_html.val();
        
        if(title==''){
          alert('品牌名称不能空');
          return false;


        }
        var reg=/^[\u4e00-\u9fa5\w]{3,30}$/;
        if(!reg.test(title)){
           alert('品牌名称格式为中文字母数字下划线3-30位');
        return false;
      }
       var desc_html=$('textarea[name=desc]');
       var desc=desc_html.val();
       if(desc==''){
          alert('品牌描述不能空');
          return false;
       }
       var flag=false;
       $.ajax({
        method: "post",
        url: "checkName",
        dataType:'json',
        async:false,
        data:{title:title}
        }).done(function(msg){
        if(msg.count){
          alert('品牌名称已存在');
          flag=false;
          
          }else{
          flag=true;


          }
       });
        if(flag!=true){
           return flag;
       }
       // alert('011');
    


      });
      






 
</script>



