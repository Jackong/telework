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

        <?php is_null($this->sign) || $this->sign->render();?>

        <?php $this->main->render();?>

        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-7">
                    <span class="sr-only">弹一个</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/light/app">自由人</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-navbar-collapse-7">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/light/app?main=hunt">求职</a></li>
                    <li><a href="/light/app?main=recruit">招聘</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div> <!-- /container -->
</body>
</html>