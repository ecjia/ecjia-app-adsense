<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
ecjia.admin.link_goods.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
			<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="row-fluid">
	<div class="span12">
		<form class="form-horizontal" action='{$form_action}' method="post" name="theForm">
			<div class="row-fluid edit-page editpage-rightbar">
				<div class="left-bar move-mod">
			        <div class="control-group formSep">
			        	<label class="control-label">广告组名称：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="position_name" value="{$data.position_name}" />
			            	<span class="input-must">{lang key='system::system.require_field'}</span>
			            </div>
			        </div>
			        <div class="control-group formSep">
			        	<label class="control-label">广告组代号：</label>
				        <div class="controls l_h30">
							{if $data.position_id}
								<strong>{$data.position_code}</strong>
								<input type="hidden" name="position_code" value="{$data.position_code}" />
							{else}
								<input class="w350" type="text" name="position_code" />
				          		<span class="input-must">{lang key='system::system.require_field'}</span>
							{/if}
							<span class="help-block">广告组调用标识，且在同一地区下该标识不可重复。</span>
						</div>
			        </div>
			      
			        <div class="control-group formSep">
			        	<label class="control-label">广告组描述：</label>
			          	<div class="controls">
			            	<textarea name="position_desc" class="w350"  cols="60" rows="5">{$data.position_desc}</textarea>
			            </div>
			        </div>	
			        
			        <div class="control-group">
			        	<label class="control-label">排序：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="sort_order" value="{if $data.sort_order}{$data.sort_order}{else}50{/if}" />
			            </div>
			        </div>
				</div>
		
				<div class="right-bar move-mod">
					<div class="foldable-list move-mod-group" id="goods_info_sort_author">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle collapsed move-mod-head" data-toggle="collapse" data-target="#goods_info_area_author">
									<strong>选择城市</strong>
								</a>
							</div>
							<div class="accordion-body in in_visable collapse" id="goods_info_area_author">
								<div class="accordion-inner">
									
									
									<div class="control-group control-group-small formSep">
							        	<label class="control-label">宽度：</label>
							        	<div class="controls">
								        	<input type="text" name="ad_width" value="{$data.ad_width}"  class="" placeholder="像素" />
											<span class="help-block">建议轮播组宽度单位为Px</span>
										</div>
							        </div>
							        
							  		<div class="control-group control-group-small">
							        	<label class="control-label">高度：</label>
							        	<div class="controls">
						            		<input type="text" name="ad_height" value="{$data.ad_height}" class="" placeholder="像素" />
						            		<span class="help-block">建议轮播组高度单位为Px</span>
						            	</div>
							        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<h3 class="heading">组装广告位</h3>
			<div class="tab-content">
				<fieldset>
					<div class="control-group span12 search_link_goods" data-url="{url path='adsense/admin_group/get_position_list'}">
						<div class="ecjiaf-cb">
							<div class="f_l m_r5">
								<select name="city_id" id="city_id">
			                   		<option value='0'>默认</option>
			                      	<!-- {html_options options=$city_list selected=$data.city_id} -->
								</select>
							</div>
							<a class="btn" data-toggle="searchPosition">搜索</a>
						</div>
						<span class="help-inline m_t5">先选择地区，与该地区相关的广告位数据会展示在左侧列表框中。点击左侧列表中选项，选中的即可进入右侧已关联列表。保存后生效。您还可以在右侧编辑关联模式。</span>
					</div>
					<div class="control-group draggable">
						<div class="ms-container" id="ms-custom-navigation">
							<div class="ms-selectable">
								<div class="search-header">
									<input class="span12" id="ms-search" type="text" placeholder="{lang key='goods::goods.filter_goods_info'}" autocomplete="off">
								</div>
								<ul class="ms-list nav-list-ready">
									<li class="ms-elem-selectable disabled"><span>{lang key='goods::goods.no_content'}</span></li>
								</ul>
							</div>
							<div class="ms-selection">
								<div class="custom-header custom-header-align">{lang key='goods::goods.tab_linkgoods'}</div>
								<ul class="ms-list nav-list-content">
									<!-- {foreach from=$link_goods_list item=link_good key=key} -->
									<li class="ms-elem-selection">
										<input type="hidden" value="{$link_good.goods_id}" name="goods_id[]" data-double="{if $link_good.is_double}1{else}0{/if}" />
										<span class="link_static m_r5">{if $link_good.is_double}[{lang key='goods::goods.double'}]{else}[{lang key='goods::goods.single'}]{/if}</span><!-- {$link_good.goods_name} -->
										<span class="edit-list"><a class="change_links_mod" href="javascript:;">{lang key='goods::goods.switch_relation'}</a><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span>
									</li>
									<!-- {/foreach} -->
								</ul>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<fieldset class="t_c">
				{if $data.position_id}
        			<input type="hidden" name="position_id" value="{$data.position_id}" />
        			<input type="submit" value="更新" class="btn btn-gebo" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        			<a class="copy ecjiafc-red" style="cursor: pointer;" data-msg="您确定要进行复制该轮播组信息吗？" data-href='{url path="adsense/admin_cycleimage/copy" args="position_id={$position_id}"}' title="复制"><button class="btn" type="button">复制</button></a>
        		{else}
        			<input type="submit" value="确定" class="btn btn-gebo" />
        		{/if}
			</fieldset> 
		</form>
	</div>
</div>

<!-- {/block} -->