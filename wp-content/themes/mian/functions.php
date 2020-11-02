<?php
load_theme_textdomain('mian', get_template_directory() . '/languages');
if (!function_exists('nf_setup')) {
    function nf_setup()
    {

        add_theme_support("title-tag");

        // Adds custom header
        add_theme_support('custom-header');

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support('post-thumbnails');
    }
    if (function_exists('add_action')) {
        add_action('after_setup_theme', 'nf_setup');
    }
}

function cus_admin_menu()
{
    /*remove_menu_page( 'index.php' );                  /*Dashboard*/
    /*remove_menu_page( 'jetpack' );                    /*Jetpack*/
    /*remove_menu_page( 'edit.php' );                   /*Posts*/
    /*remove_menu_page( 'upload.php' );*/                 /*Media*/
    /*remove_menu_page( 'edit.php?post_type=page' );*/    /*Pages*/
    remove_menu_page('edit-comments.php');         /*Comments*/
    /*remove_menu_page( 'themes.php' );*/                 /*Appearance*/
    /*remove_menu_page( 'plugins.php' );                /*Plugins*/
    /*remove_menu_page( 'users.php' );*/                  /*Users*/
    /*remove_menu_page( 'tools.php' );*/                  /*Tools*/
    /*remove_menu_page( 'options-general.php' );        /*Settings*/
    remove_filter('update_footer', 'core_update_footer');
}
//add_action( 'admin_menu', 'cus_admin_menu' );
//remove_action('wp_head', 'wp_generator');
//remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
//remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
//remove_action( 'wp_print_styles', 'print_emoji_styles' );
//remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
function my_function_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', 'my_function_admin_bar');
//add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
/*FOOTER ADMIN - EDIT - START */
function wpse_edit_footer()
{
    add_filter('admin_footer_text', 'wpse_edit_text', 11);
}
function wpse_edit_text($content)
{
    return "MIAN GROUP";
}
//add_action( 'admin_init', 'wpse_edit_footer' );
/*FOOTER ADMIN - EDIT - END */
function remove_jquery_migrate(&$scripts)
{
    if (!is_admin()) {
        $scripts->remove('jquery');
    }
}
register_nav_menus(array(
    'primary' => __('Primary Menu',  'mian'),
));
function get_the_content_with_formatting()
{
    $content = get_the_content();
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function onlyLocale()
{
    $tmLg = get_locale();
    $tmpAry = explode("_", $tmLg);
    return $tmpAry[0];
}
function getTextLocale($strText)
{

    $tmpStrText = $strText;
    $tmLg = get_locale();
    $tmpAry = explode("_", $tmLg);
    $strLang = $tmpAry[0];

    $strText = between("[" . $strLang . "]", "[/" . $strLang . "]", $strText);

    if (empty($strText)) $strText = $tmpStrText;
    return $strText;
}
function after($valthis, $inthat)
{
    if (!is_bool(strpos($inthat, $valthis)))
        return substr($inthat, strpos($inthat, $valthis) + strlen($valthis));
}
function after_last($valthis, $inthat)
{
    if (!is_bool(strrevpos($inthat, $valthis)))
        return substr($inthat, strrevpos($inthat, $valthis) + strlen($valthis));
}
function before($valthis, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $valthis));
}
function before_last($valthis, $inthat)
{
    return substr($inthat, 0, strrevpos($inthat, $valthis));
}
function between($valthis, $that, $inthat)
{
    return before($that, after($valthis, $inthat));
}
function between_last($valthis, $that, $inthat)
{
    return after_last($valthis, before_last($that, $inthat));
}
function strrevpos($instr, $needle)
{
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};
add_action("login_head", "my_login_head");
function my_login_head()
{
    echo "
    <style>
    body.login #login h1 a {
        background: url('" . get_template_directory_uri() . "/logoadmin.png') no-repeat scroll center top transparent;
        height: 108px;
        width: 384px;
        background-size:contain;
    }
    </style>
    ";
}
function loginpage_custom_link()
{
    return get_home_url();
}
add_filter('login_headerurl', 'loginpage_custom_link');
function my_head()
{
    echo "
<style >
.ab-sub-wrapper{display: none}
#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
    content: url(" . get_template_directory_uri() . "/icon-csm.png);
}
#wpadminbar #wp-admin-bar-wp-logo.menupop  .ab-sub-wrapper  {display: none !important}
#adminmenu .wp-menu-image img {
     padding: 0; 
}
#adminmenu div.wp-menu-image {
    line-height: 34px;
}
.qtranxs-lang-switch-wrap:nth-of-type(2) {
    display: none !important;
}
body#tinymce.wp-editor {
font-family: Arial, Helvetica, sans-serif !important;
}
#menu-posts-tripadvisor {display: none}
</style>";
}
//add_action('admin_head', 'my_head', 11);

