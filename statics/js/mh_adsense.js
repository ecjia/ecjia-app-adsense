// JavaScript Document
;(function (app, $) {
    app.merchant_adsense_list = {
        init: function () {
            //筛选功能
            $('.screen-btn').on('click', function (e) {
                e.preventDefault();
                var url = $("form[name='searchForm']").attr('action')
                    url += '&media_type=' + $("#media_type option:selected").val() + '&position_id=' + $("input[name='position_id']").val()+ '&show_client=' + $("input[name='show_client']").val();
                ecjia.pjax(url);
            });
            
            $("[data-toggle='popover']").popover({ 
            	html: true,
	    		content: function() {
	    			var id = $(this).attr('data-id');
	    			return $("#content_" + id).html();
	    		},
    		});
        }
    }
})(ecjia.merchant, jQuery);
 
// end