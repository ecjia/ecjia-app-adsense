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
		<div class="tabbable">
			<form class="form-horizontal" action='{url path="adsense/admin_group/constitute_insert" args="position_id={$position_id}&city_id={$city_id}"}' method="post" name="theForm">
				<div class="tab-content">
					<fieldset>
					
						<div class="control-group choose_list span12" data-url="{url path='adsense/admin_group/get_searchPosition_list'}">
							<!-- <div class="f_l"> -->
								<select name="city_id" id="city_id" disabled="disabled">
			                   		<option value='{$city_id}'>{$city_name}</option>
								</select>
							<!-- </div> -->
							<a class="btn" data-toggle="searchPosition">搜索</a>
							<span class="help-inline m_t5">点击“搜索”按钮，该地区相关的广告位数据会展示在左侧列表框中。点击左侧列表中选项，选中的即可进入右侧已关联列表。保存后生效。</span>
						</div>
						
						<div class="control-group draggable">
							<div class="ms-container " id="ms-custom-navigation">
							
								<div class="ms-selectable">
									<div class="search-header">
										<input class="span12" id="ms-search" type="text" placeholder="筛选搜索到的广告位信息" autocomplete="off">
									</div>
									<ul class="ms-list nav-list-ready">
										<li class="ms-elem-selectable disabled"><span>暂无内容</span></li>
									</ul>
								</div>
								
								<div class="ms-selection">
									<div class="custom-header custom-header-align">编排广告位</div>
									<ul class="ms-list nav-list-content">
										<!-- {foreach from=$group_position_list item=link_position key=key} -->
										<li class="ms-elem-selection">
											<input type="hidden" value="{$link_position.position_id}"   name="position_id[]" />
											<input type="hidden" value="{$link_position.sort_order}" name="sort_order[]" />
											<!-- {$link_position.position_name} --><span class="link_price m_l5">[排序：{$link_position.sort_order}]</span>
											<span class="edit-list"><a class="change_link_price m_r30 " href="javascript:;">修改排序</a><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span>
										</li>
										<!-- {/foreach} -->
									</ul>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<p class="ecjiaf-tac">
					<button class="btn btn-gebo" type="submit">确定</button>
				</p>
			</form>
		</div>
	</div>
</div>
<!-- {/block} -->