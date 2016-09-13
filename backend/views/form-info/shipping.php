<?php

use backend\assets\AppAsset;
use yii\helpers\Url;
AppAsset::addCss($this,"@web/css/info.css");

?>
<div class="wrap-sl">
        <!-- <img class="close" src="<?//=Url::to('\img\close.png',true)?>"> -->
        <table>
            <tr>
                <td class="title">To:</td>
                <td><input type="text" class="sl-email" value="<?=$to?>"></td>
            </tr>
            <tr>
                <td class="title">Title:</td>
                <td><input type="text" class="sl-title"></td>
            </tr>
        </table>  
        <textarea cols="80" rows="15" class="sl-content"></textarea>
        <a class="send">Send</a>
    </div>
<script type="text/javascript">
    // $(".wrap-sl .close").on('click', function() {
    //     $(".wrap-sl").hide();
    // });
    $(".btn-success").on('click', function() {
        $(".wrap-sl").show();
    });
</script>