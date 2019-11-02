<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package medgrade
 */

include_once 'block-product_list.php';
wp_enqueue_script('fast-search', get_template_directory_uri() . '/js/fastsearch.js', array('lib-jquery'), '1.0', true);

$phrase = $_GET['s'];
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// for products count only!
$countQuery =  new WP_Query(array(
	'post_type' => 'product',
	'meta_query' => array(
	  array(
		'key' => 'name',
		'value' => $phrase,
		'compare' => 'LIKE'
	  )
	),
	'posts_per_page' => 1000,
	'fields' => 'ids',
  ));
// for paged prodacts
$query = new WP_Query(array(
  'post_type' => 'product',
  'meta_query' => array(
    array(
      'key' => 'name',
      'value' => $phrase,
      'compare' => 'LIKE'
    )
  ),
  'paged' => $paged,
  //'posts_per_page' => 1000,
  'fields' => 'ids',
));
$filtered_products = $query->posts;
get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php get_search_form(); // add search form 18.08.19 ?>
		
		<div id="page-search">
			<div class="container block">
			<? if ($filtered_products): ?>
			<h3 class="">Найдено товаров <b><?= count($countQuery->posts) ?></b> по запросу: <b><?= $phrase ?></b></h3>
			<? endif;?>
			
			<div class="list-block-product">
				<? if ($filtered_products): ?>
				<? new ProductList($filtered_products); ?>
				<div class="container block">
				<?
				// пагинация
				the_posts_pagination( array(
					'show_all'     => false, // показаны все страницы участвующие в пагинации
					'end_size'     => 5,     // количество страниц на концах
					'mid_size'     => 5,     // количество страниц вокруг текущей
					'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
					'prev_text'    => __('&larr;', 'textdomain'),
					'next_text'    => __('&rarr;', 'textdomain'),
					'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
					'add_fragment' => '',     // Текст который добавиться ко всем ссылкам в адресной строке.
					'screen_reader_text' => __( 'Страницы:' ),
				) );
				wp_reset_query(); // сброс $wp_query 
				?>
				</div>
				<? else: ?>
				Товаров не найдено
				<? endif; ?>
			</div>
			</div>
		</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