function sendcontact()
{
    get_template_part('template-parts/ajax/content', 'sendcontact');
    wp_die();
}
add_action('wp_ajax_sendcontact', 'sendcontact');
add_action('wp_ajax_nopriv_sendcontact', 'sendcontact');

function gotopro()
{
    get_template_part('template-parts/ajax/content', 'gotopro');
    wp_die();
}
add_action('wp_ajax_gotopro', 'gotopro');
add_action('wp_ajax_nopriv_gotopro', 'gotopro');

function getfashion()
{
    get_template_part('template-parts/ajax/content', 'getfashion');
    wp_die();
}
add_action('wp_ajax_getfashion', 'getfashion');
add_action('wp_ajax_nopriv_getfashion', 'getfashion');


function ajaxuploadfile()
{
    get_template_part('template-parts/ajax/content', 'ajaxuploadfile');
    wp_die();
}
add_action('wp_ajax_ajaxuploadfile', 'ajaxuploadfile');
add_action('wp_ajax_nopriv_ajaxuploadfile', 'ajaxuploadfile');

function sendccareer()
{
    get_template_part('template-parts/ajax/content', 'sendccareer');
    wp_die();
}
add_action('wp_ajax_sendccareer', 'sendccareer');
add_action('wp_ajax_nopriv_sendccareer', 'sendccareer');

function wpdocs_theme_add_editor_styles()
{
    add_editor_style('css/custom-editor-style.css');
}
add_action('admin_init', 'wpdocs_theme_add_editor_styles');


