<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.ad_position_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="alert">
	<a class="close" data-dismiss="alert">×</a>
	<strong>温馨提示：</strong>建议您添加"默认"广告位，当并未设置地区时就会显示默认的广告位。
</div>

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a href="{$action_link.href}" class="btn plus_or_reply data-pjax" id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid batch">
	<ul class="nav nav-pills">
	 <!-- {foreach from=$city_list item=val} -->
		<li class="{if $city_id eq $val.city_id}active{/if}"><a class="data-pjax" href='{url path="adsense/admin_position/init" args="city_id={$val.city_id}"}'>{$val.city_name}<span class="badge badge-info"></span></a></li>
	 <!-- {/foreach} -->
	</ul>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl dataTable table-hide-edit">
			<thead>
				<tr>
				    <th class="w70">{lang key='adsense::adsense.ad_id'}</th>
	                <th class="w200">{lang key='adsense::adsense.position_name'}</th>
	                <th class="w150">广告位代号</th>
	                <th>{lang key='adsense::adsense.position_desc'}</th>
				    <th class="w100">{lang key='adsense::adsense.posit_width'}</th>
				    <th class="w100">{lang key='adsense::adsense.posit_height'}</th>
				    <th class="w80"></th>
                </tr>
			</thead>
			<tbody>
            	<!-- {foreach from=$data item=val} -->
				<tr>
					<td><span>{$val.position_id}</span></td>
				    <td class="hide-edit-area hide_edit_area_bottom">
				    	<span class="cursor_pointer" data-text="text" data-trigger="editable" data-url="{RC_Uri::url('adsense/admin_position/edit_position_name')}" data-name="position_name" data-pk="{$val.position_id}" data-title="{lang key='adsense::adsense.edit_ad_position_name'}">{$val.position_name}</span>
				    	<br>
                    	<div class="edit-list">
					      	<a class="data-pjax" href='{RC_Uri::url("adsense/admin_position/edit", "position_id={$val.position_id}&city_id={$city_id}")}' title="{lang key='system::navigator.edit'}">{lang key='system::system.edit'}</a>&nbsp;|&nbsp;
					    	<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg="{lang key='adsense::adsense.confirm_remove'}" href='{RC_Uri::url("adsense/admin_position/remove", "id={$val.position_id}")}' title="{lang key='adsense::adsense.remove'}">{lang key='adsense::adsense.remove'}</a>
						</div>
				    </td>
				    <td><span>{$val.position_code}</span></td>
				    <td><span>{$val.position_desc}</span></td>
				    <td>
				    	<span class="cursor_pointer" data-text="text" data-trigger="editable" data-url="{RC_Uri::url('adsense/admin_position/edit_ad_width')}" data-name="ad_width" data-pk="{$val.position_id}" data-title="{lang key='adsense::adsense.edit_position_width'}">{$val.ad_width}</span>
				    </td>
				    <td>
					    <span class="cursor_pointer" data-text="text" data-trigger="editable" data-url="{RC_Uri::url('adsense/admin_position/edit_ad_height')}" data-name="ad_height" data-pk="{$val.position_id}" data-title="{lang key='adsense::adsense.edit_position_height'}">{$val.ad_height}</span>
				    </td>
				    <td>
					   	<a class="data-pjax" href='{RC_Uri::url("adsense/admin/init", "position_id={$val.position_id}")}' title="查看广告"><button class="btn">查看广告</button></a>
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