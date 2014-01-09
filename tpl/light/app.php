<!DOCTYPE html>
<html>
<head>
    <title>自由人</title>
    <meta name="baidu-tc-cerfication" content="6bd457adcf08474cc1250e10dfb0ab6d" />
    <?php include __DIR__ . "/../header.php"; ?>

    <!-- Custom styles for this template -->
    <link href="/css/justified-nav.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <div class="masthead">
            <h3 class="text-muted">自由人</h3>
            <ul class="nav nav-justified">
                <li class="active"><a href="#">招聘资讯</a></li>
                <li><a href="#">求职</a></li>
                <li><a href="#">招聘</a></li>
            </ul>
        </div>

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>远程工作</h1>
            <p class="lead">自由人为您提供远程工作求职、招聘服务。</p>
            <p>
                <a class="btn btn-lg btn-success" href="#" role="button">登录</a>
                <a class="btn btn-lg btn-success" href="#" role="button">注册</a>
            </p>
        </div>

        <div class="row">
            <?php foreach ($this->items as $id => $item) {?>
            <div class="col-lg-4">
                <img class="img-circle" src="<?=$item["picUrl"];?>" alt="<?=$item["title"];?>">
                <h2><?=$item["title"];?></h2>
                <p><?=$item["description"];?></p>
                <p><a class="btn btn-primary" href="<?=$item["url"];?>" role="button">详情 &raquo;</a></p>
            </div>
            <?php }?>
        </div>

    </div>

        <!-- Site footer -->
        <div class="footer">
            <p>&copy; FreeE 2014</p>
        </div>

    </div> <!-- /container -->
</body>
</html>