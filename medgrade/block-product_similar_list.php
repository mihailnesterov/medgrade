<?
class ProductSimilarList
{
  public function __construct($products, $additional_class = '')
  {
    foreach ($products as $product):
      $images = get_field('images', $product);
      $image = $images ? $images[0]['sizes']['medium'] : '';
      $name = get_field('name', $product);
      $post = get_post($product);
      echo '
      <div style="display:inline-block;vertical-align:top;margin:0 auto;">
      <a href="/' . $post->post_type . '/' . $post->post_name . '" class="block-product ' . $additional_class . '" product_id="' . $product . '">
        <div
          class="img"
          style="background-image: url(' . $image .  ')"
          >
        </div>
        <h4 class="title">' . $name . '</h4>
      </a>
      </div>
    ';
    endforeach;
  }
}
