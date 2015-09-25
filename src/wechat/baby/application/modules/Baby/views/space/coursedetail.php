<!--main-->
<section class="main hei100">
    <div class="timeline padt40" id="item-wrap">
        <?php
        require_once 'ajaxCourse.php';
        ?>
    </div>
    <input type="hidden" id="page" value="<?=$pageIndex?>" />
    <input type="hidden" id="surplus" value="<?=$total-count($list)?>" />
</section>
<block name="script">
    <script>
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
    </script>
</block>