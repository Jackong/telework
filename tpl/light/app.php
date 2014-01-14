<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include PROJECT . "/tpl/common/css.php";?>
    <!-- Custom CSS for the 'Heroic Features' Template -->
    <link href="/css/heroic-features.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <div class="jumbotron hero-spacer">
        <h1>自由人</h1>
        <p>国内首个专注于提供远程办公求职招聘服务的平台，愿求职者找到满意工作，愿招聘者找到合意人才。</p>

        <form class="form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="position">Position</label>
                <input type="text" class="form-control" id="position" placeholder="职位">
            </div>

            <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>

            <button id="submit" type="submit" class="btn btn-primary">订阅职位</button>

            <a class="btn btn-link" href="/light/recruit">发布招聘</a>
        </form>
          <p>
            <div id="success" class="hide alert alert-success"></div>
            <div id="failure" class="hide alert alert-danger"></div>
          </p>
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

    <?php include PROJECT . "/tpl/common/js.php";?>
    <script>
        $(function() {
            $("button#submit").click(function(){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "/light/subscription",
                    data: {
                        "position": $("#position").val(),
                        "email": $("#email").val()
                    },
                    success: function(msg){
                        $("#success").html("订阅成功，请注意查收邮件，避免邮件进入垃圾箱。").removeClass("hide");
                    },
                    error: function(){
                        $("#failure").html("非常抱歉，订阅失败，请稍候重试。").removeClass("hide");
                    }
                });
            });
        });
    </script>
  </body>

</html>