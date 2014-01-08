<!DOCTYPE html>
<html>
<head>
    <title><?= $this->title; ?></title>
    <?php include __DIR__ . "/header.php";?>
</head>
<body>
<h1><?= $this->body; ?></h1>
<?= $this->method; ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>
</html>
