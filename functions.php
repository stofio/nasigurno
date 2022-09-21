<?php
add_theme_support('menus');

add_theme_support( 'title-tag' );

show_admin_bar(false);

add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-logo' );

function remove_wordpress_version_number() {
    return '';
}

// Add Menu
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

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
 * Creates custom post type 
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
        'taxonomies' => array( '' ),
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-format-aside',
        'rewrite' =>  array( 'slug' => 'oglasi', 'with_front' => false )
    ));
}
add_action( 'init', 'create_oglasi' );


/**
 *
 * Creates custom taxonomy  
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
        'rewrite'           => array( 'slug' => 'oblast', 'hierarchical' => true )
    ));
};


//add custom user - Korisnik
add_action( 'admin_init', 'customUsers');
function customUsers() {
    add_role('korisnik',  __( 'Korisnik'  ));
}






