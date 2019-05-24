<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>名字</td>
			<td>作者</td>
			<td>图片</td>
		</tr>
		
		<tr>
			<td>{{$dat->title}}</td>
			<td>{{$dat->author}}</td>
			<td ><img src="{{config("app.img_url")}}{{$dat->file}}" width="80"></td>
		</tr>
		
	</table>
</body>
</html>