<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
{if $city_list}
<div class="row-fluid batch">
	<ul class="nav nav-pills">
	 <!-- {foreach from=$city_list item=val} -->
		<li class="{if $city_id eq $val.city_id}active{/if}"><a class="data-pjax" href='{url path="adsense/admin_cycleimage/init" args="city_id={$val.city_id}"}'>{$val.city_name}<span class="badge badge-info"></span></a></li>
	 <!-- {/foreach} -->
	</ul>
</div>
{else}
<div class="alert alert-error">
	<a class="close" data-dismiss="alert">×</a>
	<strong>温馨提示：</strong>请您先添加轮播组。
</div>
{/if}



<div class="row-fluid">
	<div class="span3">
		<div class="setting-group">
	        <span class="setting-group-title"><i class="fontello-icon-cog"></i>轮播组</span>
	        <!-- {if $data} -->
	        <ul class="nav nav-list m_t10">
		        <!-- {foreach from=$data item=val} -->
		        	<li><a class="setting-group-item data-pjax {if $position_id eq $val.position_id}llv-active{/if}" href='{url path="adsense/admin_cycleimage/init" args="position_id={$val.position_id}&city_id={$city_id}"}'>{$val.position_name}</a></li>
		        <!-- {/foreach} -->
	        </ul>
	        <br>
	        <!-- {/if} -->
	        <a class="data-pjax" href='{RC_Uri::url("adsense/admin_cycleimage/add_group")}'><button class="btn" type="button">添加轮播组</button></a>
		</div>
	</div>
	<div class="span9">
		<h3 class="heading">
			<!-- {if $ur_here}{$ur_here}{/if} -->
			{if $position_id}
				<a href='{RC_Uri::url("adsense/admin_cycleimage/edit_group","position_id={$position_id}&city_id={$city_id}")}' class="btn plus_or_reply data-pjax" ><i class="fontello-icon-edit"></i>编辑轮播组</a>
				<a data-toggle="ajaxremove" class="ajaxremove btn plus_or_reply"  data-msg="您要删除该轮播组么？"  href='{RC_Uri::url("adsense/admin_cycleimage/delete_group","position_id={$position_id}&city_id={$city_id}")}' title="删除"><i class="fontello-icon-trash"></i>删除轮播组</a>
			{/if}
		</h3>
		
		<!-- {if $available_clients} -->
		<ul class="nav nav-pills">
	 		<!-- {foreach from=$available_clients key=key item=val} -->
				<li class="{if $show_client eq $client_list.$key}active{/if}"><a class="data-pjax" href='{url path="adsense/admin_cycleimage/init" args="show_client={$client_list.$key}&position_id={$position_id}&city_id={$city_id}"}'>{$key}<span class="badge badge-info">{$val}</span></a></li>
			<!-- {/foreach} -->
		</ul>
		<!-- {/if} -->
		
		<table class="table table-striped table-hide-edit" data-rowlink="a">
			<thead>
				<tr>
					<th class="w150">缩略图</th>
					<th>图片链接</th>
					<th class="w50">排序</th>
				</tr>
			</thead>
			<!-- {foreach from=$cycleimage_list item=item} -->
			<tr>
				<td>
					{if $item.ad_code}
						<img src="{RC_Upload::upload_url()}/{$item.ad_code}" width="100" height="90">
					{/if}
				</td>
				<td class="hide-edit-area">
					<span><a href="{$item.ad_link}" target="_blank">{$item.ad_link}</a></span><br>
					<div class="edit-list">
						<a class="data-pjax" href='{RC_Uri::url("adsense/admin_cycleimage/edit", "id={$item.ad_id}&city_id={$city_id}")}' title="编辑">编辑</a>&nbsp;|&nbsp;
						<a data-toggle="ajaxremove" class="ajaxremove ecjiafc-red" data-msg="您要删除这张轮播图么？" href='{RC_Uri::url("adsense/admin_cycleimage/delete", "id={$item.ad_id}")}' title="删除">删除</a>
				    </div>
				</td>
				<td><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("cycleimage/admin/edit_sort", "id={$key}")}' data-name="sort" data-pk="{$key}" data-title="{lang key='cycleimage::flashplay.edit_cycle_sort'}">{$item.sort_order}</span></td>
			</tr>
			<!-- {foreachelse} -->
			   <tr><td class="no-records" colspan="3">{lang key='system::system.no_records'}</td></tr>
			<!-- {/foreach} -->
		</table>
		{if $city_list}
			<a class="data-pjax" href='{RC_Uri::url("adsense/admin_cycleimage/add","position_id={$position_id}&city_id={$city_id}")}'><button class="btn" type="button">添加轮播图</button></a>
		{/if}
	</div>
</div>    
<!-- {/block} -->