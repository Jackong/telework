<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 上午8:50
 */
?>

<div class="row">
    <div class="col-lg-12">
        <h3>最新招聘</h3>
    </div>
</div><!-- /.row -->

<div class="row text-center">
    <?php foreach ($this->items as $id => $item) {?>
    <div onclick="<?= $item["url"];?>" class="col-lg-3 col-md-6 hero-feature">
        <div class="thumbnail">
            <img src="<?=$item["picUrl"];?>" alt="<?=$item["title"];?>">
            <div class="caption">
                <h3><?=$item["title"];?></h3>
                <p><?=$item["description"];?></p>
            </div>
        </div>
    </div>
    <?php }?>
</div>