<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.adsense_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
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

<div class="foldable-list move-mod-group" id="goods_info_sort_submit">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle collapsed move-mod-head" data-toggle="collapse" data-target="#position_data">
				<strong>广告位信息</strong>
			</a>
		</div>
		<div class="accordion-body in collapse" id="position_data">
			<table class="table table-oddtd m_b0">
				<tbody class="first-td-no-leftbd">
					<tr>
						<td><div align="right"><strong>广告位名称：</strong></div></td>
						<td>{$position_data.position_name}</td>
						<td><div align="right"><strong>广告位代号：</strong></div></td>
						<td>{$position_data.position_code}</td>
					</tr>
					<tr>
						<td><div align="right"><strong>选择城市：</strong></div></td>
						<td>{$position_data.city_name}</td>
						<td><div align="right"><strong>可展示数量最大值：</strong></div></td>
						<td>{$position_data.max_number}</td>
					</tr>
					<tr>
						<td><div align="right"><strong>建议宽度：</strong></div></td>
						<td>{$position_data.ad_width}</td>
						<td><div align="right"><strong>建议高度：</strong></div></td>
						<td>{$position_data.ad_height}</td>
					</tr>
					<tr>
						<td><div align="right"><strong>广告位描述：</strong></div></td>
						<td colspan="3">{$position_data.position_desc}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- {if $available_clients} -->
	<ul class="nav nav-pills">
 		<!-- {foreach from=$available_clients key=key item=val} -->
		<li class="{if $show_client eq $client_list.$key}active{/if}"><a class="data-pjax" href='{url path="adsense/admin/init" args="show_client={$client_list.$key}&position_id={$position_id}"}'>{$key}<span class="badge badge-info">{$val}</span></a></li>
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
			    	<th class="w100">{lang key='adsense::adsense.click_count'}</th>
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
				    <td>{$list.click_count}</td>
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