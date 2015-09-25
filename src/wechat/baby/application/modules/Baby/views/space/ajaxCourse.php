<?php
$year = date('Y');
?>
<?php foreach($list as $item):?>
    <div class="table his-box">
        <div class="cell date-cont">
                <span class="date">
                    <?php
                    if(date('Y') == $year){
                        echo date('m-d',strtotime($item['attendTime']));
                    }else{
                        echo date('Y.m.d',strtotime($item['attendTime']));
                    }
                    ?>
                </span>
        </div>
        <div class="cell history">
            <p><?=$item['className']?></p>
            <p class="blue">耗课<?=$item['courseCount']?>节</p>
        </div>
    </div>
<?php endforeach;?>