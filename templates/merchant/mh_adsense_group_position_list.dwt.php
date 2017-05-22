<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!--{extends file="ecjia-merchant.dwt.php"} -->

<!-- {block name="footer"} -->

<!-- {/block} -->

<!-- {block name="home-content"} -->
<div class="row">
     <div class="col-lg-12">
         <div class="position_detail" data-url='{RC_Uri::url("adsense/mh_group/update_sort")}'>
            <h3>广告组信息</h3>
            <ul>
                <li>
	                <div class="detail">
	                	<strong>广告组名称：</strong><span>{$position_data.position_name}{if $position_data.position_code}（{$position_data.position_code}）{else}（无）{/if}</span>
	                	<p class="f_r"> 
			               <a class="data-pjax ecjiafc-gray" href='{RC_Uri::url("adsense/mh_group/edit", "position_id={$position_data.position_id}&city_id={$city_id}")}'><i class="fa fa-edit"></i> 编辑广告组</a>&nbsp;|&nbsp;
			               <a class="ajaxremove ecjiafc-gray" data-toggle="ajaxremove" data-msg="你确定要删除该广告组吗？" href='{RC_Uri::url("adsense/mh_group/remove", "group_position_id={$position_data.position_id}")}' title="删除"><i class="fa fa-trash-o"></i> 删除广告组</a>
		                </p>
	               	</div>
                </li>
            </ul>
          </div>
     </div>		
</div>

<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
		<!-- {if $ur_here}{$ur_here}{/if} --><font style="color: #999;">（拖拽列表可排序）</font>
		<div class="pull-right">
			{if $edit_action_link}
				<a href="{$edit_action_link.href}" class="btn btn-primary data-pjax" id="sticky_a"><i class="fa fa-plus"></i> {$edit_action_link.text}</a>
			{/if}
			
			{if $action_link}
				<a href="{$action_link.href}" class="btn btn-primary data-pjax" id="sticky_a"><i class="fa fa-reply"></i> {$action_link.text}</a>
			{/if}
		</div>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel">
		   <div class="panel-body panel-body-small">
			   	<table class="table table-striped" id="sort">
					<thead>
						<tr data-sorthref='{url path="adsense/mh_group/group_position_list" args="position_id={$position_id}"}'>
						 	<th class="w50">编号</th>
			                <th class="w200">广告位名称</th>
			                <th class="w130">广告位代号</th>
			                <th>广告位描述</th>
						    <th class="index w100" data-toggle="sortby" data-sortby="sort_order">排序</th>
						    <th class="w80">查看</th>
		                </tr>
					</thead>
					<tbody>
		            	<!-- {foreach from=$data item=val} -->
						<tr>
							<td class="position_id"><span>{$val.position_id}</span></td>
						    <td><span>{$val.position_name}</span></td>
						    <td><span>{if $val.position_code}{$val.position_code}{else}<i><无></i>{/if}</span></td>
						    <td><span>{$val.position_desc}</span></td>
						    <td class="position_sort index"><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("adsense/mh_position/edit_sort", "group_position_id={$position_id}")}' data-name="sort_order" data-pk="{$val.position_id}" data-title="排序">{$val.sort_order}</span></td>
						    <td>
							   	<a class="data-pjax" href='{RC_Uri::url("adsense/mh_ad/init", "position_id={$val.position_id}")}' title="查看广告"><button class="btn btn-primary screen-btn">查看广告</button></a>
						    </td>
						</tr>
						<!-- {foreachelse} -->
		                <tr><td class="no-records" colspan="7">{lang key='system::system.no_records'}</td></tr>
		                <!-- {/foreach} -->
		            </tbody>
				</table>
    		</div>

		</div>
	</div>
</div>
<!-- {/block} -->