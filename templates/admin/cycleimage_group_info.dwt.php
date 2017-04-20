<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
ecjia.admin.cycleimage.cycleimage_group_info();
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
		<form class="form-horizontal" action='{$form_action}' method="post" name="theForm">
			<div class="row-fluid edit-page editpage-rightbar">
				<div class="left-bar move-mod">
			        <div class="control-group formSep">
			        	<label class="control-label">轮播组名称：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="position_name" value="{$data.position_name}" />
			            	<span class="input-must">{lang key='system::system.require_field'}</span>
			            </div>
			        </div>
			        
			        <div class="control-group formSep">
			        	<label class="control-label">轮播组代号：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="position_code" value="{$data.position_code}" />
			            	<span class="input-must">{lang key='system::system.require_field'}</span>
			            </div>
			        </div>
			      
			        <div class="control-group formSep">
			        	<label class="control-label">轮播组描述：</label>
			          	<div class="controls">
			            	<textarea name="position_desc" class="w350"  cols="60" rows="5">{$data.position_desc}</textarea>
			            </div>
			        </div>	
			        
			        <div class="control-group formSep">
			        	<label class="control-label">可展示数量最大值：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="max_number" value="{$data.max_number}" />
			            </div>
			        </div>	
			        
			        <div class="control-group formSep">
			        	<label class="control-label">排序：</label>
			          	<div class="controls">
			            	<input class="w350" type="text" name="sort_order" value="{if $data.sort_order}{$data.sort_order}{else}50{/if}" />
			            </div>
			        </div>		        
			        
			        <div class="control-group">
			        	<div class="controls">
				        	<input type="submit" value="确定" class="btn btn-gebo" />
					        <input type="hidden" name="position_id" value="{$data.position_id}" />
					    </div>
		        	</div>	  
				</div>
		
				<div class="right-bar move-mod">
					<div class="foldable-list move-mod-group" id="goods_info_sort_author">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle collapsed move-mod-head" data-toggle="collapse" data-target="#goods_info_area_author">
									<strong>选择城市</strong>
								</a>
							</div>
							<div class="accordion-body in in_visable collapse" id="goods_info_area_author">
								<div class="accordion-inner">
									<div class="control-group-small formSep" >
										<label class="control-label">选择城市：</label>
        								<select name="city_id">
					                   		<option value='0'>默认</option>
					                      	<!-- {html_options options=$city_list selected=$data.city_id} -->
										</select>
									</div>	
									
									<div class="control-group-small formSep">
							        	<label class="control-label">宽度：</label>
							            <input type="text" name="ad_width" value="{$data.ad_width}"  class="" placeholder="像素" />
							        </div>
							        
							  		<div class="control-group-small">
							        	<label class="control-label">高度：</label>
						            	<input type="text" name="ad_height" value="{$data.ad_height}" class="" placeholder="像素" />
							        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- {/block} -->