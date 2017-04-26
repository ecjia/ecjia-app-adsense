<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.adsense_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="row-fluid">
     <div class="span612">
         <div class="alert alert-block alert-info fade in">
                <h4 class="alert-heading">广告位信息</h4>
                <table class="table m_t10">
					<tr>
						<td style="border-top: 0px"><div align="right">广告位名称：</div></td>
						<td style="border-top: 0px"><div align="left">{$position_data.position_name}{if $position_data.position_code}（{$position_data.position_code}）{else}（无）{/if}</div></td>
						
						<td style="border-top: 0px"><div align="right">所在城市：</div></td>
						<td style="border-top: 0px"><div align="left">{$position_data.city_name}</div></td>
						
						<td style="border-top: 0px"><div align="right">显示数量：</div></td>
						<td style="border-top: 0px"><div align="left">{$position_data.max_number}</div></td>
						
						<td style="border-top: 0px"><div align="right">建议大小：</div></td>
						<td style="border-top: 0px"><div align="left">{$position_data.ad_width} x {$position_data.ad_height}</div></td>
					</tr>
				</table>
                <p class="t_r"><a href='{url path="adsense/admin_position/edit" args="position_id={$position_id}"}'>快速进入广告位 >></a></p>
         </div>
     </div>
</div>

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
			<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		{/if}
		
		{if $back_position_list}
        	<a class="btn plus_or_reply data-pjax" href="{$back_position_list.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$back_position_list.text}</a>
        {/if}
	</h3>
</div>

<!-- {if $available_clients} -->
	<ul class="nav nav-pills">
 		<!-- {foreach from=$available_clients key=key item=val} -->
		<li class="{if $show_client eq $client_list.$key}active{/if}"><a class="data-pjax" href='{url path="adsense/admin/init" args="show_client={$client_list.$key}&position_id={$position_id}"}'>{if $key === 0}未选择{else}{$key}{/if}<span class="badge badge-info">{$val}</span></a></li>
	<!-- {/foreach} -->
</ul>
<!-- {/if} -->

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl dataTable table-hide-edit" id="smpl_tbl">
			<thead>
				<tr>
				    <th class="w100">{lang key='adsense::adsense.ad_id'}</th>
                	<th>{lang key='adsense::adsense.ad_name'}</th>
			    	<th class="w100">{lang key='adsense::adsense.media_type'}</th>
			    	<th class="w150">{lang key='adsense::adsense.start_date'}</th>
			    	<th class="w150">{lang key='adsense::adsense.end_date'}</th>
			    	<th class="w100">是否开启</th>
			    	<th class="w100">排序</th>
                </tr>
			</thead>
			<tbody>
                <!-- {foreach from=$ads_list item=list} -->
                <tr>
                   <td> 
                    	<span>{$list.ad_id}</span>
                    </td>
                    <td class="hide-edit-area hide_edit_area_bottom">
					    <span class="cursor_pointer" data-text="text"data-trigger="editable" data-url="{RC_Uri::url('adsense/admin/edit_ad_name')}" data-name="ad_name" data-pk="{$list.ad_id}" data-title="{lang key='adsense::adsense.edit_ad_name'}">
					    {$list.ad_name}
					    </span>
					    
					    <span>
					    {if $list.image}
					    <a tabindex="0" role="button" href="javascript:;" class="no-underline cursor_pointor" data-id="{$list.ad_id}" data-trigger="focus" data-toggle="popover" data-placement="top" title="{$list.ad_name}">{lang key='adsense::adsense.preview_image'}</a>
					    <div class="hide" id="content_{$list.ad_id}"><img class="mh150" src="{$list.image}"></div> 
					    {/if}
					    </span>
				    	<div class="edit-list">
					      	<a class="data-pjax" href='{RC_Uri::url("adsense/admin/edit", "ad_id={$list.ad_id}&position_id={$position_id}&show_client={$show_client}")}' title="{lang key='system::navigator.edit'}">{lang key='adsense::adsense.edit'}</a>&nbsp;|&nbsp;
				      		<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg="{lang key='adsense::adsense.confirm_remove'}" href='{RC_Uri::url("adsense/admin/remove","ad_id={$list.ad_id}")}' title="{lang key='adsense::adsense.remove'}">{lang key='adsense::adsense.remove'}</a>
						</div>
				    </td>
				    <td>
				    {if $list.media_type === 0}图片{elseif $list.media_type ===2}代码{elseif $list.media_type ===3}文字{/if}
				    </td>
				    <td>{$list.start_time}</td>
				    <td>{$list.end_time}</td>
				    <td>
				    	<i class="{if $list.enabled eq '1'}fontello-icon-ok cursor_pointer{else}fontello-icon-cancel cursor_pointer{/if}" data-trigger="toggleState" data-url='{RC_Uri::url("adsense/admin/toggle_show","position_id={$position_id}&city_id={$city_id}&show_client={$show_client}")}' data-id="{$list.ad_id}" ></i>
					</td>
					<td><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("adsense/admin/edit_sort", "position_id={$position_id}&show_client={$show_client}")}' data-name="sort_order" data-pk="{$list.ad_id}" data-title="排序">{$list.sort_order}</span></td>
                </tr>
                <!-- {foreachelse} -->
                <tr><td class="no-records" colspan="7">{lang key='system::system.no_records'}</td></tr>
                <!-- {/foreach} -->
            </tbody>
     	</table>
	   <!-- {$ads_list.page} -->
	</div>
</div>
<!-- {/block} -->