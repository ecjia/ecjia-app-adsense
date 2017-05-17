<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia-merchant.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
</script>
<!-- {/block} -->

<!-- {block name="home-content"} -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
        <!-- {if $ur_here}{$ur_here}{/if} -->
        {if $action_link}
        <a class="btn btn-primary data-pjax" href="{$action_link.href}" id="sticky_a" style="float:right;margin-top:-3px;"><i class="fa fa-reply"></i> {$action_link.text}</a>
        {/if}
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content">
            <div class="panel">
                <div class="panel-body">
                    <div class="form">
                        <form id="form-privilege" class="form-horizontal" name="theForm" action="{$form_action}" method="post" data-edit-url="{url path='user/admin/edit'}" >
                                <fieldset>
                                	<div class="form-group">
			                            <label class="control-label col-lg-2">{t}上传图片：{/t}</label>
			                            <div class="col-lg-6">
			                                <div class="fileupload fileupload-{if $data.shop_logo}exists{else}new{/if}" data-provides="fileupload">
			                                    {if $data.shop_logo}
			                                    <div class="fileupload-{if $data.shop_logo}exists{else}new{/if} thumbnail" style="max-width: 60px;">
			                                        <img src="{$data.shop_logo}" alt="店铺LOGO" style="width:50px; height:50px;"/>
			                                    </div>
			                                    {/if}
			                                    <div class="fileupload-preview fileupload-{if $data.shop_logo}new{else}exists{/if} thumbnail" style="max-width: 60px;max-height: 60px;line-height: 10px;"></div>
			                                    <span class="btn btn-primary btn-file btn-sm">
			                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i>浏览</span>
			                                        <span class="fileupload-exists"> 修改</span>
			                                        <input type="file" class="default" name="shop_logo" />
			                                    </span>
			                                    <a class="btn btn-danger btn-sm fileupload-exists" {if $data.shop_logo}data-toggle="ajaxremove"{else}data-dismiss="fileupload"{/if} href="{url path='merchant/merchant/drop_file' args="code=shop_logo"}" >删除</a>
			                                	<span class="input-must">{lang key='system::system.require_field'}</span>
			                                </div>
			                                <span class="help-block">此模板的图片标准宽度为：1000px 标准高度为：400px</span>
			                            </div>
			                        </div>
                                	
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">图片链接：</label>
                                        <div class="controls col-lg-6">
                                            <input class="form-control" type="text" name="ad_link" id="ad_link" value=""  />
                                        </div>
                                        <span class="input-must">{lang key='system::system.require_field'}</span>
                                    </div>
                                    
                                   	<div class="form-group">
				                        <label class="control-label col-lg-2">图片说明：</label>
				                        <div class="controls col-lg-6">
				                          <textarea class="form-control" id="ad_name" name="ad_name"></textarea>
				                        </div>
			                      	</div>
			                      	
                      	       		<div class="form-group">
				                        <label class="control-label col-lg-2">投放平台：</label>
				                        <div class="col-lg-6 m_t5">
                                			<input id="user_rank_0" name="user_rank[]" value="0" type="checkbox">
                                            <label for="user_rank_0">非会员</label>
                                            <input id="user_rank_5" name="user_rank[]" value="5" type="checkbox">
                                            <label for="user_rank_5">注册用户</label>
                                            <input id="user_rank_6" name="user_rank[]" value="6" type="checkbox">
                                            <label for="user_rank_6">黄金会员</label>
                                       	</div>
			                      	</div>
			                      	
                      	            <div class="form-group">
				                        <label class="control-label col-lg-2">是否开启：</label>
				                       	<div class="controls col-lg-6">
			                                <input id="open" name="express_assign_auto" value="1" type="radio" checked="true" >
			                                <label for="open">开启</label>
			                                <input id="close" name="express_assign_auto" value="0" type="radio">
			                                <label for="close">关闭</label>
			                            </div>
			                      	</div>
			                      	
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">排序：</label>
                                        <div class="controls col-lg-6">
                                            <input class="form-control" type="text" name="sort_order" id="sort_order" value="" />
                                        </div>
                                    </div>

                                 

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-9">
                                              <button class="btn btn-info" type="submit">确定</button>
                                        </div>
                                    </div>
                                </fieldset>
                           </form>
                        </div>
                   </div>
              </div>
          </div>
     </div>
 </div>
<!-- {/block} -->