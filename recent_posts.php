<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Recent_Posts extends WP_Widget {
	// Controller
	function __construct() {
	$widget_ops = array('classname' => 'my_widget_class', 'description' => __('Widget that displays details about recent posts', 'wp_widget_plugin'));
	$control_ops = array('width' => 300, 'height' => 300);
	parent::WP_Widget(false, $name = __('Recent Posts', 'wp_widget_plugin'), $widget_ops, $control_ops );
?>
<?php
}

function form($instance) { 
	$defaults = array( 'title' => __('Recent Posts'), 'post_count' => __('5'), 'your_checkbox_var' => __('0')
            , 'your_checkbox_var1' => __('0'), 'your_checkbox_var2' => __('0'), 'your_checkbox_var3' => __('0')
            , 'your_checkbox_var4' => __('0'), 'your_checkbox_var5' => __('0'), 'read_more' => __('Read More..'));
	$instance = wp_parse_args( (array) $instance, $defaults );
	if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
            $post_count=$instance['post_count'];
            $read_more=$instance['read_more'];
	}
	else {
            $title =$defaults['title'];
            $post_count=$defaults['post_count'];
            $read_more=$defaults['read_more'];
            
	}?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var'); ?>">Display Featured Image</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var1'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var1'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var1'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var1'); ?>">Display Post Date</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var2'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var2'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var2'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var2'); ?>">Display Post Author</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var3'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var3'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var3'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var3'); ?>">Display Post Category</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var4'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var4'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var4'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var4'); ?>">Display Number of Comments</label>
        </p>
        <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['your_checkbox_var5'], 'on'); ?> id="<?php echo $this->get_field_id('your_checkbox_var5'); ?>" name="<?php echo $this->get_field_name('your_checkbox_var5'); ?>" /> 
                <label for="<?php echo $this->get_field_id('your_checkbox_var5'); ?>">Display Post Excerpt with Read More link</label>
        </p>
        
	<p>
		<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="number" value="<?php echo $post_count;?>">
	</p>
        
       
<?php }
function update($new_instance,$old_instance){
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['post_count'] = strip_tags( $new_instance['post_count'] );
    $instance['your_checkbox_var'] = $new_instance['your_checkbox_var'];
    $instance['your_checkbox_var1'] = $new_instance['your_checkbox_var1'];
    $instance['your_checkbox_var2'] = $new_instance['your_checkbox_var2'];
    $instance['your_checkbox_var3'] = $new_instance['your_checkbox_var3'];
    $instance['your_checkbox_var4'] = $new_instance['your_checkbox_var4'];
    $instance['your_checkbox_var5'] = $new_instance['your_checkbox_var5'];
    //$instance['read_more'] = strip_tags( $new_instance['read_more'] );
    
    return $instance;
}

function widget($args, $instance) {
            //if (function_exists("wp_recent_post_popularity_list")) {
            $title = apply_filters('widget_title', $instance['title']);
            $post_count= apply_filters('widget_title', $instance['post_count']);
            echo '<div id="recent-posts">';
            if ( $title ){
                echo '<h3 class="widget-title">'.$title.'</h3>';
            }
	//Display the name
                    $args = 
                        array(
                            "posts_per_page" => $post_count,
                            "post_type" => "post",
                            "post_status" => "publish",
                            "meta_key" => "mp_views",
                            "orderby" => "meta_value_num",
                            "order" => "DESC"
                           
                    );
                    global $post;
                    $list=new WP_Query($args);                    
                    if($list->have_posts()) {echo '<ul class="widget-list">';}
                        while ( $list->have_posts() ) : $list->the_post();
                            echo'<li class="widget-list-item">';                            
                                echo '<h4><a href="'.get_permalink($post->ID).'">'.the_title('', '', false).'</a></h4>';
                                if($instance['your_checkbox_var']){
                                    echo "<br>";
                                    display_featured_image();
                                }
                                echo '<div class="widget-right-list">';
                                    if($instance['your_checkbox_var1']){
                                        echo "<strong>Date:  </strong>";
                                        echo the_date('','','',TRUE);
                                    }
                                    if($instance['your_checkbox_var2']){
                                        echo "<br>";
                                        display_post_author_name();
                                    }
                                    if($instance['your_checkbox_var3']){
                                        echo "<br>";
                                        echo "<strong>Category:</strong>";
                                        echo "<br>";
                                        echo get_the_category_list();
                                    }
                                echo '</div>';
                                if($instance['your_checkbox_var4']){
                                    echo "<br>";
                                    echo coments_number();
                                }
                                if($instance['your_checkbox_var5']){
                                    echo "<br>";
                                    echo "<strong>Excerpt:</strong>";
                                    echo "<br>";
                                    the_excerpt();
                                }
                            echo "</li>";
                        endwhile;                   
                    echo '</div>';
                    
	}
    }

//add_action('widgets_init', create_function('', 'return register_widget("Recent_Posts");'));
?>


