<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!--{extends file="ecjia-merchant.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.merchant.merchant_adsense_list.init();
</script>
<!-- {/block} -->

<!-- {block name="home-content"} -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">
			<!-- {if $ur_here}{$ur_here}{/if} -->
			<div class="pull-right">
				<div class="pull-right">
					{if $back_position_list}
			        	<a class="btn btn-primary data-pjax" href="{$back_position_list.href}" ><i class="fa fa-reply"></i> {$back_position_list.text}</a>
			        {/if}
					{if $action_link}
						<a class="btn btn-primary data-pjax" href="{$action_link.href}" ><i class="fa fa-plus"></i> {$action_link.text}</a>
					{/if}
				</div>
			</div>
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel">
		   <div class="panel-body panel-body-small">
			   	<ul class="nav nav-pills pull-left">
				<!-- {if $available_clients} -->
			 		<!-- {foreach from=$available_clients key=key item=val} -->
						<li class="{if $show_client eq $client_list.$key}active{/if}"><a class="data-pjax" href='{url path="adsense/mh_ad/init" args="show_client={$client_list.$key}&position_id={$position_id}&media_type={$media_type}"}'>{$key}<span class="badge badge-info">{$val}</span></a></li>
					<!-- {/foreach} -->
				<!-- {/if} -->
				</ul>
    			<form class="form-inline pull-right" method="post" action="{$search_action}"  name="searchForm">
		            <div class="screen f_r">
		                <div class="form-group">
		                    <select name="media_type" id="media_type" class="no_search w150">
		                        <option value='-1'  {if $smarty.get.media_type eq '-1' } selected="true" {/if}>{lang key='adsense::adsense.choose_media_type'}</option>
								<option value='0' {if $smarty.get.media_type eq '0'} selected="true" {/if}>{lang key='adsense::adsense.ad_img'}</option>
								<option value='2' {if $smarty.get.media_type eq '2'} selected="true" {/if}>{lang key='adsense::adsense.ad_html'}</option>
								<option value='3' {if $smarty.get.media_type eq '3'} selected="true" {/if}>{lang key='adsense::adsense.ad_text'}</option>
		                    </select>
		                </div>
			            <input type="hidden" value="{$position_id}" name="position_id" />
						<input type="hidden" value="{$show_client}" name="show_client" />
		                <button class="btn btn-primary screen-btn" type="button"><i class='fa fa-search'></i> {lang key='bonus::bonus.filter'}</button>
		            </div>
		        </form>
    		</div>
			<div class="panel-body panel-body-small">
				<section class="panel">
					<table class="table table-striped table-hover table-hide-edit ecjiaf-tlf">
						<thead>
							<tr>
							    <th class="w100">编号</th>
			                	<th>广告名称</th>
						    	<th class="w150">媒介类型</th>
						    	<th class="w150">开始日期</th>
						    	<th class="w150">结束日期</th>
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
								    {if $list.ad_code}
									    <a tabindex="0" role="button" href="javascript:;" class="no-underline cursor_pointor" data-id="{$list.ad_id}" data-trigger="focus" data-toggle="popover" data-placement="top" title="{$list.ad_name}">（预览）</a>
									    <div class="hide" id="content_{$list.ad_id}"><img class="mh150" src="{RC_Upload::upload_url()}/{$list.ad_code}"></div> 
								    {/if}
								    </span>
								    
							    	<div class="edit-list">
								      	<a class="data-pjax" href='{RC_Uri::url("adsense/admin/edit", "ad_id={$list.ad_id}&position_id={$position_id}&show_client={$show_client}")}' title="{lang key='system::navigator.edit'}">{lang key='adsense::adsense.edit'}</a>&nbsp;|&nbsp;
							      		<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg="{lang key='adsense::adsense.confirm_remove'}" href='{RC_Uri::url("adsense/admin/remove","ad_id={$list.ad_id}")}' title="{lang key='adsense::adsense.remove'}">{lang key='adsense::adsense.remove'}</a>
									</div>
							    </td>
							    <td>
							    {if $list.media_type eq 0}图片{elseif $list.media_type eq 2}代码{else}文字{/if}
							    </td>
							    <td>{$list.start_time}</td>
							    <td>{$list.end_time}</td>
							    <td>
							    	<i class="{if $list.enabled eq '1'}fontello-icon-ok cursor_pointer{else}fontello-icon-cancel cursor_pointer{/if}" data-trigger="toggleState" data-url='{RC_Uri::url("adsense/admin/toggle_show","position_id={$position_id}&city_id={$city_id}&show_client={$show_client}")}' data-id="{$list.ad_id}" ></i>
								</td>
								<td><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("adsense/admin/edit_sort", "position_id={$position_id}&show_client={$show_client}")}' data-name="sort_order" data-pk="{$list.ad_id}" data-title="排序">{$list.sort_order}</span></td>
			                </tr>
							<!-- {foreachelse}-->
							<tr><td class="no-records" colspan="7">{lang key='system::system.no_records'}</td></tr>
							<!-- {/foreach} -->
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</div>
</div>
<!-- {/block} -->