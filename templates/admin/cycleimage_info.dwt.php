<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
ecjia.admin.cycleimage.cycleimage_info();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="data-pjax btn plus_or_reply" id="sticky_a" href="{$action_link.href}"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>
<div class="row-fluid">
	<div class="span12">
		<form class="form-horizontal"  name="theForm" action="{$form_action}" method="post" enctype="multipart/form-data" >
			<fieldset>
				<div class="control-group formSep">
					<label class="control-label">上传图片：</label>
					<div class="controls">
						<div class="fileupload {if $data.ad_code}fileupload-exists{else}fileupload-new{/if}" data-provides="fileupload">
							<div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px; line-height: 50px;">
								{if $data.ad_code}
								<img src="{RC_Upload::upload_url()}/{$data.ad_code}"/>
								{/if}
							</div>
							<span class="btn btn-file">
								<span  class="fileupload-new">浏览</span>
								<span  class="fileupload-exists">修改</span>
								<input type='file' name='ad_code' size="35"/>
							</span>
							<span class="input-must"><span class="require-field" style="color:#FF0000;">*</span></span>
							<span class="help-block">此模板的图片标准宽度为：484px 标准高度为：200px</span>
						</div>
					</div>
				</div>

				<div class="control-group formSep">
					<label class="control-label">图片链接：</label>
					<div class="controls">
						<input class="span8" name="ad_link" type="text" value="{$data.ad_link}" />
						<span class="input-must">*</span>
					</div>
				</div>
				
				<div class="control-group formSep" >
					<label class="control-label">图片说明：</label>
					<div class="controls">
						<textarea class="span8" name="ad_name" cols="40" rows="3">{$data.ad_name}</textarea>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">投放平台：</label>
  					<div class="controls chk_radio">
  						 <!-- {foreach from=$client_list key=key item=val} -->
							<input type="checkbox" name="show_client[]" value="{$val}" {if in_array($val, $data.show_client)}checked="true"{/if}/>{$key}
						 <!-- {/foreach} -->
					</div>
				</div>
	
				<div class="control-group formSep">
					<label class="control-label">{lang key='adsense::adsense.enabled'}</label>
					<div class="controls">
						 <input type="radio" name="enabled" value="1" {if $data.enabled eq 1} checked="true" {/if} />开启
			        	 <input type="radio" name="enabled" value="0" {if $data.enabled eq 0} checked="true" {/if} />关闭
					</div>
				</div>	
				
				<div class="control-group formSep">
					<label class="control-label">排序：</label>
					<div class="controls">
						<input class="span8" name="sort_order" type="text" value="{if $data.sort_order}{$data.sort_order}{else}50{/if}" />
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="city_id" value="{$city_id}" />
						<input type="hidden" name="id" value="{$data.ad_id}" />
						<input type="hidden" name="position_id" value="{$position_id}" />
						{if $data.ad_id eq ''}
						<button class="btn btn-gebo" type="submit">确认</button>
						{else}
						<button class="btn btn-gebo" type="submit">更新</button>
						{/if}
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->