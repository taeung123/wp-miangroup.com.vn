<?php
class featured_post extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'featured_post',
            'Bài nổi bật',
            array( 'description'  =>  'Widget hiển thị bài viết nổi bật' )
        );
    }
 
    function form( $instance ) {
 
        $default = array(
            'title' => 'Tiêu đề widget',
            'post_number' => 5
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $post_number = esc_attr($instance['post_number']);
 
        echo '<p>Số lượng bài viết hiển thị <input type="number" class="widefat" name="'.$this->get_field_name('post_number').'" value="'.$post_number.'" placeholder="'.$post_number.'" max="30" /></p>';
 
    }
 
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_number'] = strip_tags($new_instance['post_number']);
        return $instance;
    }
 
    function widget( $args, $instance ) {
        extract($args);
        $title = qtranxf_getLanguage() == 'vi' ? 'TIN TỨC NỔI BẬT' : 'FEATURED NEWS';
        $post_number = $instance['post_number'];
        $args = array(
            'posts_per_page' => $post_number,
            'post_type' => 'news',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => [
                'key' => 'featured_post',
                'value' => 'yes',
                'compare' => '='
            ]
        );

        $wp_query = new WP_Query($args);
        echo $before_widget;
        echo $before_title.$title.$after_title;
        if ($wp_query->have_posts()){ 
            ?>
                <div class="cms-recent-post">
                    <div class="cms-recent-post-wrapper">

                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                        <div class="widget-recent-item clearfix">

                            <?php
                            $thumbnail = get_field('thumbnail', get_the_ID());
                           
                            ?>
                                <div class="entry-thumbnail"> 
                                    <a href="<?php the_permalink(); ?>" class="img"> 
                                        <img src="<?php echo $thumbnail['url']; ?> " alt="">
                                    </a> 
                                </div>                              
                                <div class="entry-main">
                                    <div class="title-recent"><a class="entry-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>  
                                    <span class="date"><img src="/wp-content/themes/mian/images/calendar.png" alt=""><span><?php echo get_the_date('d/m/Y');?></span></span>
                                  
                                </div>
                        </div> 
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php 
             //wp_reset_postdata(); 
        } else { ?>
            <span class="notfound"><?php esc_html_e('No post found!', 'aduma'); ?></span>
        <?php
        }
        echo wp_kses_post($after_widget);
        wp_reset_postdata();
        
    }
 
}
 
add_action( 'widgets_init', 'create_featured_post_widget' );
function create_featured_post_widget() {
    register_widget('featured_post');
}
?>