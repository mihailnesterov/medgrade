<?php
/**
 * medgrade functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medgrade
 */

if (!function_exists('medgrade_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function medgrade_setup()
  {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on medgrade, use a find and replace
     * to change 'medgrade' to the name of your theme in all the template files.
     */
    load_theme_textdomain('medgrade', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
      'menu-1' => esc_html__('Primary', 'medgrade'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('medgrade_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', array(
      'height' => 250,
      'width' => 250,
      'flex-width' => true,
      'flex-height' => true,
    ));
  }
endif;
add_action('after_setup_theme', 'medgrade_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medgrade_content_width()
{
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters('medgrade_content_width', 640);
}

add_action('after_setup_theme', 'medgrade_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medgrade_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html__('Sidebar', 'medgrade'),
    'id' => 'sidebar-1',
    'description' => esc_html__('Add widgets here.', 'medgrade'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
}

add_action('widgets_init', 'medgrade_widgets_init');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Подвал, шапка, общие данные',
    'menu_title' => 'Подвал, шапка, общие данные',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}

/**
 * Enqueue scripts and styles.
 */
function medgrade_scripts()
{
  wp_enqueue_style('medgrade-style', get_stylesheet_uri());
  wp_enqueue_script('medgrade-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
//  wp_enqueue_script('medgrade-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  // add mihail 02-09-2019
  wp_enqueue_style( 'lib-jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css', array(), '1.12.1', true );

  wp_enqueue_script('lib-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true);
  wp_enqueue_script('lib-slick', get_template_directory_uri() . '/js/libs/slick.js', array(), '1.0', true);
  wp_enqueue_script('lib-slicknav', get_template_directory_uri() . '/js/libs/jquery.slicknav.min.js', array(), '1.0', true);
  wp_enqueue_script('global', get_template_directory_uri() . '/js/global.js', array(), '1.0', true);
  wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array(), '1.0', true);
  wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home.js', array(), '1.0', true);
  wp_enqueue_script('page-product_type', get_template_directory_uri() . '/js/page-product_type.js', array(), '1.0', true);
  wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array(), '1.0', true);
  wp_enqueue_script('block-form', get_template_directory_uri() . '/js/block-form.js', array(), '1.3', true);
  wp_enqueue_script('lightbox-min', get_template_directory_uri() . '/js/lightbox.min.js', array(), '1.0', true);
  // add mihail 08-2019
  if (is_page( 2 )){
    wp_enqueue_script('fast-search', get_template_directory_uri() . '/js/fastsearch.js', array('lib-jquery'), '1.0', true);
  }
  wp_enqueue_script('lib-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('lib-jquery'), '1.12.1', true);
 
  wp_localize_script('global', 'global_params', array(
    'ajaxurl' => admin_url('admin-ajax.php')
  ));
}

add_action('wp_enqueue_scripts', 'medgrade_scripts');

function medgrade_send_form_data()
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $product = $_POST['product'];

  //

// add 16-11-2018

  $url = $_SERVER['REQUEST_URI'];

  define('CRM_HOST', 'medgrade.bitrix24.ru');
  define('CRM_PORT', '443');
  define('CRM_PATH', '/crm/configs/import/lead.php');
   
  define('CRM_LOGIN', 'nradykevich@gmail.com'); 
  define('CRM_PASSWORD', 'Natalia1');

   $postData = array(
    'TITLE' => 'Лид с сайта: '.$product,
    'NAME' => $name,
    'PHONE_WORK' => $phone,
    'EMAIL_WORK' => $email,
    'SOURCE_ID' => 'WEB',
    'COMMENTS' => $message,
    'SOURCE_DESCRIPTION' => $url

   );
 
   if (defined('CRM_AUTH'))
   {
    $postData['AUTH'] = CRM_AUTH;
   }
   else
   {
    $postData['LOGIN'] = CRM_LOGIN;
    $postData['PASSWORD'] = CRM_PASSWORD;
   }
 
   $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
   if ($fp)
   {
    $strPostData = '';
    foreach ($postData as $key => $value)
     $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);
 
    $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
    $str .= "Host: ".CRM_HOST."\r\n";
    $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $str .= "Content-Length: ".strlen($strPostData)."\r\n";
    $str .= "Connection: close\r\n\r\n";
 
    $str .= $strPostData;
 
    fwrite($fp, $str);
 
    $result = '';
    while (!feof($fp))
    {
     $result .= fgets($fp, 128);
    }
    fclose($fp);
 
    $response = explode("\r\n\r\n", $result);
 
    $output = '<pre>'.print_r($response[1], 1).'</pre>';
   }
   else
   {
    echo 'Connection Failed! '.$errstr.' ('.$errno.')';
   }

  // end add



  if (isset($name) || isset($company) || isset($email) || isset($phone) || isset($product)) {
    $head = 'From: ' . get_field('form_sender', 'option') . ' <' . get_field('form_email_sender', 'option') . '/>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $body = 'Имя: ' . $name . '<br>E-mail: ' . $email . '<br>Телефон: ' . $phone . '<br>Сообщение: ' . $message . '<br>Продукт: ' . $product;
    $result = mail(get_field('form_email_receiver', 'option'), "=?UTF-8?B?" . base64_encode('Заявка с сайта') . "?=", $body, $head);
    echo json_encode($result);

    die();
  }
  echo false;
  die();

  
}

add_action('wp_ajax_nopriv_medgrade_send_form_data', 'medgrade_send_form_data');
add_action('wp_ajax_medgrade_send_form_data', 'medgrade_send_form_data');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}

add_action('init', 'create_product_type', 0);
function create_product_type()
{
  // список параметров: http://wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy('product_type', 'product', array(
    'labels' => array(
      'name' => 'Категории',
      'singular_name' => 'Категория',
      'search_items' => 'Искать категории',
      'all_items' => 'Все категории',
      'view_item ' => 'Посмотреть категорию',
      'parent_item' => 'Родительская категория',
      'parent_item_colon' => 'Родительская категория:',
      'edit_item' => 'Редактировать категорию',
      'update_item' => 'Обновить категорию',
      'add_new_item' => 'Добавить новую категорию',
      'new_item_name' => 'Новое название категории',
      'menu_name' => 'Категории',
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => true,
  ));
}

add_action('init', 'create_product_class', 0);
function create_product_class()
{
  // список параметров: http://wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy('product_class', 'product', array(
    'labels' => array(
      'name' => 'Классы',
      'singular_name' => 'Класс',
      'search_items' => 'Искать классы',
      'all_items' => 'Все классы',
      'view_item ' => 'Посмотреть класс',
      'parent_item' => 'Родительский класс',
      'parent_item_colon' => 'Родительский класс:',
      'edit_item' => 'Редактирвоать класс',
      'update_item' => 'Обновить класс',
      'add_new_item' => 'Добавить новый класс',
      'new_item_name' => 'Новое название класса',
      'menu_name' => 'Классы',
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => true,
  ));
}

add_action('init', 'create_product_getter', 0);
function create_product_getter()
{
  // список параметров: http://wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy('product_getter', 'product', array(
    'labels' => array(
      'name' => 'Производители',
      'singular_name' => 'Производитель',
      'search_items' => 'Искать производителей',
      'all_items' => 'Все производители',
      'view_item ' => 'Посмотреть производителя',
      'parent_item' => 'Родительский производитель',
      'parent_item_colon' => 'Родительский производитель:',
      'edit_item' => 'Редактировать производителя',
      'update_item' => 'Обновить производителя',
      'add_new_item' => 'Добавить нового производителя',
      'new_item_name' => 'Новое название производителя',
      'menu_name' => 'Производители',
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => true,
  ));
}


