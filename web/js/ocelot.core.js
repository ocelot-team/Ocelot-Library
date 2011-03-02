(function($) {
    
	$.fn.ocelot = function(options) {
    
        $.fn.ocelot.defaults = {
            interval: 3,
            unit: 'ms'
        };
        
		var opts = $.extend({}, $.fn.ocelot.defaults, options);
        
		return this.each(function() {
			var ocelot, requestTime, responseTime ;
			var target = $(this);
			function ocelot() {
				$.ajax({url: 'empty' + Math.random() + '.html',
					type: 'GET',
					dataType: 'html',
					timeout: 30000,
					beforeSend : function() {
						requestTime = new Date().getTime();
					},
					complete : function() {
						responseTime = new Date().getTime();
						ocelot = Math.abs(requestTime - responseTime);
						target.text(ocelot + opts.unit);
					}
				});
			}
			ocelot();
			opts.interval != 0 && setInterval(ocelot,opts.interval * 1000);
		});
        
	};
    
})(jQuery);
