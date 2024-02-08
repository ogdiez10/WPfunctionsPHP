<?php 

function show_key_takeaways(){  //To display blog posts key takeaways field using a shortcode
	$key_takeaways = get_field('key_takeaways');
	return '<div id="key_takeaways"><h3>KEY TAKEAWAYS</h3>'.$key_takeaways.'</div>';
	}
add_shortcode('key_takeaways', 'show_key_takeaways');



function show_cta_banner($atts){  //To display a Custom post type using it's POST ID
	$default = array(
        'id' => '5211',
    );

	$attributes = shortcode_atts($default, $atts);
	$cta = get_post($attributes['id']);
		if($cta){
			$cta_txt = get_field('cta_text', $cta->ID);
			$cta_button = get_field('cta_button_text', $cta->ID);
			$cta_link = get_field('cta_link', $cta->ID);
			$cta_bg = get_field('cta_background_image', $cta->ID);
			if($cta_bg == '') { $cta_bg = 'https://griffinfunding.com/wp-content/uploads/2023/04/Catbanner2.jpg'; }
			return '<div class="cta_banner" style="background:url('.$cta_bg.')"><h3>'.$cta_txt.'</h3><a href="'.$cta_link.'">'.$cta_button.'</a></div>';
		}
	}
add_shortcode('cta_banner', 'show_cta_banner');



function display_read_time() {  //Function to calculate and display "Read time" for a blog post
    $content = get_post_field( 'post_content', $post->ID );
    $count_words = str_word_count( strip_tags( $content ) );
	
    $read_time = ceil($count_words / 250);
	
   
	 if ($read_time == 1) { $read_time_output = '<span class="rt-suffix">&nbsp;'.$read_time.' min read</span>';  }
	 else { $read_time_output = '<span class="rt-suffix"> '.$read_time.' mins read</span>';  }
	

    return $read_time_output;
}

add_shortcode('reading_time', 'display_read_time');

?>

Extra: JS Code to create a table of contents using the H2 headings inside post content, example: https://griffinfunding.com/blog/va-loans/va-approved-condos/

<script type="text/javascript">
jQuery(document).ready(function() {                                                                          
    jQuery('#tocList').empty();  //HTML element to insert code                                                          
    
    var prevH2Item = null;                                                            
    var prevH2List = null;                                                            
    
    var index = 0;                                                                    
    jQuery("#main h2").each(function() {                                                     
    
        //insert an anchor to jump to, from the TOC link.            
        var anchor = "<a name='" + index + "'></a>";                 
        jQuery(this).before(anchor);                                     
        
        var li     = "<li><span>›&nbsp;&nbsp;</span><a href='#" + index + "'>" + jQuery(this).text() + "</a></li>"; 
        
        if( jQuery(this).is("h2") ){                                     
            prevH2List = jQuery("<ul></ul>");                
            prevH2Item = jQuery(li);                                     
            prevH2Item.append(prevH2List);                          
            prevH2Item.appendTo("#tocList");                        
        } else {                                                    
            prevH2List.append(li);                                  
        }                                                           
        index++;                                                    
    });          

	if (jQuery('#tocList').is(':empty')){
		jQuery('.single_post_table_of_contents').fadeOut(0);
	}
	
	jQuery( "#single_post_faqs .faq img" ).click(function() {
		var thisfaq = jQuery(this).attr('data-toggle');
		jQuery( "#" + thisfaq ).toggle( "fast", function() { });
		jQuery(this).toggleClass( "opened" );
	});

	jQuery('#breadcrumbs .breadcrumbs-home').attr('href', 'https://griffinfunding.com/blog');
	
    
});                                                                                                     

</script>