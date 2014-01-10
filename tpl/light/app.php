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
                <li class="active"><a href="/light/app?main=hunt">求职</a></li>
                <li><a href="/light/app?main=recruit">招聘</a></li>
            </ul>
        </div>

        <?php is_null($this->sign) || $this->sign->render();?>

        <?php $this->main->render();?>

        <!-- Site footer -->
        <div class="footer">
            <p>&copy; FreeIT 2014</p>
        </div>

    </div> <!-- /container -->
</body>
</html>