<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>导入excel批量更新数据</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="excel">
    <input type="submit" value="提交">
</form>
</body>
</html>