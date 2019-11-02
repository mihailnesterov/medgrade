<?php
include_once 'block-product_list.php';

$phrase = $_GET['phrase'];
$query = new WP_Query(array(
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
$filtered_products = $query->posts;

get_header();
?>

  <div id="page-search">
    <div class="container block">
      <h3 class="">Результаты поиска для: <?= $phrase ?></h3>
      <div class="list-block-product">
        <? if ($filtered_products):
          new ProductList($filtered_products);
        else: ?>
          Товаров не найдено
        <? endif; ?>
      </div>
    </div>
  </div>

<?php
get_footer();
