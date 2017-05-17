<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia-merchant.dwt.php"} -->

<!-- {block name="footer"} -->
<!-- {/block} -->

<!-- {block name="home-content"} -->
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content">
            <div class="panel">
                <div class="panel-body">
                	<div class="col-lg-3">
						<div class="setting-group">
					        <span class="setting-group-title"><i class="fa fa-gear"></i> 轮播组</span>
					        <!-- {if $data} -->
					        <ul class="nav nav-list m_t10">
						        <!-- {foreach from=$data item=val} -->
						        	<li><a class="setting-group-item data-pjax {if $position_id eq $val.position_id}llv-active{/if}" href='{url path="adsense/mh_cycleimage/init" args="position_id={$val.position_id}"}'>{$val.position_name}</a></li>
						        <!-- {/foreach} -->
					        </ul>
					        <!-- {/if} -->
					        <br>
						</div>
						<a href='{RC_Uri::url("adsense/mh_cycleimage/add_group")}' class="btn btn-primary data-pjax"><i class="fa fa-plus"></i> 添加轮播组</a>	
					</div>
					
					<div class="col-lg-9">
						<div class="panel-body panel-body-small">
							<h3 class="page-header">
								{if $ur_here}{$ur_here}{/if}{if $city_list}（{$position_code}）{/if}
								{if $position_id}
									<div class="pull-right">
										<a data-toggle="ajaxremove" class="ajaxremove btn btn-primary data-pjax"  data-msg="您要删除该轮播组么？"  href='{RC_Uri::url("adsense/mh_cycleimage/delete_group","position_id={$position_id}")}' title="删除"><i class="fa fa-trash-o"></i> 删除轮播组</a>
										<a href='{RC_Uri::url("adsense/mh_cycleimage/edit_group","position_id={$position_id}")}' class="btn btn-primary data-pjax" title="编辑"><i class="fa fa-plus"></i> 编辑轮播组</a>
									</div>
								{/if}
							</h3>
							
							<!-- {if $available_clients} -->
							<ul class="nav nav-pills pull-left">
						 		<!-- {foreach from=$available_clients key=key item=val} -->
									<li class="{if $show_client eq $client_list.$key}active{/if}"><a class="data-pjax" href='{url path="adsense/mh_cycleimage/init" args="show_client={$client_list.$key}&position_id={$position_id}"}'>{$key}<span class="badge badge-info">{$val}</span></a></li>
								<!-- {/foreach} -->
							</ul>
							<!-- {/if} -->
							
							<section class="panel">
								<table class="table table-striped table-hover table-hide-edit ecjiaf-tlf">
									<thead>
										<tr>
											<th class="w150">缩略图</th>
											<th>图片链接</th>
											<th class="w100">是否开启</th>
											<th class="w50">排序</th>
										</tr>
									</thead>
									<tbody>
										<!-- {foreach from=$cycleimage_list item=item key=key} -->
										<tr>
											<td>
												{if $item.ad_code}
													<img src="{RC_Upload::upload_url()}/{$item.ad_code}" width="100" height="90">
												{/if}
											</td>
											<td class="hide-edit-area">
												<span><a href="{$item.ad_link}" target="_blank">{$item.ad_link}</a></span><br>
												{$item.ad_name}
												<div class="edit-list">
													<a class="data-pjax" href='{RC_Uri::url("adsense/mh_cycleimage/edit", "id={$item.ad_id}&show_client={$show_client}")}' title="编辑">编辑</a>&nbsp;|&nbsp;
													<a data-toggle="ajaxremove" class="ajaxremove ecjiafc-red" data-msg="您要删除这张轮播图么？" href='{RC_Uri::url("adsense/mh_cycleimage/delete", "id={$item.ad_id}&position_id={$position_id}")}' title="删除">删除</a>
											    </div>
											</td>
											<td>
												<i class="cursor_pointer fa {if $item.enabled eq '1'}fa-check {else}fa-times{/if}" data-trigger="toggle_on_sale" data-url='{RC_Uri::url("adsense/mh_cycleimage/toggle_show","position_id={$position_id}&show_client={$show_client}")}' data-id="{$item.ad_id}"></i>
											</td>
											<td><span class="edit_sort cursor_pointer" data-trigger="editable" data-url='{RC_Uri::url("adsense/mh_cycleimage/edit_sort", "position_id={$position_id}&show_client={$show_client}")}' data-name="sort_order" data-pk="{$item.ad_id}" data-title="排序">{$item.sort_order}</span></td>
										</tr>
										<!-- {foreachelse} -->
										   <tr><td class="no-records" colspan="5">{lang key='system::system.no_records'}</td></tr>
										<!-- {/foreach} -->
									</tbody>
								</table>
							</section>
							<a href='{RC_Uri::url("adsense/mh_cycleimage/add","position_id={$position_id}")}' class="btn btn-primary data-pjax"><i class="fa fa-plus"></i> 添加轮播图</a>	
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- {/block} -->