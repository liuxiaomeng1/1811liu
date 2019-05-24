<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />

<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
					<div class="conform">
					<form action="">				
						<div class="cfD">
		                        <select class="input3"name="w_name">
		                        <option value=""></option>
			                        @if($data)
			                        @foreach($data as $v)

			                        <option value="{{$v->w_name}}" >{{str_repeat('一',$v->level)}}{{$v->w_name}}</option>

			                        @endforeach
			                        @endif
		                       </select>
							&nbsp;&nbsp;<input class="addUser" type="text" name="title" value="{{$quest['title']??''}}" placeholder="输入文章标题" />
							&nbsp;&nbsp;<button class="button">搜索</button>
							<a class="addA addA1" href="add">添加文章+</a>
						</div>
					</form>					
				</div>					
				<!-- banner 表格 显示 -->
				<div class="conShow">

					<table border="1" cellspacing="0" cellpadding="0">
					<link rel="stylesheet" href="{{asset('css/page.css')}}">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="170px" class="tdColor">文章标题</td>
							<td width="135px" class="tdColor">文章分类</td>
							<td width="145px" class="tdColor">文章重要性</td>
							<td width="140px" class="tdColor">是否显示</td>
							<td width="140px" class="tdColor">图片展示</td>
							<td width="140px" class="tdColor">添加时间</td>
							<td width="145px" class="tdColor">操作</td>				
						</tr>
						@if($dat)
						@foreach($dat as $v)
						<tr>
							<td>{{$v->id}}</td>
							<td><a href="info/{{$v->id}}">{{$v->title}}</a></td>
							<td>{{$v->w_name}}</td>
							<td>{{$v->zhongyao}}</td>
							<td>{{$v->show}}</td>
							<td><div class="onsImg">
									<img src="{{config('app.img_url')}}{{$v->file}}" alt="暂无图片">
								</div></td>
							<td>{{$v->create_time}}</td>
							<td><a href="{{url('/admin/wen/edit',['id'=>$v->id])}}"><img class="operation"
									src="/admin/img/update.png"></a> <a href="javascript:void(0)" id="{{$v->id}}" class="del"><img class="operation delban"
								src="/admin/img/delete.png"></a></td>
						</tr>						
	
						@endforeach
						@endif
					</table>
					<div >{{ $dat->appends($quest)->links() }}</div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>
	</div>
</body>
<script type="text/javascript">


	$(".del").click(function(){
		//alert(1);
		var id=$(this).attr('id');
		//alert(id);
		if (!id) {
			alert('请选择一条进行删除');
		};
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});

		$.post('/admin/wen/del/'+id,'',function(msg){
			alert(msg.msg);
			window.location.reload();
		},'json')
	});


// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>