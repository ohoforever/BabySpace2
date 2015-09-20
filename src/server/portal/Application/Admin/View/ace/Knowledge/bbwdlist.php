<extend name="Public/base"/>

<block name="body">
    <!-- �����б� -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="search-form">
                        <empty name="model.extend">
                            <label>
                                <button class="btn btn-sm btn-inverse ajax-post confirm" target-form="ids" url="{:U('del?model='.$model['id'])}">
                                    <i class="icon-trash"></i>ɾ ��
                                </button>
                            </label>
                        </empty>
                        <!-- �߼����� -->
                       <!-- <label>
                            <input type="text" name="{$model['search_key']|default='title'}" class="search-input" value="{:I('title')}" placeholder="������ؼ���">
                        </label>-->
                        <label>״̬��
                            <?php
                            echo form_dropdown('status',$status_list,I('status'));
                            ?>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" id="search" url="{:U('knowledge/bbwdlist')}">
                                <i class="icon-search"></i>����
                            </button>
                        </label>
                    </form>
                </div>
            </div>

            <include file="Think/lists_common"/>
            <include file="Public/page"/>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">
        $(function(){

            //��������
            <?php if(isset($active_menu)):?>
            highlight_subnav('<?=U($active_menu)?>');
            <?php else:?>
            highlight_subnav('{:U('Model/index')}');
            <?php endif;?>
        })
    </script>
</block>
