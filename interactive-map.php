<?php get_header(); ?>

<?php $option = get_option( 'property_options' ); ?>
<div class="ui grid container">
    <div class="ui four wide column hide-mobile map-category-filter">
       <?php apply_filters('map_category_filter', null); ?> 
    </div>
    <div class="ui twelve wide column">
        <div id="map-canvas" class="interactive-map"></div>
        
        <div class="ui internally celled grid">
            <?php $properties = apply_filters('map_get_properties', null); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    window.onhashchange = function(){
    
    
    };
    
    jQuery(document).ready(function(e){
        
        //alert(window.location.hash);
    
        jQuery('.map-category-filter li a').click(function(e){
            
            jQuery('.map-category-filter li').removeClass('active');
            jQuery(this).parent().addClass('active');
            
        });
        
        var $map = jQuery('#map-canvas').mapster({
            center: {
                lat: 18.1,
                lng: -77.3
            },
            zoom: 9
        });
        
        <?php foreach( $properties as $index => $property ): ?>
            content  = '<div class="property-info-window">Hello World';
            content += '</div>';
            $map.mapster('addMarker', {
                    lat: <?php echo $property['latitude']; ?>,
                    lng: <?php echo $property['longitude']; ?>,
                    category: '<?php echo $property['category']; ?>',
                    <?php if( $option['marker_icon'] ): ?>
                    icon: '<?php echo $option['marker_icon']; ?>',
                    content: content
                    <?php endif; ?>
            });
        <?php endforeach; ?>
        
        console.log($map.mapster('markers'));
        
        
    
    });
    
</script>

<?php var_dump( '<pre>', $properties, '</pre>' ); ?>
<?php get_footer(); ?>