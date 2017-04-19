// JavaScript Document
;
(function(app, $) {
	app.shortcut = {
		shortcut_group_info: function() {
			var $this = $('form[name="theForm"]');
			var option = {
				rules: {
					position_name: {
						required: true
					},
					position_code: {
						required: true
					},
				},
				messages: {
					position_name: {
						required: "菜单组名称"
					},
					position_code: {
						required: "菜单组代号"
					},
				},
				submitHandler: function() {
					$this.ajaxSubmit({
						dataType: "json",
						success: function(data) {
							ecjia.admin.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.admin.defaultOptions.validate, option);
			$this.validate(options);
		},
		
		shortcut_info: function() {
			var $this = $('form[name="theForm"]');
			var option = {
				rules: {
					ad_link: {
						required: true
					},
				},
				messages: {
					ad_link: {
						required: "请输入图片链接"
					},
				},
				submitHandler: function() {
					$this.ajaxSubmit({
						dataType: "json",
						success: function(data) {
							ecjia.admin.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.admin.defaultOptions.validate, option);
			$this.validate(options);
		},
	};
})(ecjia.admin, jQuery);

// end