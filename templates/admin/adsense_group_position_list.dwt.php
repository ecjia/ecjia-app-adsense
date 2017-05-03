<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a href="{$action_link.href}" class="btn plus_or_reply data-pjax" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl dataTable table-hide-edit">
			<thead>
				<tr data-sorthref='{url path="adsense/admin_position/init"}'>
				    <th class="w50">{lang key='adsense::adsense.ad_id'}</th>
	                <th class="w200">{lang key='adsense::adsense.position_name'}</th>
	                <th class="w130">广告位代号</th>
	                <th>{lang key='adsense::adsense.position_desc'}</th>
				    <th class="w100">建议大小</th>
				    <th class="w100">排序</th>
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
				    <td>{$val.sort_order}</td>
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