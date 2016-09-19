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
        <input type="hidden" class="check-id" />
    </div>
    <input type="hidden" class="flag">
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
            <div class="msg"></div>
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
        <h3 class="info-tip">Glad to help you solve the problem!</h3>
        <a href="<?=Url::to(['form-info/index','id'=>Yii::$app->session['user']->base_info->wwid],true);?>">go to check your history</a>
        <a href="javascript:void(0)" class="back-self-check">No,my problem isn't solved, I still want to report the problem</a>
    </div>
    <div class="user-form">
        <p>Seems that something is wrong with your watch. Please ship it back to us so that we can take a closer look. Please note that if your watch does not show the problem as you described, we will return your original watch. Please fill in your contact information and your shipping address as below:</p>
        <table>
            <tr>
                <td class="form-title">Name</td>
                <td><input type="text" class="name"></td>
                <td><label class="msg">*</label></td>
            </tr>
            <tr>
                <td class="form-title">Telephone</td>
                <td><input type="text" class="tel"></td>
                <td><label class="msg">*</label></td>
            </tr>
            <tr>
                <td class="form-title">Watch SN</td>
                <td><input type="text" class="watchid"></td>
                <td><label class="msg">*</label></td>
            </tr>
            <tr>
                <td class="form-title">Email address</td>
                <td><input type="text" class="email"></td>
                <td><label class="msg">*</label></td>
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
                <td><label class="msg">*</label></td>
            </tr>
            <tr>
                <td class="form-title">Shipping address</td>
                <td><input type="text" class="address"></td>
                <td><label class="msg">*</label></td>
            </tr>
            <tr>
                <td class="form-title">Zip Code</td>
                <td><input type="text" class="zip_code"></td>
                <td><label class="msg">*</label></td>
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
        <p class="proof-msg"></p>
        <div class="submit">
            <a class="back-btn">Back</a>
            <a class="submit-btn">Submit</a>
        </div>
    </div>
    <div class="form-submit-us">
        <p>Got it. A shipping label is going to be sent to your email address in x working days,after we verified your case. You may ship your product back to us within 30 days of receiving the shipping label. We will send you a replacement unit once we receive the product and the product is proven to have the problem as you described. Thanks for your patience!</p>
        <a href="<?=Url::to(['form-info/index','id'=>Yii::$app->session['user']->base_info->wwid],true);?>">go to check your history</a>
    </div>
    <div class="form-submit-nous">
        <p>Your shipping address is outside the United States Due to the limitation of our operations, you will need to ship your own expense to the following address:</p>
        <p class="beijing-address">Daheng Science Tower, 18th Floor 3rd Suzhou Street, Haidian District Beijing, China</p>
        <p>will send you a replacement unit once we receive the product and the product is proven to have the problem as you described. Thanks for your patience!</p>
        <a href="<?=Url::to(['form-info/index','id'=>Yii::$app->session['user']->base_info->wwid],true);?>">go to check your history</a>
    </div>
