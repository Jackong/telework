<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 上午8:50
 */
?>
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