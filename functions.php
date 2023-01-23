<?php

//supports
function theme_supports() {
    add_theme_support('menus');
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    show_admin_bar(false);
}
add_action( 'init', 'theme_supports' );


//scripts
function theme_scripts() {
    if(!is_admin()) {
        wp_enqueue_script('jquery3', 'https://code.jquery.com/jquery-3.6.1.min.js');
        //wp_enqueue_script('gen-scripts', get_template_directory_uri().'/js/scripts.js');
        wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');
    }
}
add_action( 'init', 'theme_scripts' );

//google api key
function my_acf_init() {    
    acf_update_setting('google_api_key', 'AIzaSyAQKBTixull1qUQZ9uJJ4fcmpdqI2hE8Aw');
}
add_action('acf/init', 'my_acf_init');

/**
 * function to remove initial brackets and number from categories and subcategories
 */
function removeCatBrackets($catName) {
    if($catName[0] == '[') {
        for($i=0; $i < strlen($catName); $i++) {
            if($catName[$i] == ']' ) {
                //remove from bracket to closed bracket
                $catName = substr($catName, $i + 1); 
                
                if($catName[0] == ' ') {
                    //remove space
                    $catName = substr($catName, 1);
                }
            }
        }
    }
    return $catName;
}

// Add Menu
function register_my_menus() {
    register_nav_menus(
        array(
            'pomoc' => 'Pomoc',
            'drzave' => 'Drzave',
            'profil' => 'Profil',
        )
    );
}
add_action( 'init', 'register_my_menus' );

// Add Sidebars
add_action( 'widgets_init', 'function_widgets_init' );
function function_widgets_init()
{
  register_sidebar( array (
    'name' => __( 'Sidebar Widget Area', 'textdomain' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
   ) );

 }

/*
 * svg support
*/
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
 * 
 * TAGS for Oglasi
 * 
 */
add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Tagovi', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Pretraži tag' ),
    'popular_items' => __( 'Popularni Tagovi' ),
    'all_items' => __( 'Svi Tagovi' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Izmeni Tag' ), 
    'update_item' => __( 'Izmeni Tag' ),
    'add_new_item' => __( 'Dodaj Tag' ),
    'new_item_name' => __( 'Novo Tag Ime' ),
    'separate_items_with_commas' => __( 'Odvoji tagove zarezom' ),
    'add_or_remove_items' => __( 'Dodaj ili ugloni tag' ),
    'choose_from_most_used' => __( 'Izaberi najkorišćenije tagove' ),
    'menu_name' => __( 'Tagovi' ),
  ); 

  register_taxonomy('oglasi_tagovi','oglasi',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'oglas-tag' ),
  ));
}



/**
 *
 * CPT oglasi
 *
 */
function create_oglasi() {
    register_post_type('oglasi', array(
        'labels' => array(
            'name'            => __( 'Oglasi', 'theme-domain' ),
            'singular_name'   => __( 'Oglas', 'theme-domain'  ),
            'add_new'         => __( 'Novi Oglas', 'theme-domain'  ),
            'add_new_item'    => __( 'Dodaj Oglas', 'theme-domain'  ),
            'edit'            => __( 'Izmeni', 'theme-domain'  ),
            'edit_item'       => __( 'Izmeni Oglas', 'theme-domain'  ),
            'new_item'        => __( 'Novi Oglas', 'theme-domain'  ),
            'all_items'       => __( 'Svi Oglasi', 'theme-domain'  ),
            'view'            => __( 'Vidi', 'theme-domain'  ),
            'view_item'       => __( 'Vidi Oglas', 'theme-domain'  ),
            'search_items'    => __( 'Traži Oglas', 'theme-domain'  ),
            'not_found'       => __( 'Oglas nije pronadjen', 'theme-domain'  ),
        ),
        'public' => true, // show in admin panel?
        'menu_position' => 2,
        'supports' => array( 'title', 'thumbnail'),
        'taxonomies' => array('oglasi_tagovi'),
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-location',
        'rewrite' =>  array( 'slug' => 'oglasi', 'with_front' => false )
    ));
}
add_action( 'init', 'create_oglasi' );


/**
 *
 * Taxonomy oglasi
 *
 */