</div>
<script type="text/javascript">

    //点击一级菜单
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

    //点击选择问题页面中的下一步
    $(".commit .next-btn").on('click', function(){
        var fpele = $("input[name='fp']:checked");
        var fpid = fpele.val();
        var fpdes = fpele.parent().text();
        var spele = $("input[name='sp']:checked");
        var spid = spele.val();
        var spdes = spele.parent().text();

        if(fpele.length==0){
            alert("please select one option at least");
            return;
        }
        else if(spele.length==0 && $.trim(fpdes)!="Others"){
            alert("please select one option in the list of '"+$.trim(fpdes)+"' at least");
            return;
        }
        $(".line-img .line1").addClass('active');
        $(".line-img .circle2").addClass('active');
        $(".action-line .title2").addClass('active');

        if($.trim(fpdes) == "Others"){
            $.ajax({
                url: "<?=Url::to(['info/get-spid'],true);?>",
                type: "post",
                async: false,
                success: function(data){
                    spid = parseInt(data);
                }
            });
        }
        if($.trim(spdes) == "Others" && $.trim(fpdes) != "Others"){
            $(".sel-pro").hide();
            $(".self-define").show();
            return;
        }
        else{
            $(".sel-pro").hide();
            $(".self-define").hide();
            $.ajax({
                url: "<?=Url::to(['info/self-check'],true);?>",
                type: "post",
                dataType: 'json',
                data: {spid:spid},
                success: function(data){
                    $(".self-check .fp-des").html(spdes);
                    $(".self-check .check-des").html(data[0]);
                    $(".self-check").show();
                    $(".check-id").val(data[1]);
                }
            });
        }
    });
    //点击自定义问题中的回退按钮
    $(".self-define .submit .back-btn").on('click', function() {
        var flag = $(".flag").val();
        $(".self-define").hide();
        if(flag == "yes"){
            $(".self-check").show();
        }
        else{
            $(".sel-pro").show();
            $(".line-img .line1").removeClass('active');
            $(".line-img .circle2").removeClass('active');
            $(".action-line .title2").removeClass('active');
        }
    });
    //点击检查步骤页面中的回退按钮
    $(".self-check .yes-no .back-btn").on('click', function() {
        $(".line-img .line1").removeClass('active');
        $(".line-img .circle2").removeClass('active');
        $(".action-line .title2").removeClass('active');
        $(".self-check").hide();
        $(".sel-pro").show();
    });
    //点击检查步骤页面中的yes按钮
    $(".yes-no .yes-btn").on('click', function() {
        var check_id = $(".check-id").val();
        $(".line-img .line2").addClass('active');
        $(".line-img .circle3").addClass('active');
        $(".action-line .title3").addClass('active');
        $.ajax({
            url: "<?=Url::to(['info/check-step'],true);?>",
                type: "post",
                data: {check_id:check_id},
                success: function(data){
                    var arr = data.split("_");
                    if(arr[0]==0){
                        if(arr[1]=="wrong"){
                            alert(arr[2]);
                            $(".self-check").hide();
                            $(".user-form").show();
                        }
                        else{
                            $(".yes-after .info-tip").html(arr[2]);
                            $(".self-check").hide();
                            $(".yes-after").show();
                        }
                        $(".flag").val("yes");
                    }
                    if(arr[0]==1){
                        checkGoTo(check_id);
                    }
                    if(arr[0]==2){
                        $(".user-form").show();
                        $(".self-check").hide();
                    }
                    if(arr[0]==3){
                        $(".self-define").show();
                        $(".self-check").hide();
                    }
            }
        });
    });
    //点击检查步骤页面中的no按钮
    $(".yes-no .no-btn").on('click', function() {
        var check_id = $(".check-id").val();
        $.ajax({
            url: "<?=Url::to(['info/check-no-step'],true);?>",
                type: "post",
                data: {check_id:check_id},
                success: function(data){
                    var arr = data.split("_");
                    if(arr[0]==0){
                        if(arr[1]=="wrong"){
                            alert(arr[2]);
                            $(".self-check").hide();
                            $(".user-form").show();
                        }
                        else{
                            $(".yes-after .info-tip").html(arr[2]);
                            $(".self-check").hide();
                            $(".yes-after").show();
                        }
                        $(".flag").val("yes");
                    }
                    if(arr[0]==1){
                        checkGoTo(check_id);
                    }
                    if(arr[0]==2){
                        $(".user-form").show();
                        $(".self-check").hide();
                        $(".flag").val("yes");
                    }
            }
        });
    });
    //检查步骤页面中用到的公共函数，实现步骤切换
    function checkGoTo(check_id){
        $.ajax({
            url:"<?=Url::to(['info/check-goto'],true);?>",
            type:"post",
            data:{check_id:check_id},
            success:function(data){
                $(".check-des").html(data);
                $(".check-id").val(check_id*1+1);
            }
        });
    }
    //
    $(".yes-after .back-self-check").on('click', function() {
        $(".line-img .line2").removeClass('active');
        $(".line-img .circle3").removeClass('active');
        $(".action-line .title3").removeClass('active');
        $(".self-define").show();
        $(".yes-after").hide();
    });
    //点击自定义问题下的提交按钮
    $(".self-define .submit-btn").on('click', function() {
        selfProDes = $(".self-define .redactor-editor").text();
        if(selfProDes.split(" ").length<20){
            $(".self-define .msg").html("please fill in the concrete problem description,not less than 20 words.").show();
            selfProDes = $(".self-define .redactor-editor").focus();
            return;
        }
        $(".self-define .msg").hide();
        $(".self-define").hide();
        $(".user-form").show();
    });
    $(".user-form .back-btn").on('click', function() {
        var flag = $(".flag").val();
        if(flag == "yes"){
            $(".self-check").show();
        }
        else{
            $(".self-define").show();
        }
        $(".user-form").hide();
    });
    //提交表单
    $(".user-form .submit-btn").on('click', function() {
        //获取表单信息
        var name = $(".user-form .name").val();
        if(!name){
            $(".user-form .name").parent().parent().find(".msg").html("name is required!");
            $(".user-form .name").focus();
            return;
        }
        $(".user-form .name").parent().parent().find(".msg").hide();
        var tel = $(".user-form .tel").val();
        if(!tel.match(/^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/)){
            $(".user-form .tel").parent().parent().find(".msg").html("telephone is invalid.");
            $(".user-form .tel").focus();
            return;
        }
        $(".user-form .tel").parent().parent().find(".msg").hide();
        var watchid = $(".user-form .watchid").val();
        if(!watchid){
            $(".user-form .watchid").parent().parent().find(".msg").html("watchid is required!");
            $(".user-form .watchid").focus();
            return;
        }
        $(".user-form .watchid").parent().parent().find(".msg").hide();
        var email = $(".user-form .email").val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            if(!reg.test(email)){
                $(".user-form .email").parent().parent().find(".msg").html("email is invalid.");
                $(".email").focus();
                return;
            }
        $(".user-form .email").parent().parent().find(".msg").hide();
        var country_name = $(".user-form .country option:selected").text();
        var country_id = $(".user-form .country option:selected").val();
        var address = $(".user-form .address").val();
        if(!address){
            $(".user-form .address").parent().parent().find(".msg").html("address is required!");
            $(".user-form .address").focus();
            return;
        }
        $(".user-form .address").parent().parent().find(".msg").hide();
        var zip_code = $(".user-form .zip_code").val();
        if(!zip_code){
            $(".user-form .zip_code").parent().parent().find(".msg").html("zip code is required!");
            $(".user-form .zip_code").focus();
            return;
        }
        $(".user-form .zip_code").parent().parent().find(".msg").hide();
        var proof = $(".user-form .redactor-editor").html();
        if($(".user-form .redactor-editor").find("img").length===0 && $(".user-form .redactor-editor").text().split(" ").length<20){
            $(".user-form .proof-msg").html("please fill in the proof,either images or text(not less than 20 words)").show();
            $(".user-form .redactor-editor").focus();
            return;
        }
        $(".user-form .proof-msg").hide();
        //路线
        var flag = $(".flag").val();
        var fpid = "";
        var spid = "";
        var selfProDes = "";
        var videoUrl = "";
        //点击了no 获取一级问题和二级问题的id和描述
        var fpele = $("input[name='fp']:checked");
        fpid = fpele.val();
        //var fpdes = fpele.parent().text();
        var spele = $("input[name='sp']:checked");
        spid = spele.val();
        //var spdes = spele.parent().text();
        
        //获取文本编辑器的值
        selfProDes = $(".self-define .redactor-editor").html();
        videoUrl = $(".self-define .video-url").val();
        
        //发送ajax请求
        $.ajax({
            url: "<?=Url::to(['info/info-insert'],true)?>",
            type: "post",
            dataType: "text",
            data: {firstlevel_problem: fpid,secondlevel_problem: spid,problem_des: selfProDes,video: videoUrl,consumer_name: name,watch_id: watchid,email:email,consumer_phone:tel,country:country_id,address:address,zip_code:zip_code,certificate:proof,_csrf:'<?= Yii::$app->request->csrfToken ?>'},
            success: function(data){
                console.log(data);
            }
        });

        //修改样式
        $(".line-img .line2").addClass('active');
        $(".line-img .circle3").addClass('active');
        $(".action-line .title3").addClass('active');
        $(".user-form").hide();
        if($.trim(country_name) == "US"){
            $(".form-submit-us").show();
        }
        else{
            $(".form-submit-nous").show();
        }
    });
</script>
