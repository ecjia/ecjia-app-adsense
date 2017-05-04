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
						<div class="control-group draggable">
							<div class="ms-container" id="ms-custom-navigation">
								<div class="ms-selectable">
									<div class="search-header">
										<input class="span12" id="ms-search" type="text" placeholder="筛选搜索到的广告位信息" autocomplete="off">
									</div>
									<ul class="ms-list nav-list-ready">
										<!-- {foreach from=$opt item=link_position} -->
											<li class="ms-elem-selectable"  id="{$link_position.value}" data-id="{$link_position.value}"><span>{$link_position.text}</span></li>
										<!-- {foreachelse} -->
											<li class="ms-elem-selectable disabled"><span>暂无内容</span></li>
										<!-- {/foreach} -->
									</ul>
								</div>
								<div class="ms-selection">
									<div class="custom-header custom-header-align">
										编排广告位
									</div>
									<ul class="ms-list nav-list-content">
										<!-- {foreach from=$group_position_list item=link_position key=key} -->
										<li class="ms-elem-selection">
											<input type="hidden" value="{$link_position.position_id}" name="position_id[]" />
											{$link_position.position_name}
											<span class="edit-list"><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span>
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