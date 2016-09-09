<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\redactor\widgets\Redactor;
use backend\models\FormInfo;

AppAsset::addCss($this,"@web/css/info.css"); 

$this->title = 'Ticwatch Limited Warranty Claim Service';
?>

<div class="return-product">
    <div class="line-img">
        <span class="circle circle1 active">1</span>
        <div class="line line1"></div>
        <span class="circle circle2">2</span>
        <div class="line line2"></div>
        <span class="circle circle3">3</span>
    </div>
    <div class="action-line">
        <span class="title1 active">Identify prblem</span>
        <span class="title2">Self-check & confirmation</span>
        <span class="title3">RMA Decision</span>
    </div>
    <div class="sel-pro">
        <div class="title">
            <p>Got a problem? No worries-we are here to help! Please select the category that is closest to the problem you have:</p>
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
        <div class="commit">
            <a class="next-btn">Next</a>
        </div>
    </div>
    <div class="self-check">
        <div class="content">
            <h1 class="fp-des"></h1>
            <div class="check-des"></div>
        </div>
        <div class="yes-no">
            <a class="back-btn">Back</a>
            <a class="yes-btn">Yes</a>
            <a class="no-btn">No</a>
        </div>
    </div>
    <div class="self-define">
        <div class="content">
            <span class="title">Problem description:</span>
            <?= \yii\redactor\widgets\Redactor::widget([
                'model' => 'FormInfo',
                'attribute' => 'body',
                'clientOptions' => [
                    'minHeight' => 300,
                    'lang' => 'en_cn',
                ]
            ]) ?>
            <span class="title">Write down the url of the video that can best help describe the problem:</span>
            <input type="text" class="video-url">
        </div>
        <div class="submit">
            <a class="back-btn">Back</a>
            <a class="submit-btn">Submit</a>
        </div>
    </div>
    <div class="yes-after">
        <img src="<?=Url::to('@web/img/yes.png',true)?>">
        <h3>Glad to help you solve the problem!</h3>
        <a href="<?=Url::to(['info/history'],true);?>">go to check your history</a>
        <a href="javascript:void(0)" class="back-self-check">No,my problem isn't solved, I still want to report the problem</a>
    </div>
    <div class="user-form">
        <p>Seems that something is wrong with your watch. Please ship it back to us so that we can take a closer look. Please note that if your watch does not show the problem as you described, we will return your original watch. Please fill in your contact information and your shipping address as below:</p>
        <table>
            <tr>
                <td class="form-title">Name</td>
                <td><input type="text" class="name"></td>
            </tr>
            <tr>
                <td class="form-title">Watch ID</td>
                <td><input type="text" class="watchid"></td>
            </tr>
            <tr>
                <td class="form-title">Email address</td>
                <td ><input type="text" class="email"></td>
            </tr>
            <tr>
                <td class="form-title">Shipping country</td>
                <td class="form-title">
                    <select class="country">
                        <?php foreach($country as $country){?>
                        <option value="<?=$country->id?>"><?=$country->country_name?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-title">Shipping address</td>
                <td><input type="text" class="address"></td>
            </tr>
        </table>
        <p class="upload-proof-p">Upload the purchasing proof of your watch:</p>
        <?= \yii\redactor\widgets\Redactor::widget([
                'model' => 'FormInfo',
                'attribute' => 'body',
                'clientOptions' => [
                    'minHeight' => 300,
                    'lang' => 'en_cn',
                ]
            ]) ?>
        <div class="submit">
            <a class="back-btn">Back</a>
            <a class="submit-btn">Submit</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".fp-btn").on('click', function() {
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
    $(".commit .next-btn").on('click', function(){
        $(".line-img .line1").addClass('active');
        $(".line-img .circle2").addClass('active');
        $(".action-line .title2").addClass('active');
        var fpele = $("input[name='fp']:checked");
        var fpid = fpele.val();
        var fpdes = fpele.parent().text();
        var spele = $("input[name='sp']:checked");
        var spid = spele.val();
        var spdes = spele.parent().text();
        if($.trim(fpdes) == "Others" || typeof(spid) == "undefined" || $.trim(spdes) == "Others"){
            $(".sel-pro").hide();
            $(".self-define").show();
        }
        else{
            $(".sel-pro").hide();
            $.ajax({
                url: "<?=Url::to(['info/self-check'],true);?>",
                type: "post",
                dataType: 'html',
                data: {spid:spid},
                success: function(data){
                    $(".self-check .fp-des").html(spdes);
                    $(".self-check .check-des").html(data);
                    $(".self-check").show();
                }
            });
        }
    });
    $(".self-define .submit .back-btn").on('click', function() {
        $(".line-img .line1").removeClass('active');
        $(".line-img .circle2").removeClass('active');
        $(".action-line .title2").removeClass('active');
        $(".self-define").hide();
        $(".sel-pro").show();
    });
    $(".self-check .yes-no .back-btn").on('click', function() {
        $(".line-img .line1").removeClass('active');
        $(".line-img .circle2").removeClass('active');
        $(".action-line .title2").removeClass('active');
        $(".self-check").hide();
        $(".sel-pro").show();
    });
    $(".yes-no .yes-btn").on('click', function() {
        $(".line-img .line2").addClass('active');
        $(".line-img .circle3").addClass('active');
        $(".action-line .title3").addClass('active');
        $(".self-check").hide();
        $(".yes-after").show();
    });
    $(".yes-after .back-self-check").on('click', function() {
        $(".line-img .line2").removeClass('active');
        $(".line-img .circle3").removeClass('active');
        $(".action-line .title3").removeClass('active');
        $(".self-define").show();
        $(".yes-after").hide();
    });
    $(".self-define .submit-btn").on('click', function() {

        $(".self-define").hide();
        $(".user-form").show();
    });
    $(".user-form .back-btn").on('click', function() {
        $(".user-form").hide();
        $(".self-define").show();
    });
</script>
