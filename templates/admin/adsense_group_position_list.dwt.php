<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="row-fluid">
     <div class="span12">
         <div class="position_detail">
            <h3>广告组信息</h3>
            <ul>
                <li><div class="detail"><strong>广告组名称：</strong><span>{$position_data.position_name}{if $position_data.position_code}（{$position_data.position_code}）{else}（无）{/if}</span></div></li>
                <li><div class="detail"><strong>所在城市：</strong><span>{$position_data.city_name}</span></div></li>
            </ul>
          </div>
     </div>		
</div>

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a href="{$action_link.href}" class="btn plus_or_reply data-pjax" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
		
		{if $edit_action_link}
		<a href="{$edit_action_link.href}" class="btn plus_or_reply data-pjax" id="sticky_a"><i class="fontello-icon-plus"></i>{$edit_action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl dataTable table-hide-edit">
			<thead>
				<tr data-sorthref='{url path="adsense/admin_group/group_position_list" args="city_id={$city_id}&position_id={$position_id}"}'>
				    <th class="w50">编号</th>
	                <th class="w200">广告位名称</th>
	                <th class="w130">广告位代号</th>
	                <th>广告位描述</th>
				    <th class="w100">建议大小</th>
				    <th class="w100" data-toggle="sortby" data-sortby="sort_order">排序</th>
				    <th class="w80">查看</th>
                </tr>
			</thead>
			<tbody>
            	<!-- {foreach from=$data item=val} -->
				<tr>
					<td><span>{$val.position_id}</span></td>
				    <td><span>{$val.position_name}</span></td>
				    <td><span>{if $val.position_code}{$val.position_code}{else}<i><无></i>{/if}</span></td>
				    <td><span>{$val.position_desc}</span></td>
				    <td><span>{$val.ad_width} x {$val.ad_height}</span></td>
				    <td><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("adsense/admin_position/edit_sort", "city_id={$city_id}&group_position_id={$position_id}")}' data-name="sort_order" data-pk="{$val.position_id}" data-title="排序">{$val.sort_order}</span></td>
				    <td>
					   	<a class="data-pjax" href='{RC_Uri::url("adsense/admin/init", "position_id={$val.position_id}&city_id={$city_id}")}' title="查看广告"><button class="btn">查看广告</button></a>
				    </td>
				</tr>
				<!-- {foreachelse} -->
                <tr><td class="no-records" colspan="7">{lang key='system::system.no_records'}</td></tr>
                <!-- {/foreach} -->
            </tbody>
		</table>
		<!-- {$position_list.page} -->
	</div>
</div>
<!-- {/block} -->