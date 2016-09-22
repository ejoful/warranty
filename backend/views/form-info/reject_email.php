<?php

use backend\assets\AppAsset;
use yii\helpers\Url;
AppAsset::addCss($this,"@web/css/info.css");

?>
<div class="wrap-sl">
        <table>
            <tr>
                <td class="title">To:</td>
                <td><input type="text" class="sl-email" placeholder="<?=$to?>" disabled></td>
            </tr>
            <tr>
                <td class="title">Title:</td>
                <td><input type="text" class="sl-title" value="Rejection of your warranty claim RMA"></td>
            </tr>
        </table>
        <input type="hidden" class="formid" value="<?=$id?>">
        <textarea cols="80" rows="15" class="sl-content">

Dear <?=$name?>,

We regret to inform you that we cannot approve your warranty.After checking the information you provided,we believe you are responsible for the damage of the product.

If you have any further questions,you can contact us by emailing support@mobvoi.com with your RMA number.

Thanks!
The Ticwatch Team
        </textarea>
        <a class="send">Send</a>
    </div>
<script type="text/javascript">
    $(".send").on('click', function() {
        var id = $(".formid").val();
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
        $.ajax({
            url: "<?=Url::to(['form-info/send_reject'],true)?>",
            type: "post",
            dateType: "text",
            data: {id:id,to:sl_email,title:sl_title,content:sl_content,_csrf: $('meta[name=csrf-token]').attr('content'),},
            success: function(data){
                alert("Information sent successfully,get ready heading to form-info index.");
                window.location = "<?=Url::to(['form-info/index'],true)?>";
            }
        });
    });
</script>