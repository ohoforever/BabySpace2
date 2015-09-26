var is_loading = false;
var surplus = $('#surplus');
$(window).scroll(function(){
    if ($(document).height() - $(this).scrollTop() - $(this).height()<50){
        if(surplus.val() == 0 || is_loading){
            return false;
        }

        var page = $('#page').val();
        is_loading = true;
        $.post(
            window.location+'?'+Math.random(),
            {page:page},
            function(res){

                if(res.status == '0'){
                    surplus.val(parseInt(surplus.val())-res.list_total);
                    $("#item-wrap").append(res.html);
                    $('#page').val(res.page);
                } else {
                    surplus.val(0);
                }
            },
            'json'
        ).always(function () {
            is_loading = false;
        });
    }
});