<?

class Product
{
  public function __construct($name, $link, $image, $additional_class = '')
  {
    echo '
      <a href="' . $link . '" class="block-product ' . $additional_class . '">
        <div
          class="img"
          style="background-image: url(' . $image . ')"
          >
        </div>
        <h4 class="title">' . $name . '</h4>
        <div class="sale">Скидка <span class="percents">до 57%</span></div>
        <div class="btns">
          <div class="btn sm bg">Узнать больше</div>
          <div class="btn sm">Получить КП</div>
        </div>
      </a>
    ';
  }
}
