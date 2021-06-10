
jQuery(document).ready(function($) {

        var at_document = $(document);

    at_document.on('click','.media-image-upload', function(e){

        // Prevents the default action from occuring.
        e.preventDefault();
        var media_image_upload = $(this);
        var media_title = $(this).data('title');
        var media_button = $(this).data('button');
        var media_input_val = $(this).prev();
        var media_image_url_value = $(this).prev().prev().children('img');
        var media_image_url = $(this).siblings('.img-preview-wrap');

        var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: media_title,
            button: { text:  media_button },
            library: { type: 'image' }
        });
        // Opens the media library frame.
        meta_image_frame.open();
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            media_input_val.val(media_attachment.url);
            if( media_image_url_value !== null ){
                media_image_url_value.attr( 'src', media_attachment.url );
                media_image_url.show();
                LATESTVALUE(media_image_upload.closest("p"));
            }
        });
    });

   // Runs when the image button is clicked.
    jQuery('body').on('click','.media-image-remove', function(e){
        $(this).siblings('.img-preview-wrap').hide();
        $(this).prev().prev().val('');
    });
   
    var LATESTVALUE = function (wrapObject) {
        wrapObject.find('[name]').each(function(){
            $(this).trigger('change');
        });
    };  

});



jQuery(document).ready(function($) {

     var count = 0;
    jQuery("body").on('click','.business-trade-counter-add', function(e) {
      event.preventDefault();
      var additional = $(this).parent().parent().find('.business-trade-counter-additional');
      var container = $(this).parent().parent().parent().parent();
      var container_class = container.attr('id');
      var container_class_array = container_class.split("business-trade-counter-").reverse();
      var instance = container_class_array[0];
      console.log(instance);
      var add = $(this).parent().parent().find('.business-trade-counter-add');
      count = additional.find('.business-trade-counter-section').length;
      additional.append('<div class="business-trade-counter-section"><div class="sub-option section widget-upload">'+
        
        
        '<label for="widget-business-trade-counter['+instance+'][features]['+count+'][counter_title]"><strong>Counter Title :</strong></label>'+
        '<input class="widefat" id="widget-business-trade-counter-'+instance+'-features-'+count+'-counter_title" name="widget-business-trade-counter['+instance+'][features]['+count+'][counter_title]" type="text" value="" />'+

        '<label for="widget-business-trade-counter['+instance+'][features]['+count+'][counter_value]"><strong>Counter Value :</strong></label>'+
        '<input class="widefat" id="widget-business-trade-counter-'+instance+'-features-'+count+'-counter_value" name="widget-business-trade-counter['+instance+'][features]['+count+'][counter_value]" type="number" value="" /><a class="business-trade-counter-remove delete">Remove Counter Section</a></div>');

       
    });

    jQuery(".business-trade-counter-remove").on('click', function() {
        jQuery(this).parent().remove();
    });

    
    var count = 0;
    jQuery("body").on('click','.business-trade-clients-add', function(e) {
      event.preventDefault();
      var additional = $(this).parent().parent().find('.business-trade-clients-additional');
      var container = $(this).parent().parent().parent().parent();
      var container_class = container.attr('id');
      var container_class_array = container_class.split("business-trade-clients-").reverse();
      var instance = container_class_array[0];
      var add = $(this).parent().parent().find('.business-trade-clients-add');
      count = additional.find('.business-trade-clients-section').length;
      additional.append('<div class="business-trade-clients-section"><div class="sub-option section widget-upload">'+
        
        '<p><label for="widget-business-trade-clients['+instance+'][features]['+count+'][client_image]"><strong>Clients Image :</strong></label>'+
          
        '<input class="widefat custom_media_urls" id="widget-business-trade-clients-'+instance+'-features-'+count+'-client_image" name="widget-business-trade-clients['+instance+'][features]['+count+'][client_image]" type="text"  placeholder="No file chosen" />'+

        '<input id="widget-business-trade-clients-'+instance+'-features-'+count+'-client_image" class="upload-button-wdgt custom_media_button button media-image-upload" type="button" value="Upload" /></div></p>'+

        '<label for="widget-business-trade-clients['+instance+'][features]['+count+'][client_url]"><strong> Enter URL :</strong></label>'+
        '<input class="widefat" id="widget-business-trade-clients-'+instance+'-features-'+count+'-client_url" name="widget-business-trade-clients['+instance+'][features]['+count+'][client_url]" type="text" value="" /><a class="business-trade-clients-remove delete"><strong>Remove Clients Section</strong></a></div>');


    });

    jQuery(".business-trade-clients-remove").on('click', function() {
        jQuery(this).parent().remove();
    });


    
});


jQuery(document).ready(function($) {

    var count = 0;
    jQuery("body").on('click','.tm-business-trade-add', function(e) {
     

      e.preventDefault();
      var additional = $(this).parent().parent().find('.tm-business-trade-additional');
      var container = $(this).parent().parent().parent().parent();
     
      var container_class = container.attr('id');
   
      var arr = container_class.split('-');

      var val=  arr[1].split('_');

      val.shift();
     
      var liver=  val.join('_')
      var container_class_array = container_class.split(liver+"-");
      var instance = container_class_array[1];
      var add = $(this).parent().parent().find('.pt-business_trade-add');
      count = additional.find('.tm-business-trade-sec').length;
   
      //Json response
      $.ajax({
        type      : "GET",
        url       : ajaxurl,
        data      : {
            action: 'business_trade_wp_pages_plucker',
        },
        dataType: "json",
        success: function (data) {

            var options = '<option disabled>Select pages</option>';

            $.each(data, function( index, value ) {
              
                var option = '<option value="'+index+'">'+value+'</option>';
               
                options += option;

            });


            additional.append(
                
                '<div class="tm-business-trade-sec"><div class="sub-option section widget-upload">'+
                '<label for="widget-'+liver+'-'+instance+'-features-'+count+'-page_ids"><strong>Select Pages</strong></label>'+
                '<select class="widefat" id="widget-'+liver+'-'+instance+'-features-'+count+'-page_ids"'+
                'name="widget-'+liver+'['+instance+'][features]['+count+'][page_ids]">'+ options + '</select>' +
                '<a class="tm-business-trade-remove delete">Remove Feature</a></div></div>' );

        }
        });
      
    });

     jQuery("body").on('click','.tm-business-trade-remove', function(e) {

       
        jQuery(this).parents('.tm-business-trade-sec').remove();


    });
  
});




jQuery('document').ready(function ($){
// Initialize gototop for carousel
    if ( $('#toTop').length > 0 ) {
    // Hide the toTop button when the page loads.
    $("#toTop").css("display", "none");
    
      // This function runs every time the user scrolls the page.
      $(window).scroll(function(){

        // Check weather the user has scrolled down (if "scrollTop()"" is more than 0)
        if($(window).scrollTop() > 0){

          // If it's more than or equal to 0, show the toTop button.
          $("#toTop").fadeIn("slow");
        }
        else {
          // If it's less than 0 (at the top), hide the toTop button.
          $("#toTop").fadeOut("slow");

        }
      });

      // When the user clicks the toTop button, we want the page to scroll to the top.
      jQuery("#toTop").click(function(event){

        // Disable the default behaviour when a user clicks an empty anchor link.
        // (The page jumps to the top instead of // animating)
        event.preventDefault();

        // Animate the scrolling motion.
        jQuery("html, body").animate({
          scrollTop:0
        },"slow");

      });
    }

})