add_action('init', 'create_product_options', 0);
function create_product_options()
{
  // список параметров: http://wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy('product_options', 'product', array(
    'labels' => array(
      'name' => 'Параметры',
      'singular_name' => 'Параметр',
      'search_items' => 'Искать параметры',
      'all_items' => 'Все параметры',
      'view_item ' => 'Посмотреть параметр',
      'parent_item' => 'Родительский параметр',
      'parent_item_colon' => 'Родительский параметр:',
      'edit_item' => 'Редактировать параметр',
      'update_item' => 'Обновить параметр',
      'add_new_item' => 'Добавить новый параметр',
      'new_item_name' => 'Новое название параметра',
      'menu_name' => 'Параметры',
    ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => true,
  ));
}

add_action('init', 'register_post_types');
function register_post_types()
{
  register_post_type('product', array(
    'label' => null,
    'labels' => array(
      'name' => 'Каталог оборудования', // основное название для типа записи
      'menu_name' => 'Каталог оборудования', // основное название для типа записи
      'all_items' => 'Всё оборудование', // основное название для типа записи
      'singular_name' => 'Оборудование', // название для одной записи этого типа
      'add_new' => 'Добавить оборудование', // для добавления новой записи
      'add_new_item' => 'Добавление оборудования', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактирование оборудования', // для редактирования типа записи
      'new_item' => 'Новое оборудование', // текст новой записи
      'view_item' => 'Смотреть оборудование', // для просмотра записи этого типа.
      'search_items' => 'Искать оборудование', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'parent_item_colon' => '', // для родителей (у древовидных типов)
    ),
    'description' => 'Каталог оборудования',
    'public' => true,
    'show_in_menu' => true, // показывать ли в меню адмнки
    'menu_position' => 4,
    'menu_icon' => 'dashicons-cart',
    'hierarchical' => false,
    'supports' => array('title', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => array('product_type', 'product_class', 'product_getter', 'product_options'),
    'has_archive' => false,
    'rewrite' => true,
    'query_var' => true,
  ));
}

