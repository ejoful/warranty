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
    var fpele = $("input[name='fp']:checked");
    var fpid = fpele.val();
    var fpdes = fpele.parent().text();
    var spele = $("input[name='sp']:checked");
    var spid = spele.val();
    var spdes = spele.parent().text();
    if($.trim(fpdes) == "Others" || typeof(spid) == "undefined"){
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
    $(".self-define").hide();
    $(".sel-pro").show();
});