jQuery(function($){

    // Set all variables to be use in the scope
    
    var frame,
        metaBox         = $('#property_gallery_mb.postbox'),
        addImageLink    = metaBox.find('.upload-custom-image'),
        deleteImageLink = metaBox.find('span.property-admin-remove'),
        imageContainer  = metaBox.find('.custom-img-container'),
        imageIdInput    = metaBox.find('.property_gallery_image_ids');
        
        addImageLink.on('click', function(e){
            
            e.preventDefault();
            
            // If media frame already exists, then open it
            
            if ( frame ) {
                frame.open();
                return;
            }
            
            // Create media frame
            
            frame = wp.media({
                
                title:  'Select or upload Media: Hold down control (ctr) key to select multiple images',
                button: {
                    text: 'Insert'
                },
                multiple: true
                
            });
            
            frame.on( 'select', function(){
                
                var image_id = [];
                var image_url = [];
            
                var attachments = frame.state().get('selection');
                
                attachments.map(function(attachment){
                    attachment = attachment.toJSON();
                    image_id.push(attachment.id);
                    image_url.push(attachment.sizes.thumbnail.url);
                });
                
                if ( imageContainer.find('ul').length ) {
                    
                    image_url.forEach(function(element, index){
                        
                        imageContainer.find('ul').append('<li data-id="'+ image_id[index] +'"><img src="'+ element +'" /> <span class="dashicons dashicons-dismiss property-admin-remove"></span></li>');
                        
                    });
                    
                }else {
                    
                    /*var html = '<ul>';
                    
                        image_url.forEach(function(element, index){
                        
                            html += '<li data-id="'+ image_id[index] +'"><img src="'+ element  +'" /> <span class="dashicons dashicons-dismiss property-admin-remove"></span></li>';
                        
                        });
                        
                        html += '</ul><br class="clear" />';
                        
                        imageContainer.append(html);*/
                    
                }
                
                imageIdInput.val( image_id );
            
            });
            
            // Finally open the media frame
            
            frame.open();  
            
        });
        
        
        metaBox.on('click', 'span.property-admin-remove', function(e){

            e.preventDefault();
            
            var image_id = imageIdInput.val().split(',');
            var indexOf  = image_id.indexOf($(this).parent().data('id'));
            image_id.splice( indexOf,1 );
            $(this).parent().remove();
            imageIdInput.val(image_id);
            
        })

});