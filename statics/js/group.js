// JavaScript Document
;(function (app, $) {
    app.ad_group_list = {
        init: function () {
            //搜索功能
            $("form[name='searchForm'] .search_ad_position").on('click', function (e) {
                e.preventDefault();
                var url = $("form[name='searchForm']").attr('action');
                var keywords = $("input[name='keywords']").val();
                if (keywords != '') {
                    url += '&keywords=' + keywords;
                }
                ecjia.pjax(url);
            });
        }
    };
 
    /* **编辑** */
    app.ad_group_edit = {
        init: function () {
        	$('.copy').on('click', function() {
				var $this = $(this),
					message = $this.attr('data-msg'),
					url = $this.attr('data-href');
					var city_id = $("#city_id option:selected").val();
					var position_name = $("input[name='position_name']").val();
					var position_desc = $("#position_desc").val()
					var sort_order = $("input[name='sort_order']").val();
	                url += '&city_id=' + city_id+'&position_name=' + position_name+'&position_desc=' + position_desc+'&sort_order=' + sort_order;
				if (message != undefined) {
					smoke.confirm(message, function(e) {
						if (e) {
							$.get(url, function(data){
								ecjia.admin.showmessage(data);
							})
						}
					}, {ok:"确定", cancel:"取消"});
				} 
			});
			
            app.ad_group_edit.submit_form();
        },
        submit_form: function (formobj) {
            var $form = $("form[name='theForm']");
            var option = {
                rules: {
                    position_name: {
                        required: true
                    },
                    position_code: {
                        required: true
                    }
                },
                messages: {
                    position_name: {
                        required: "请输入广告组名称"
                    },
                    position_code: {
                        required: "请输入广告组代号"
                    }
                },
                submitHandler: function () {
                    $form.ajaxSubmit({
                        dataType: "json",
                        success: function (data) {
                            ecjia.admin.showmessage(data);
                        }
                    });
                }
            }
            var options = $.extend(ecjia.admin.defaultOptions.validate, option);
            $form.validate(options);
        }
	};
    
})(ecjia.admin, jQuery);

//end