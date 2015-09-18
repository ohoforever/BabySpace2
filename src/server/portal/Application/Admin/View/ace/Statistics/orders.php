<extend name="Public/base" />

<block name="body">
    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5>
                        <i class="icon-signal"></i>
                        油卡订单总数（<?=$yk_total?>）
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
                        一元加盟订单（<?=$jm_total?>）
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
                        订单走势
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

        function pie_charts(obj,data,series_name){
            $(obj).highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
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
                    name: series_name,
                    data: data
                }]
            });
        }

        pie_charts("#piechart-placeholder",<?=$yk_total_json?>,'订单数');
        pie_charts("#phb-chart",<?=$jm_total_json?>,'订单数');

        function get_add_user(month){

            var loading = layer.load('请稍后...');
            $.getJSON('<?=U('orders',['type'=>'add'])?>',{month:month},function(resp){
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
                        {
                            type: 'spline',
                            name: '油卡订单',
                            data:resp.ykcount,
                            marker: {
                                lineWidth: 2,
                                lineColor: Highcharts.getOptions().colors[3],
                                fillColor: 'white'
                            }
                        },
                        {
                            type: 'spline',
                            name: '加盟订单',
                            data:resp.jmcount
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