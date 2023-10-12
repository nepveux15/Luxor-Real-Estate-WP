(function($){
	
    var api = wp.customize;
	
	
    api.SliderControl = api.Control.extend({ 
	
        ready: function() {
			
            var control = this,
            picker = this.container.find('#border-radius-slider'),
			sliderInput = this.container.find('#border-radius-input');
			//picker = this.container.find('.slider-input');
				

            picker.val(control.setting()).slider({
                change: function(event, ui){ 
                    control.setting.set(ui.value);
                }               
            });
			
			sliderInput.val(control.setting()).slider({
                change: function(event, ui){ 
                    control.setting.set(ui.value);
                }               
            });
			
        }
    });

    api.controlConstructor['slider'] = api.SliderControl;   
	
	//alert( wp.customize('navBorderRadius') );
		
	//Marker Size
	/*var sliderVal = $(".slider-input").val();
	
	var sliderOpts = {
		min:1,
		max: 99,
		value: sliderVal != 10 ? sliderVal : 10,
		slide: function() {
	
			var value = $("#border-radius-slider").slider("value");
	
			$(".slider-input").val(value);
		}
	};

	$("#border-radius-slider").slider(sliderOpts);*/
	

})(jQuery);