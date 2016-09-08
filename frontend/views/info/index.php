<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::addCss($this,"@web/css/info.css"); 

$this->title = 'Ticwatch Limited Warranty Claim Service';
?>

<div class="return-product">
    <div class="title">
        <p>Got a problem? No worries-we are here to help!
        Please select the category that is closest to the problem you have:</p>
    </div>
    <div class="option-list">
        <?php 
        foreach ($fp as $fp) {?>
            <div class="fp-wrap">
                <span class="list-span"><input type="radio" name="fp" class="fp-btn" value="<?=$fp->id?>"><?= $fp->des ?>
                </span>
                <div class="sp">
                </div>
            </div>
         <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $(".fp-btn").on('click', function(e) {
        var fpid = $(this).val();
        $.ajax({
            url: "<?= Url::to(['info/search'],true); ?>",
            type: 'post',
            context:this,
            dataType: 'html',
            data: {fpid:fpid},
            success: function(data){
                $(this).parent().next().html(data).show();
                $(this).parent().parent().siblings().find(".sp").css("display","none");
            },
        });
    });
</script>
