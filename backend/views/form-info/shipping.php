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
                <td><input type="text" class="sl-email" placeholder="<?=$to?>" disabled></td>
            </tr>
            <tr>
                <td class="title">Title:</td>
                <td><input type="text" class="sl-title" placeholder="Ship Information"></td>
            </tr>
        </table>  
        <textarea cols="80" rows="15" class="sl-content"></textarea>
        <a class="send">Send</a>
    </div>
<script type="text/javascript">
    $(".send").on('click', function() {
        var sl_content = $(".sl-content").val();
        if(sl_content.split(" ").length<10){
            alert("please fill in the concrete shipping description,not less than 10 words.");
            return;
        }
        var sl_title = $(".sl-title").val();
        if(!sl_title){
            sl_title = $(".sl-title").attr("placeholder");
        }
        var sl_email = $(".sl-email").attr("placeholder");
        console.log(sl_content+"---"+sl_title+"----"+sl_email);
        $.ajax({
            url: "<?=Url::to(['form-info/send_email'],true)?>",
            type: "post",
            dateType: "text",
            data: {to:sl_email,title:sl_title,content:sl_content,_csrf: $('meta[name=csrf-token]').attr('content'),},
            success: function(data){
                alert("Information sent successfully,get ready heading to form-info index.");
                window.location = "<?=Url::to(['form-info/index'],true)?>";
            }
        });
    });
</script>