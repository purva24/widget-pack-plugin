<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Featured_Posts extends WP_Widget {
	// Controller
	function __construct() {
	$widget_ops = array('classname' => 'my_widget_class', 'description' => __('Insert the plugin description here', 'wp_widget_plugin'));
	$control_ops = array('width' => 300, 'height' => 300);
	parent::WP_Widget(false, $name = __('Featured_Posts', 'wp_widget_plugin'), $widget_ops, $control_ops );
?>  
<?php
}

public function form($instance) { 
	$defaults = array(
            'title' => __('Popular Posts'), 
            'post_count' => 5 ,
            'checkbox_var'=> 0,
            'category'=> 0,
            );
	$instance = wp_parse_args( (array) $instance, $defaults );
	if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
            $post_count=$instance['post_count'];
	}
	else {
            $title =$defaults['title'];
            $post_count=$defaults['post_count'];
	}?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
        
	<p>
		<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Top Posts:', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="number" value="<?php echo $post_count;?>" />
	</p>
        
<!--        <p>
            <input type="radio" 
                   id="<?php echo $this->get_field_id('your_radio'); ?>"
                   name="<?php echo $this->get_field_name('your_radio'); ?>"
                   <?php if (isset ($instance['your_radio']) && $instance['your_radio']=="views") echo "checked";?>
                      value="views">Sort by views
            <input type="radio" 
                   id="<?php echo $this->get_field_id('your_radio')   ; ?>"
                   name="<?php echo $this->get_field_name('your_radio'); ?>"
                   <?php if (isset ($instance['your_radio']) && $instance['your_radio']=="comments") echo "checked";?>
                    value="comments">Sort by comments
        </p>-->
  
        <p> 
                <input class="img_check" type="checkbox" <?php checked($instance['checkbox_var'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var'); ?>" name="<?php echo $this->get_field_name('checkbox_var'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var'); ?>">Check to display post thumbnail</label>
        </p>
     
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var1'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var1'); ?>" name="<?php echo $this->get_field_name('checkbox_var1'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var1'); ?>">Check to display Post Date</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var2'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var2'); ?>" name="<?php echo $this->get_field_name('checkbox_var2'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var2'); ?>">Check to display Post Author</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var3'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var3'); ?>" name="<?php echo $this->get_field_name('checkbox_var3'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var3'); ?>">Check to display Post Category</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var4'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var4'); ?>" name="<?php echo $this->get_field_name('checkbox_var4'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var4'); ?>">Check to display Number of Comments</label>
        </p>
         
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var5'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var5'); ?>" name="<?php echo $this->get_field_name('checkbox_var5'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var5'); ?>">Check to display Post Excerpt with Read More link</label>
        </p>
        
       <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['checkbox_var6'], 'on'); ?> id="<?php echo $this->get_field_id('checkbox_var5'); ?>" name="<?php echo $this->get_field_name('checkbox_var6'); ?>" /> 
                <label for="<?php echo $this->get_field_id('checkbox_var6'); ?>">Check to display number of views</label>
        </p>
        
        <p>
            <?php $args = array(
                'selected'           => $instance['category']
            );
            wp_dropdown_categories( $args );?>
        </p>
        
       
        
<!--        <li id="categories">
	<h2><?php _e('Categories:'); ?></h2>
	<form action="<?php bloginfo('url'); ?>" method="get">
	<div>
	<?php wp_dropdown_categories('show_count=1&hierarchical=1'); ?>
	<input type="submit" name="submit" value="view" />
	</div>
	</form>-->
</li>
        
	
        
       
<?php }
public function update($new_instance,$old_instance){
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['category'] = $new_instance['category'];
    $instance['post_count'] = strip_tags( $new_instance['post_count'] );
    $instance['your_radio'] = strip_tags( $new_instance['your_radio'] );
    $instance['checkbox_var'] =strip_tags($new_instance['checkbox_var']);
    $instance['checkbox_var1'] =strip_tags($new_instance['checkbox_var1']);
    $instance['checkbox_var2'] =strip_tags($new_instance['checkbox_var2']);
    $instance['checkbox_var3'] =strip_tags($new_instance['checkbox_var3']);
    $instance['checkbox_var4'] =strip_tags($new_instance['checkbox_var4']);
    $instance['checkbox_var5'] =strip_tags($new_instance['checkbox_var5']);
    $instance['checkbox_var5'] =strip_tags($new_instance['checkbox_var5']);
    $instance['checkbox_var6'] =strip_tags($new_instance['checkbox_var5']);
    
    return $instance;
}       

public function widget($args, $instance) {
            
	    $post_count = $instance['post_count'];
            $title = apply_filters('widget_title', $instance['title']);
		// Display the widget title
            echo '<div class="recent-posts">';
            if ( $title )
                
                    echo "<h3 class='widget-title'>$title</h3>";
	//Display the name
                    $args = new WP_Query(
                        array(
                            "posts_per_page" => $post_count,
                            "post_type" => "post",
                            "post_status" => "publish",
                            "meta_key" => "mp_views",
                            "orderby" => "meta_value_num",
                            "order" => "DESC"
                        )
                    );
                    global $post;
                    echo'<div class="feat-posts">'; 
                    if($args->have_posts()) { echo "<ul>"; }
                    while ( $args->have_posts() ) : $args->the_post();
                    echo'<li class="widget-list">';
                    echo'<div class="post-data">';
                    echo'<div class="post-img">';
                    if($instance['checkbox_var']){                          
                       display_featured_image();
                    }   
                    echo'</div>';
                    echo'<div class="post-details">';
                    echo'<div class="post-title">';
                    echo '<a href="'.get_permalink($post->ID).'">'.the_title('', '', false).'</a>';
                    echo'<p>';
                    echo'</div>';
                    if($instance['checkbox_var1']){
                        echo "Date:";
                        echo the_date('','','',TRUE);                    }
                    echo'</p>';
                    echo'<p>';
                    if($instance['checkbox_var2']){
                        display_author_name();
                    }
                    echo'</p>';
                    
                    if($instance['checkbox_var3']){
                        echo'<p>';
                        echo "Category:";
                        echo get_the_category_list();
                        echo'</p>';                                            
                    }                    
                    echo'</div>';
                    echo'</div>';
                    echo'<div class="post_stats">';
                    echo'<p>';
                    if($instance['checkbox_var4']){
                        echo comments_number();
                    }
                    echo'</p>';
                    echo'<p>';
                    if(isset($instance['checkbox_var6'])){
                        show_views();
                    }
                    echo'</p>';
                    echo'</div>';
                    echo'<div class="post_excerpt">';
                    echo'<p>';
                    if($instance['checkbox_var5']){
                        echo " Excerpt:";        
                        the_excerpt();
                    }
                    echo'</p>';
                    echo'</div>';
                    
         
            echo'</li>';
            endwhile;
            if($args->have_posts()) { echo "</ul>"; }
            echo'</div>';
            echo'</div>';

    }
}

//add_action('widgets_init', create_function('', 'return register_widget("Featured_Posts");'));
?>

