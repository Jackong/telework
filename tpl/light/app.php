<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include __DIR__ . "/../header.php";?>
    <!-- Custom CSS for the 'Heroic Features' Template -->
    <link href="/css/heroic-features.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <div class="jumbotron hero-spacer">
        <h1>自由人</h1>
        <p>国内首个专注于提供远程办公求职招聘服务的平台，愿求职者找到满意工作，愿招聘者找到合意人才。</p>
        <form class="form-inline" role="form" action="/light/subscription">
            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>

            <button type="submit" class="btn btn-primary">订阅职位</button>

            <a class="btn btn-link" href="/light/recruit">发布招聘</a>
        </form>
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