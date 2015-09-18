<extend name="Public/base" />

<block name="body">
    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5>
                        <i class="icon-signal"></i>
                        微信用户总数（<?=array_sum($user_total)?>）
                    </h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="piechart-placeholder">

                        </div>
                    </div><!-- /widget-main -->
                </div><!-- /widget-body -->
            </div><!-- /widget-box -->
        </div><!-- /col-sm-6 -->

        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5>
                        <i class="icon-signal"></i>
                        推广达人排行榜
                    </h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="phb-chart">

                        </div>
                    </div><!-- /widget-main -->
                </div><!-- /widget-body -->
            </div><!-- /widget-box -->
        </div>
    </div>
    <div class="hr hr32 hr-dotted"></div>

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5>
                        <i class="icon-signal"></i>
                        新增关注微信用户
                    </h5>

                    <div class="widget-toolbar no-border">
                        <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span id="selected-month">本月</span>
                            <i class="icon-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu pull-right dropdown-125 dropdown-lighter dropdown-caret" id="month-select">
                            <li>
                                <a href="javascript:" month="0">
                                    <i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
                                    本月
                                </a>
                            </li>

                            <li>
                                <a href="javascript:" month="1">
                                    <i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
                                    上月
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="container" style="min-width:400px;height:400px">

                        </div>
                    </div><!-- /widget-main -->
                </div><!-- /widget-body -->
            </div><!-- /widget-box -->
        </div><!-- /col-sm-12 -->
    </div>
</block>


<block name="script">
<script type="text/javascript" src="http://static.hcharts.cn/highcharts/highcharts.js"></script>

<script>

    $(function () {
        $('#piechart-placeholder').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
//            tooltip: {
//                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '用户数',
                data: [
                    {
                        name: '微商用户',
                        y: <?=$user_total['shop']?>,
                        sliced: true,
                        selected: true
                    },
                    ['未关注用户',   <?=$user_total[-1]?>],
                    ['普通用户',       <?=$user_total[1]?>],
                    ['已取消关注',       <?=$user_total[0]?>],
                ]
            }]
        });

        $('#phb-chart').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: <?=json_encode(array_keys($hot_total))?>,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '推广人数',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '推广数',
                data: <?=json_encode(array_map("intval",array_values($hot_total)))?>
            }]
        });

        function get_add_user(month){

            var loading = layer.load('请稍后...');
            $.getJSON('<?=U('users',['type'=>'add'])?>',{month:month},function(resp){
                if(resp.status != '1'){
                    layer.alert(resp.msg,3);
                    return false;
                }

                $('#container').highcharts({
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: resp.date
                    },
                    series: [
//                {
//                    type: 'column',
//                    name: 'Jane',
//                    data: [3, 2, 1, 3, 4]
//                }, {
//                    type: 'column',
//                    name: 'John',
//                    data: [2, 3, 5, 7, 6]
//                }, {
//                    type: 'column',
//                    name: 'Joe',
//                    data: [4, 3, 3, 9, 1]
//                },
                        {
                            type: 'spline',
                            name: '新增关注',
                            data:resp.count,
                            marker: {
                                lineWidth: 2,
                                lineColor: Highcharts.getOptions().colors[3],
                                fillColor: 'white'
                            }
                        }
                    ]
                });
            }).always(function () {
                layer.close(loading);
            });
        }

        get_add_user(0);

        $("#month-select a").click(function(){
            var $this = $(this);
            get_add_user($this.attr('month'));
            $("#selected-month").text($.trim($this.text()));
        })
    });

</script>
</block>