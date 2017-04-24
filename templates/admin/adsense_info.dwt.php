<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.adsense_edit.init();
</script>
<!-- {/block} -->
    
<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link} 
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid edit-page">
	<div class="span12">
		<div class="tabbable">
			<form class="form-horizontal" action="{$form_action}" method="post" enctype="multipart/form-data" name="theForm">
				<fieldset>
					<div class="row-fluid edit-page editpage-rightbar">
						<div class="left-bar move-mod">
							<!--左边-->
							<div class="control-group formSep">
								<label class="control-label">{lang key='adsense::adsense.ad_name_lable'}</label>
								<div class="controls">
									<input type="text" name="ad_name" value="{$ads.ad_name}" size="35"/>
									<span class="input-must">{lang key='system::system.require_field'}</span>
									<br><span class="help-block">{lang key='adsense::adsense.ad_name_notic'}</span>
								</div>
							</div>
					
							{if $action eq "insert"}
								<div class="control-group formSep">
									<label class="control-label">{lang key='adsense::adsense.media_type_lable'}</label>
									<div class="controls">
										<select name="media_type" id="media_type">
											<option value='0'>{lang key='adsense::adsense.ad_img'}</option>
											<option value='2'>{lang key='adsense::adsense.ad_html'}</option>
											<option value='3'>{lang key='adsense::adsense.ad_text'}</option>
										</select>
									</div>
								</div>
							{else}
								<input type="hidden" name="media_type" value="{$ads.media_type}" />
							{/if}
					
							<div class="control-group formSep">
								<label class="control-label">{lang key='adsense::adsense.position_id_lable'}</label>
								<div class="controls">
									<select name="position_id">
			                            <option value='0'>{lang key='adsense::adsense.outside_posit'}</option>
	        							<!-- {html_options options=$position_list selected=$ads.position_id} -->
								</select>
								</div>
							</div>
							
							<div class="control-group formSep">
								<label class="control-label">{lang key='adsense::adsense.start_date_lable'}</label>
								<div class="controls">
									<input type="text" class="date" name="start_time" size="22" value="{$ads.start_time}" />
								</div>  
							</div>  
					
							<div class="control-group formSep">
								<label class="control-label">{lang key='adsense::adsense.end_date_lable'}</label>
								<div class="controls">
									<input type="text" class="date" name="end_time" size="22" value="{$ads.end_time}" />
								</div>  
							</div>  
					
							<!-- 图片 0-->
							{if $ads.media_type eq 0 OR $action eq "insert"}
							<div class="control-group">
								<div id="media_type_0">
									<div class="control-group formSep">
										<label class="control-label">{lang key='adsense::adsense.ad_link'}</label>
										<div class="controls">
											<input type="text" name="ad_link" class="span10" value="{$ads.ad_link}" size="35"/>
										</div>
									</div>
									
									<div class="control-group formSep">
										<label class="control-label">上传图片：</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px; line-height: 50px;">
					                              	{if $ads.url}
					                                 <img src="{$ads.url}"/>
					                                {/if}
					                            </div>
												<span class="btn btn-file">
													<span  class="fileupload-new">浏览</span>
													<span  class="fileupload-exists">修改</span>
													<input type='file' name='ad_img' size="35"/>
												</span>
												<a class="btn fileupload-exists" data-dismiss="fileupload" href="#">删除</a>
												<span class="input-must"><span class="require-field" style="color:#FF0000;">*</span></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							{/if}

							<!-- 代码2 -->
							{if $ads.media_type eq 2 OR $action eq "insert"}
							<div id="media_type_2" style="{if $ads.media_type neq 2 OR $action eq 'add'}display:none{/if}">
								<div class="control-group formSep">
									<label class="control-label">{lang key='adsense::adsense.ad_code_label'}</label>
									<div class="controls">
										<textarea name="ad_code" cols="50" rows="6" class="span10">{$ads.ad_code}</textarea>
										<span class="input-must">{lang key='system::system.require_field'}</span>
									</div>
								</div>	
							</div>									
							{/if}
					
							<!-- 文字3 -->
							{if $ads.media_type eq 3 OR $action eq "insert"}
							<div id="media_type_3" style="{if $ads.media_type neq 3 OR $action eq 'add'}display:none{/if}">
								<div class="control-group formSep">
									<label class="control-label">{lang key='adsense::adsense.ad_link'}</label>
									<div class="controls">
										<input type="text" class="span10" name="ad_link2" value="{$ads.ad_link}" size="35"/>
									</div>
								</div>	
								<div class="control-group formSep">
									<label class="control-label">{lang key='adsense::adsense.ad_code'}：</label>
									<div class="controls">
										<textarea name="ad_text" class="span10" cols="40" rows="6"  class="span10">{$ads.ad_code}</textarea>
										<span class="input-must">{lang key='system::system.require_field'}</span>
									</div>
								</div>											
							</div>						
							{/if}
							
							<div class="control-group formSep">
								<label class="control-label">投放平台：</label>
			  					<div class="controls chk_radio">
			  						 <!-- {foreach from=$client_list key=key item=val} -->
										<input type="checkbox" name="show_client[]" value="{$val}" {if in_array($val, $ads.show_client)}checked="true"{/if}/>{$key}
									 <!-- {/foreach} -->
								</div>
							</div>
							
							<div class="control-group formSep">
								<label class="control-label">{lang key='adsense::adsense.enabled'}</label>
								<div class="controls">
									 <input type="radio" name="enabled" value="1" {if $ads.enabled eq 1} checked="true" {/if} />{lang key='adsense::adsense.is_enabled'}
						        	 <input type="radio" name="enabled" value="0" {if $ads.enabled eq 0} checked="true" {/if} />{lang key='adsense::adsense.no_enabled'}
								</div>
							</div>	
							
							<div class="control-group formSep">
								<label class="control-label">排序：</label>
								<div class="controls">
									<input class="span8" name="sort_order" type="text" value="{if $ads.sort_order}{$ads.sort_order}{else}50{/if}" />
								</div>
							</div>
							
							<div class="control-group">
					        	<div class="controls">
					        		<!-- {if $ads.ad_id} -->
					        		<input type="submit" value="{lang key='adsense::adsense.update'}" class="btn btn-gebo" />
									<input type="hidden" name="id" value="{$ads.ad_id}" />
									<input type="hidden" id="type" value="{$ads.type}" />	
									<!-- {else} -->
									<input type="submit" value="{lang key='system::system.button_submit'}" class="btn btn-gebo" />
									<!-- {/if} --> 
							    </div>
					        </div>	    
						</div>
						<!-- 右边 -->
						<div class="right-bar move-mod">
							<div class="foldable-list move-mod-group">
								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle acc-in move-mod-head" data-toggle="collapse" data-target="#telescopic1"><strong>{lang key='adsense::adsense.ad_contact_info'}</strong></a>
									</div>
									<div class="accordion-body in collapse" id="telescopic1">
										<div class="accordion-inner">
											<div class="control-group control-group-small formSep">
												<label class="control-label">{lang key='adsense::adsense.name'}</label>
												<div class="span8">
													<input name="link_man" type="text" value="{$ads.link_man}"  />
												</div>
											</div>
											
											<div class="control-group control-group-small formSep">
												<label class="control-label">{lang key='adsense::adsense.email'}</label>
												<div class="span8">
													<input name="link_email" type="text" value="{$ads.link_email}"  />
												</div>
											</div>
											
											<div class="control-group control-group-small">
												<label class="control-label">{lang key='adsense::adsense.phone'}</label>
												<div class="span8">
													<input name="link_phone" type="text" value="{$ads.link_phone}"  />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>				
					</div>
				</fieldset>
	    	</form>
		</div>
	</div>
</div>  
<!-- {/block} -->