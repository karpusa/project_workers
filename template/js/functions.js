// remap jQuery to $
(function($){
	/* trigger when page is ready */
	$(document).ready(function (){

            $(document).on('submit', '#staff_form', function(e) {
                e.preventDefault();
                var form=$(this);
                var error=0;
                $(this).children('.form-group').removeClass('has-error');
                $(this).find('.form-group .help-block').remove();
                form.find('.required').each(function(){                  
                    if (!$(this).val()){
                        if ($(this).is("select")){
                            $(this).parents('.form-group').addClass('has-error').append('<span class="help-block">Выберите должность!</span>');
                        }else{
                            $(this).parents('.form-group').addClass('has-error').append('<span class="help-block">Поле пустое!</span>');
                        }
                        error=1;
                    }
                    //Поле пустое!
                });
                form.find('.validateFloat').each(function(){    
                    if (isNaN($(this).val())){
                        $(this).parents('.form-group').addClass('has-error').append('<span class="help-block">Не верное число!</span>');
                        error=1;
                    }
                });
                
                if (error){
                    return false;
                }
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: form.serialize(),
                    success: function(data)
                    {
                        if (data.redirect){
                            window.location=data.redirect; 
                        }else{
                            $('#page-content').html(data.content);
                        }
                    }
                 });
            });


	
	});
	
	
	/* optional triggers
	
	$(window).load(function() {
		
	});
	
	$(window).resize(function() {
		
	});
	
	*/

})(window.jQuery);