<?php
include_once 'block-product_list.php';

$getters = isset($_GET['getters']) ? explode(',', $_GET['getters']) : [];
$classes = isset($_GET['classes']) ? explode(',', $_GET['classes']) : [];

$term_id = get_queried_object_id();
$term_info = get_term($term_id);
$product_type = $term_info->slug;
$all_products = get_objects_in_term($term_id, 'product_type');
$filtered_products = load_posts($product_type, $getters, $classes);
$getter_terms = get_terms(array('taxonomy' => 'product_getter', 'object_ids' => $all_products));
$class_terms = get_terms(array('taxonomy' => 'product_class', 'object_ids' => $all_products));

function load_posts($product_type, $getters, $classes)
{
  $tax_query = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'product_type',
      'field' => 'slug',
      'terms' => array($product_type),
    ),
  );
  if (count($getters) > 0) {
    array_push($tax_query, array(
      'taxonomy' => 'product_getter',
      'field' => 'slug',
      'terms' => $getters,
    ));
  }
  if (count($classes) > 0) {
    array_push($tax_query, array(
      'taxonomy' => 'product_class',
      'field' => 'slug',
      'terms' => $classes,
    ));
  }

  $query = new WP_Query(array('tax_query' => $tax_query, 'posts_per_page' => 1000, 'fields' => 'ids'));
  return $query->posts;
}

get_header();
?>

  <div id="page-product-type">
    <div class="container block">
      <h2 class=""><?= get_term($term_id)->name ?></h2>
      <div class="content">
        <? if ($getters_items || $class_terms): ?>
          <div class="filters">
            <? if ($getter_terms): ?>
              <h4 class="filters-name">Производители</h4>
              <? foreach ($getter_terms as $getter): $id = 'getter_' . $getter->term_id; ?>
                <div class="filters-checkbox">
                  <input type="checkbox" id="<?= $id ?>" class="getter_term" value="<?= $getter->slug ?>" <?= in_array($getter->slug, $getters) ? 'checked' : '' ?>/>
                  <label for="<?= $id ?>"><?= $getter->name ?></label>
                </div>
              <? endforeach; endif; ?>
            <? if ($class_terms): ?>
              <h4 class="filters-name">Классы</h4>
              <? foreach ($class_terms as $class): $id = 'class_' . $class->term_id; ?>
                <div class="filters-checkbox">
                  <input type="checkbox" id="<?= $id ?>" class="class_term" value="<?= $class->slug ?>" <?= in_array($class->slug, $classes) ? 'checked' : '' ?>/>
                  <label for="<?= $id ?>"><?= $class->name ?></label>
                </div>
              <? endforeach; endif; ?>
            <div class="filters-btns">
              <? $link = '/' . $term_info->taxonomy . '/' . $product_type ?>
              <a href="<?= $link ?>" def_link="<?= $link ?>" class="filters-load btn">Показать</a>
              <a href="<?= $link ?>" class="btn bg">Сбросить</a>
            </div>
          </div>
        <? endif; ?>
        <div class="list-block-product">
          <? if ($filtered_products):
            new ProductList($filtered_products);
          else: ?>
            Товаров не найдено
          <? endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php
get_footer();
