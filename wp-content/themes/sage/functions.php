<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

/**
 * Here's what's happening with these hooks:
 * 1. WordPress detects theme in themes/sage
 * 2. When we activate, we tell WordPress that the theme is actually in themes/sage/templates
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage
 *
 * We do this so that the Template Hierarchy will look in themes/sage/templates for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage
 *
 * themes/sage/index.php also contains some self-correcting code, just in case the template option gets reset
 */
add_filter('stylesheet', function ($stylesheet) {
    return dirname($stylesheet);
});
add_action('after_switch_theme', function () {
    $stylesheet = get_option('stylesheet');
    if (basename($stylesheet) !== 'templates') {
        update_option('stylesheet', $stylesheet . '/templates');
    }
});
add_action('customize_render_section', function ($section) {
    if ($section->type === 'themes') {
        $section->title = wp_get_theme(basename(__DIR__))->display('Name');
    }
}, 10, 2);

/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$sage_includes = [
    'src/helpers.php',
    'src/setup.php',
    'src/filters.php',
    'src/admin.php'
];
array_walk($sage_includes, function ($file) {
    if (!locate_template($file, true, true)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
    }
});


// ------------------------------
//=jquery
// ------------------------------

//管理画面以外であれば自身で指定したjQueryを読み込む
if(!is_admin()){
    function load_external_jQuery() {
        wp_deregister_script( 'jquery' ); //あらかじめ登録されているjQueryを登録解除する
        $url = 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'; //チェックするGoogle CNDのURL
        $test_url = @fopen($url,'r'); //Google CDNが利用可能かチェックする
        if( $test_url !== false ) {
            //Google CDNが利用可能であればGoogle Hosted LibrariesのjQueryを登録する
            wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), NULL , true);
        }else{
            //Google CDNが利用不可であればローカルのjQueryを登録する
            $local_url = get_template_directory_uri() . "/js/jquery-1.12.4.min.js";
            wp_register_script('jquery', $local_url, array(), NULL , true);
        }
        wp_enqueue_script('jquery'); //登録し直したjQueryを読み込む
    }
    add_action('wp_enqueue_scripts', 'load_external_jQuery');
}

// ------------------------------
//=jQuery-Validation-Engine
// ------------------------------

// jQuery-Validation-Engineの設置
function theme_name_scripts() {
 wp_enqueue_style( 'validationEngine.jquery.css', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css', array(), '1.0', 'all');
 wp_enqueue_script( 'jquery.validationEngine-ja.js', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-ja.min.js', array('jquery'), '2.0.0', true );
 wp_enqueue_script( 'jquery.validationEngine.js', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js', array('jquery'), '2.6.4', true );
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

// ------------------------------
//=login
// ------------------------------

// WordPressの管理画面ログインURLを変更する
define( 'LOGIN_CHANGE_PAGE', 'UJuuiMxJs.php' );
add_action( 'login_init', 'login_change_init' );
add_filter( 'site_url', 'login_change_site_url', 10, 4 );
add_filter( 'wp_redirect', 'login_change_wp_redirect', 10, 2 );
// 指定以外のログインURLは403エラーにする
if ( ! function_exists( 'login_change_init' ) ) {
  function login_change_init() {
    if ( !defined( 'LOGIN_CHANGE' ) || sha1( 'keyword' ) != LOGIN_CHANGE ) {
      status_header( 403 );
      exit;
    }
  }
}
// ログイン済みか新設のログインURLの場合はwp-login.phpを置き換える
if ( ! function_exists( 'login_change_site_url' ) ) {
  function login_change_site_url( $url, $path, $orig_scheme, $blog_id ) {
    if ( $path == 'wp-login.php' &&
      ( is_user_logged_in() || strpos( $_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE ) !== false ) )
      $url = str_replace( 'wp-login.php', LOGIN_CHANGE_PAGE, $url );
    return $url;
  }
}
// ログアウト時のリダイレクト先の設定
if ( ! function_exists( 'login_change_wp_redirect' ) ) {
  function login_change_wp_redirect( $location, $status ) {
    if ( strpos( $_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE ) !== false )
      $location = str_replace( 'wp-login.php', LOGIN_CHANGE_PAGE, $location );
    return $location;
  }
}