function myinit()
{
    register_post_type(
        'news',
        [
            'labels'      => [
                'name'          => __('News', 'mian'),
                'singular_name' => __('News'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add News'),
                'edit_item' => __('Edit News'),
                'new_item' => __('New  News'),
                'all_items' => __('News'),
                'view_item' => __('View News'),
                'search_items' => __('Search News'),
                'not_found' =>  __('No News found in Trash found'),
                'not_found_in_trash' => __('No News found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 'tin-tuc'],
        ]
    );

    register_post_type(
        'about_mian',
        [
            'labels'      => [
                'name'          => __('About Mian', 'mian'),
                'singular_name' => __('About Mian'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add About Mian'),
                'edit_item' => __('Edit About Mian'),
                'new_item' => __('New  About Mian'),
                'all_items' => __('About Mian'),
                'view_item' => __('View About Mian'),
                'search_items' => __('Search About Mian'),
                'not_found' =>  __('No About Mian found in Trash found'),
                'not_found_in_trash' => __('No About Mian found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 've-mian'],
        ]
    );
    register_post_type(
        'develope',
        [
            'labels'      => [
                'name'          => __('Phát triển bền vững', 'mian'),
                'singular_name' => __('Phát triển bền vững'),
                'add_new' => __('Thêm mới'),
                'add_new_item' => __('Thêm mới'),
                'edit_item' => __('Chỉnh sửa'),
                'new_item' => __('New Develope Mian'),
                'all_items' => __('Develope Mian'),
                'view_item' => __('View Develope Mian'),
                'search_items' => __('Search Develope Mian'),
                'not_found' =>  __('No Develope Mian found in Trash found'),
                'not_found_in_trash' => __('No Develope Mian found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 'phat-trien'],
            'show_in_rest' => true
        ]
    );
    register_post_type(
        'newsletter',
        [
            'labels'      => [
                'name'          => __('Bản Tin CĐ', 'mian'),
                'singular_name' => __('Bản Tin CĐ'),
                'add_new' => __('Add Bản Tin CĐ'),
                'add_new_item' => __('Add Bản Tin CĐ'),
                'edit_item' => __('Edit Bản Tin CĐ'),
                'new_item' => __('New  Bản Tin CĐ'),
                'all_items' => __('Bản Tin CĐ'),
                'view_item' => __('View Bản Tin CĐ'),
                'search_items' => __('Search Bản Tin CĐ'),
                'not_found' =>  __('No Bản Tin CĐ found in Trash found'),
                'not_found_in_trash' => __('No Bản Tin CĐ found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 'ban-tin-co-dong'],
        ]
    );

    register_post_type(
        'finacial',
        [
            'labels'      => [
                'name'          => __('Báo Cáo TC', 'mian'),
                'singular_name' => __('Báo Cáo TC'),
                'add_new' => __('Add Báo Cáo TC'),
                'add_new_item' => __('Add Báo Cáo TC'),
                'edit_item' => __('Edit Báo Cáo TC'),
                'new_item' => __('New  Báo Cáo TC'),
                'all_items' => __('Báo Cáo TC'),
                'view_item' => __('View Báo Cáo TC'),
                'search_items' => __('Search Báo Cáo TC'),
                'not_found' =>  __('No Báo Cáo TC found in Trash found'),
                'not_found_in_trash' => __('No Báo Cáo TC found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 'bao-cao-tai-chinh'],
        ]
    );

    register_post_type(
        'dhcdtn',
        [
            'labels'      => [
                'name'          => __('Đại Hội CĐTN', 'mian'),
                'singular_name' => __('Đại Hội CĐTN'),
                'add_new' => __('Add Đại Hội CĐTN'),
                'add_new_item' => __('Add Đại Hội CĐTN'),
                'edit_item' => __('Edit Đại Hội CĐTN'),
                'new_item' => __('New  Đại Hội CĐTN'),
                'all_items' => __('Đại Hội CĐTN'),
                'view_item' => __('View Đại Hội CĐTN'),
                'search_items' => __('Search Đại Hội CĐTN'),
                'not_found' =>  __('No Đại Hội CĐTN found in Trash found'),
                'not_found_in_trash' => __('No Đại Hội CĐTN found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-admin-site',
            'rewrite'     => ['slug' => 'dai-hoi-co-dong-thuong-nine'],
        ]
    );


    /*career*/
    $labels = array(
        'name'                       => __('Nơi làm việc'),
        'singular_name'              => __('Nơi làm việc'),
        'menu_name'                  => __('Nơi làm việc'),
        'all_items'                  => __('Nơi làm việc'),
        'parent_item'                => __('Parent Nơi làm việc'),
        'parent_item_colon'          => __('Parent Nơi làm việc:'),
        'new_item_name'              => __('New Nơi làm việc'),
        'add_new_item'               => __('Add Nơi làm việc'),
        'edit_item'                  => __('Edit Nơi làm việc'),
        'update_item'                => __('Update Nơi làm việc'),
        'view_item'                  => __('View Nơi làm việc'),
        'separate_items_with_commas' => __('Separate Nơi làm việc with commas'),
        'add_or_remove_items'        => __('Add or remove Nơi làm việc'),
        'choose_from_most_used'      => __('Choose from the most used'),
        'popular_items'              => __('Popular Nơi làm việc'),
        'search_items'               => __('Search Nơi làm việc'),
        'not_found'                  => __('Not Found'),
        'no_terms'                   => __('No Nơi làm việc'),
        'items_list'                 => __('Items list'),
        'items_list_navigation'      => __('Items list navigation'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('wlocation', array('career'), $args);

    register_post_type(
        'career',
        [
            'labels'      => [
                'name'          => __('Tuyển dụng'),
                'singular_name' => __('Tuyển dụng'),
                'add_new' => __('Thêm mới'),
                'add_new_item' => __('Thêm Tuyển dụng'),
                'edit_item' => __('Sử Tuyển dụng'),
                'new_item' => __('Thêm  Tuyển dụng'),
                'all_items' => __('Tuyển dụng'),
                'view_item' => __('Xem Tuyển dụng'),
                'search_items' => __('Tìm kiếm Tuyển dụng'),
                'not_found' =>  __('No Tuyển dụng found in Trash found'),
                'not_found_in_trash' => __('No Tuyển dụng found in Trash'),
            ],
            'public'      => true,
            'has_archive' => true,
            'supports' => ['title', 'editor'],
            'menu_icon'           => 'dashicons-feedback',
            'rewrite'     => ['slug' => 'tuyen-dung'],
        ]
    );
}

add_action('init', 'myinit');

function news_rename_labels($labels)
{
    # Labels
    $labels->name = 'SP & DV';
    $labels->singular_name = 'SP & DV';
    $labels->add_new = 'Thêm SP & DV';
    $labels->add_new_item = 'Thêm SP & DV';
    $labels->edit_item = 'Sửa SP & DV';
    $labels->new_item = 'Thêm SP & DV';
    $labels->view_item = 'Xem SP & DV';
    $labels->view_items = 'Xem SP & DV';
    $labels->search_items = 'Kìm kiếm SP & DV';
    $labels->not_found = 'No SP & DV found.';
    $labels->not_found_in_trash = 'No SP & DV found in Trash.';
    $labels->parent_item_colon = 'Parent SP & DV'; // Not for "post"
    $labels->archives = 'SP & DV Archives';
    $labels->attributes = 'SP & DV Attributes';
    $labels->insert_into_item = 'Thêm vào SP & DV';
    $labels->uploaded_to_this_item = 'Uploaded to this SP & DV';
    $labels->featured_image = 'Featured Image';
    $labels->set_featured_image = 'Set featured image';
    $labels->remove_featured_image = 'Remove featured image';
    $labels->use_featured_image = 'Use as featured image';
    $labels->filter_items_list = 'Filter SP & DV list';
    $labels->items_list_navigation = 'SP & DV list navigation';
    $labels->items_list = 'SP & DV list';

    # Menu
    $labels->menu_name = 'SP & DV';
    $labels->all_items = 'Tất Cả SP & DV';
    $labels->name_admin_bar = 'SP & DV';

    return $labels;
}

add_filter('post_type_labels_post', 'news_rename_labels');


add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy()
{
    global $typenow;
    $post_type = 'career';
    $taxonomies  = array('wlocation');
    if ($typenow == $post_type) {
        foreach ($taxonomies as  $taxonomy) {
            $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => __("Show All {$info_taxonomy->label}"),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => false,
                'hide_empty'      => false,
            ));
        }
    }
}

add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query)
{
    global $pagenow;
    $post_type = 'career';
    $taxonomies  = array('wlocation');
    foreach ($taxonomies as  $taxonomy) {
        $q_vars    = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }
}

function nf_search_form($form)
{
    $placeholder = qtranxf_getLanguage() == 'vi' ? 'Tìm kiếm...' : 'Searching...';
    $form = '<form method="get" action="' . esc_url(home_url('/')) . '" class="searchform search-form">
            <div class="form-group">
                <input type="text" value="' . get_search_query() . '" name="s" class="form-control" placeholder="' . $placeholder . '" id="modal-search-input">
            </div>
            <button type="submit" class="theme_button"><img src="/wp-content/themes/mian/images/search.png" /></button>
             ';
    $form .= '</form>';
    return $form;
}
if (function_exists('add_filter')) {
    add_filter('get_search_form', 'nf_search_form');
}

if (!function_exists('themeSidebars')) {
    /**
     * register sidebar for theme
     *
     * @return void
     */
    function themeSidebars()
    {
        $sidebars = [
            [
                'name'          => __('Main Sidebar', 'mian'),
                'id'            => 'main-sidebar',
                'description'   => __('Main Sidebar', 'mian'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ],

        ];
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name'          => sprintf(esc_html__('Footer Column %s', 'mian'), $i),
                'id'            => 'footer-sidebar-' . $i,
                'description'   => __('Footer Sidebar', 'mian'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ));
        }
        foreach ($sidebars as $sidebar) {
            register_sidebar($sidebar);
        }
    }

    add_action('widgets_init', 'themeSidebars');
}
/**
 * footer layout
 */
function nf_footer()
{

    $_class = "";
    $width = 'container';
?>
    <div id="footer-top" class="footer-top">
        <div class="<?php echo esc_attr($width); ?>">
            <div class="row">
                <?php
                
                $_class = 'col-lg-3 col-md-12 col-sm-12 col-xs-12 footer-wrap';
                $_class2 = 'col-lg-6 col-md-12 col-sm-12 col-xs-12 footer-wrap';
                for ($i = 1; $i <= 3; $i++) {
                    $f_class = $i == 2 ? $_class2 : $_class;
                    if (is_active_sidebar('footer-sidebar-' . $i)) {
                        echo '<div class="' . esc_html($f_class) . '">';
                        dynamic_sidebar('footer-sidebar-' . $i);
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div><!-- #footer-top -->

    <?php
}

/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 */
function nf_paging_nav($query = null)
{
    // Don't print empty markup if there's only one page.
    if ($query != null) {
        if ($query->max_num_pages < 2) {
            return;
        }
    } else {
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
    }
    if ($query != null) {
        $num_page = $query->max_num_pages;
    } else {
        $num_page = $GLOBALS['wp_query']->max_num_pages;
    }

    $paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args   = array();
    $url_parts    = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $first_page = $pagenum_link;
    $last_page = $pagenum_link . 'page/' . $num_page;
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base'     => $pagenum_link,
        'total'    => $num_page,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => '<span><img src="/wp-content/themes/mian/css/arrow-left.png" /></span>',
        'next_text' => '<span><img src="/wp-content/themes/mian/css/arrow-right.png" /></span>',
    ));
    if ($links) : ?>
        <nav class="navigation paging-navigation clearfix">
            <div class="pagination loop-pagination">
                <?php echo wp_kses_post($links); ?>
            </div><!-- .pagination -->
        </nav><!-- .navigation -->
    <?php
    endif;
}
function single_social_sharing()
{
    ?>
    <div class="social-sharing">
        <ul>
            <li class="title">
                <?php _e('[:vi]Chia sẻ: [:][:en]Share: [:]', 'mian'); ?>
            </li>
            <li><a class="share-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="/wp-content/themes/mian/images/fb_icon.png" alt=""></a></li>
            <li><a class="share-linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>"><img src="/wp-content/themes/mian/images/linkedin_icon.png" alt=""></a></li>
            <li><a class="share-google" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><img src="/wp-content/themes/mian/images/google_icon.png" alt=""></a></li>

        </ul>
    </div>
<?php

}
require(get_template_directory() . '/widgets/featured_post.php');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
    ));
}