add_action( 'init', 'create_oglasi_taxonomy', 0 );
function create_oglasi_taxonomy() {

    register_taxonomy( 'oblast', array( 'oglasi' ), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'                       => _x( 'Kategorije', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Kategorija', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Kategorije', 'text_domain' ),
            'all_items'                  => __( 'Sve Kategorije Oglasa', 'text_domain' ),
            'parent_item'                => __( 'Kategorije Oglasa Roditelj', 'text_domain' ),
            'parent_item_colon'          => __( 'Kategorije Oglasa Roditelj:', 'text_domain' ),
            'new_item_name'              => __( 'Nuova Kategorija', 'text_domain' ),
            'add_new_item'               => __( 'Dodaj Kategoriju', 'text_domain' ),
            'edit_item'                  => __( 'Izmeni Kategoriju', 'text_domain' ),
            'update_item'                => __( 'Ažuriraj Kategoriju', 'text_domain' ),
            'separate_items_with_commas' => __( 'Odvoji Zarezom', 'text_domain' ),
            'search_items'               => __( 'Traži kategoriju', 'text_domain' ),
            'add_or_remove_items'        => __( 'Dodaj ili Obriši Kategoriju', 'text_domain' ),
            'choose_from_most_used'      => __( 'Izaberi Najviše Korišćenu', 'text_domain' ),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'supports' => array( 'title', 'thumbnail'),
        'rewrite'           => array( 'slug' => 'oblast', 'hierarchical' => true )
    ));
};


/**
 *
 * CPT lokacije
 *
 */
function create_lokacije() {
    register_post_type('drzave', array(
        'labels' => array(
            'name'            => __( 'Drzave', 'theme-domain' ),
            'singular_name'   => __( 'Drzava', 'theme-domain'  ),
            'add_new'         => __( 'Nova Drzava', 'theme-domain'  ),
            'add_new_item'    => __( 'Dodaj Drzavu', 'theme-domain'  ),
            'edit'            => __( 'Izmeni', 'theme-domain'  ),
            'edit_item'       => __( 'Izmeni Drzavu', 'theme-domain'  ),
            'new_item'        => __( 'Nova Drzava', 'theme-domain'  ),
            'all_items'       => __( 'Sve Drzave', 'theme-domain'  ),
            'view'            => __( 'Vidi', 'theme-domain'  ),
            'view_item'       => __( 'Vidi Drzavu', 'theme-domain'  ),
            'search_items'    => __( 'Traži Drzavu', 'theme-domain'  ),
            'not_found'       => __( 'Drzava nije pronadjena', 'theme-domain'  ),
        ),
        'public' => true, // show in admin panel?
        'menu_position' => 2,
        'supports' => array( 'title', 'thumbnail'),
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-location-alt',
        'rewrite' =>  array( 'slug' => 'drzave', 'with_front' => false )
    ));
}
add_action( 'init', 'create_lokacije' );



//add custom user - Korisnik
add_action( 'admin_init', 'customUsers');
function customUsers() {
    add_role('korisnik',  __( 'Korisnik'  ));
}

add_action( 'init', 'removeAdminBarForKorisnik' );
function removeAdminBarForKorisnik() {
    $user = wp_get_current_user();
    if(in_array( 'Korisnik', (array) $user->roles )){
        show_admin_bar(false);
    }
}


// Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');


/**
 * on post save/update, update the locations table
 */
add_action( 'save_post_oglasi', 'update_locations_table', 10, 3 );

function update_locations_table( $post_ID, $post, $update ) {
  //error_log("Oglas updated: ");
  //error_log(print_r( $post, true ));

  //get new oglasi data
  $meta = get_post_meta($post_ID);

  $lat = unserialize($meta['mapa'][0])['lat'];
  $lng = unserialize($meta['mapa'][0])['lng'];
  $postname = $post->post_name;
  $drzava = $meta['drzava'][0];
  $grad = $meta['grad'][0];
  $address = $meta['adresa'][0];
  $postcode = $meta['postanski_broj'][0];
  $latlng = "POINT( $lat $lng )";
  
  global $wpdb;
    $results = $wpdb->get_results( "INSERT INTO wp_nasigurno_lokacije (`post_id`, `post_name`, `drzava`, `grad`, `address`, `postcode`, `center_point`) 
        VALUES ($post_ID, '$postname', '$drzava', '$grad', '$address', '$postcode', ST_GeomFromText('POINT($lat $lng)') )" );

   // error_log(print_r( $results, true ));
}

/**
 * fix for pagination 404 error for category
 */
function custom_pre_get_posts( $query ) {  
    if( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {  
        $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) );  }  } 
    
    add_action('pre_get_posts','custom_pre_get_posts'); 
    
    function custom_request($query_string ) { 
         if( isset( $query_string['page'] ) ) { 
             if( ''!=$query_string['page'] ) { 
                 if( isset( $query_string['name'] ) ) { unset( $query_string['name'] ); } } } return $query_string; } 
    
    add_filter('request', 'custom_request');