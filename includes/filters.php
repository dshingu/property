<?php

/**
 *
 *  Helper function to override template for viewing single property
 *
 **/

function property_single_template_filter( $template ){
    global $post;
    
    if( $post->post_type == 'property'){
        
        $template = PLUGIN_DIR.'/single-property.php';
        
    }
    
    return $template;
    
}

/**
 *
 *  Helper function to override template for viewing archive property
 *
 **/

function property_archive_template_filter( $template ){
    
    return PLUGIN_DIR.'/archive-property.php';
    
}

/**
 *
 *  Helper function to override template for viewing interactive map
 *
 **/

function property_interactive_map_template( $template ){
    
    if( is_page_template( 'interactive-map.php' ) ){
        $template = PLUGIN_DIR.'/interactive-map.php';
    }
    
    return $template; 
}

/**
 *
 *  Helper function to display categories for properties for the interactive map
 *
 **/

function property_map_category_filter(){
    
    $options = get_option( 'property_options' );
    
    $categories = get_categories( [ 'hide_empty' => 0, 'parent' => $options['parent_cat'] ] );
    
    if( !empty( $categories) ):
    
?>
<ul>
    <li><h6>Filter by Parish:</h6></li>
    <?php foreach( $categories as $index => $category ): ?>
        <li>
            <a href="#<?php echo $category->slug; ?>"><?php echo ucwords( $category->name ); ?></a>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif;
}

/**
 *
 *  Helper function to fetch properties
 *
 **/

function get_properties(){
            
    $properties = new WP_Query(['post_type' => 'property']);
    
    $_properties = [];
    $x = 0;
    
    while( $properties->have_posts()){
    
        $properties->the_post();
        global $post;
        
        $property_data = get_post_meta( $post->ID, 'property_data', true );
        $tmp_array     = explode( ',', $property_data['image_ids'] );
        
        $_properties[$x]['title']       = $post->post_title;
        $_properties[$x]['link']        = get_the_permalink();
        $_properties[$x]['longitude']   = $property_data['longitude'];
        $_properties[$x]['latitude']    = $property_data['latitude'];
        $category                       = get_the_category();
        $_properties[$x]['category']    = $category[0]->slug;
        
        foreach( $tmp_array as $key => $value ){
            
            $_properties[$x]['images'][] = wp_get_attachment_image_url( $value, 'medium' );
            
        }
        
        
       $x++;
    }
    
    wp_reset_postdata();
    
    return $_properties;
        
}

/**
 *
 *  Filter to  create jQuery slider on single-property view
 *
 **/

function single_property_slider_filter() {
 
    global $post;
    $property_data = get_post_meta($post->ID, 'property_data', true);
    $property_option = get_option( 'property_options');
    
    $images = property_get_images ($post->ID, 'large');
?>
<?php if (is_array($images)): ?>
<div class="single-property-slider">
    <?php foreach ($images as $index => $image_src): ?>
        <div><img src="<?php echo $image_src; ?>" /></div>
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        
        // Setup Slider
        
        $('.single-property-slider').slick({
            fade: true,
            prevArrow: '<a class="single-property-slider-nav prev"></a>',
            nextArrow: '<a class="single-property-slider-nav next"></a>',
            infinite: true
        });
        
        $('.single-property-featured-properties').slick({
            fade: true,
            autoPlay: true,
            arrows: false,
            dots:true, 
            infinite: true
        });
        
        // Setup Map
        
        <?php if (isset($property_data['longitude']) && isset($property_data['latitude'])): ?>
        
        var map_properties = {
            center: {
                lng: <?php echo $property_data['longitude']; ?>,
                lat: <?php echo $property_data['latitude']; ?>
            },
            zoom: 9,
            draggable: false
        };
        
        map = $('#map-canvas').mapster(map_properties);
        
        map.mapster('addMarker', {
            <?php if ($property_option['marker_icon']): ?>
            icon: '<?php echo $property_option['marker_icon']; ?>',
            <?php endif; ?>
            content: '<h4><?php echo $post->post_title; ?></h4>',
            lat: <?php echo $property_data['latitude']; ?>,
            lng: <?php echo $property_data['longitude']; ?>
        });
        
        
        <?php endif; ?>
    });
</script>
<?php endif; ?>
<?php    
}

/**
 *
 *  Helper function to create Featured Property on single view
 *
 **/

function property_single_featured_properties() {

    $property_options = get_option('property_options');

    $properties = new WP_Query([
        'post_type' => 'property',
        'cat'       => $property_options['featured_cat']
    ]);
    
    if ($properties->have_posts()) {
        
        echo '<div class="single-property-featured-properties">';
        
        while ($properties->have_posts()) {
            
            $properties->the_post();
            global $post;
            $property_category = get_the_category();
            $images = property_get_images($post->ID, 'medium');
            $image = array_shift($images);
        ?>
            <div>
                <a href="<?php echo get_the_permalink(); ?>">
                    <img src="<?php echo $image; ?>" />
                    <div class="shadow-overlay">
                        <h5><?php echo $post->post_title; ?></h5>
                    </div>
                </a>
            </div>   
 <?php    
        }
        
        echo '</div>';
        
    }
    wp_reset_postdata();
    
    
    
}