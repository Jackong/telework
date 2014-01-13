<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include __DIR__ . "/../header.php";?>
    <!-- Custom CSS for the 'Heroic Features' Template -->
    <link href="/css/heroic-features.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">自由人</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">求职</a></li>
            <li><a href="#services">招聘</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
    
    <div class="container">

      <div class="jumbotron hero-spacer">
        <h1>自由人</h1>
        <p>国内首个专注于提供远程办公求职招聘服务的平台，愿求职者找到满意工作，愿招聘者找到合意人才。</p>
        <p><a class="btn btn-primary btn-large">订阅职位</a> <a class="btn btn-info btn-large">发布招聘</a></p>
      </div>
      
      <hr>

        <?php $this->jobs->render();?>
      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; FreeE 2014</p>
          </div>
        </div>
      </footer>
      
    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.js"></script>

  </body>

</html>