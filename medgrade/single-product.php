<?php
include_once 'block-form.php';
include_once 'block-product_similar_list.php';
$name = get_field('name');

get_header();
?>
  <div id="page-product">
    <div class="container block">
      <div class="breadcrumbs">
        <?
        $product_type = get_the_terms(get_the_ID(), 'product_type')[0];
        $product_class = get_the_terms(get_the_ID(), 'product_class')[0];
        ?>
        <a href="/">Главная</a> / <a
          href="/<?= $product_type->taxonomy . '/' . $product_type->slug ?>"><?= $product_type->name ?></a>
      </div>
      <h2><?= $name ?></h2>
      <div class="product">
        <div class="first-column">
          <? if (get_field('images')): ?>
            <div class="main-photo">
              <? foreach (get_field('images') as $image): ?>
                <!--<div
                  style="background-image: url('<?= $image['url'] ?>')"
                  class="photo">
                </div>-->
                <a href="<?= $image['url'] ?>" data-lightbox="image-product" data-title="<?= $image['title'] ?>">
                  <div
                    style="background:transparent;"
                    class="photo">
                    <img src="<?= $image['url'] ?>" alt="image-<?= $image['ID'] ?>" style="max-width:395px">
                  </div>
                </a>
              <? endforeach; ?>
            </div>
            <div class="gallery">
              <? foreach (get_field('images') as $image): ?>
                <div style="background-image: url('<?= $image['sizes']['thumbnail'] ?>')"
                     class="photo">
                </div>
              <? endforeach; ?>
            </div>
          <? endif; ?>
          <div class="order">
            <div>Стоимость</div>
            <div class="open-form btn" product="<?= $name ?>">Узнать цену</div>
            <? if (get_field('addition_info')): ?>
              <div><? the_field('additional_info'); ?></div>
            <? endif; ?>
          </div>
          <div class="hide-mobile" style="display:none">
          <? if (get_field('caption_first_column')): ?>
            <div class="caption">
              <? the_field('caption_first_column') ?>
            </div>
          <? endif; ?>
        </div>

        <div class="features" style="margin:3em 0 2em 0;">
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Доставка по всей России</span>
            </div>
          </div>
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Выгодные лизинговые условия</span>
            </div>
          </div>
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Ввод в эксплуатацию и обучение персонала</span>
            </div>
          </div>
        </div>

        </div>
        <div class="second-column --info">
          <div class="info-icons">
            <div class="item">
              <div class="title"><?= $product_class->name ?></div>
              <div class="icon-box"><? new Icon('check', 'icon'); ?></div>
            </div>
            <div class="item">
              <div class="title">Гарантия</div>
              <div class="icon-box"><? new Icon('check', 'icon'); ?></div>
            </div>
            <div class="item">
              <div class="title">Под заказ</div>
              <div class="icon-box"><? new Icon('check', 'icon'); ?></div>
            </div>
            <p style="padding: text-align:justify;padding:1em;margin:1em 0;">
                Получите КП + бесплатную консультацию специалиста <i style="color:#00AE5D;">>></i>
              </p>
          </div>

        <div class="one-click-order-form-container -hidden">
          <form id="one-click-order-form" method="POST" action="">
            <h5 style="color: #00AE5D; font-size:1.4em;margin-bottom:0.4em;">Заказ в 1 клик</h5>
            <input type="text" id="one-click-order-input" name="one-click-order-input" placeholder="Введите номер телефона..." class="order-input"/>
            <button type="submit" class="btn" id="one-click-order-submit-btn" name="one-click-order-submit-btn">Получить КП</button>
            <div class="form-footer" style="margin: 1em 0;">
              <input type="checkbox" id="form-privacy" checked="">
              <label for="form-privacy" style="font-size:0.8em;">
                Согласен на обработку персональных данных в соответствии с <a href="/privacy" target="_blank" style="color: #00AE5D;">Политикой конфиденциальности</a>.
              </label>
            </div>
          </form>
        </div>

          <div class="tabs">
            <div class="tabs-nav">
              <ul>
                <?php $dataNum = 1; ?>
                <? if ( have_rows('tabs') ): ?>
                  <? while (have_rows('tabs')): the_row(); ?>
                      <li data-num="<?= $dataNum ?>"></li>
                      <?php $dataNum++; ?>
                  <? endwhile; ?>
                <? else: ?>
                  <li data-num="<?= $dataNum ?>"><?= the_title() ?></li>
                  <?php $dataNum++; ?>
                <? endif; ?>
                <?php if (have_rows('benefits')): the_row(); ?>
                  <li data-num="<?= $dataNum ?>">Фото</li>
                  <?php $dataNum++; ?>
                <? endif; ?>
              </ul>
            </div>
            <? if (have_rows('tabs')): ?>
                <? while (have_rows('tabs')): the_row(); ?>
                    <!-- begin tab -->
                    <div class="tab">
                        <div class="tab-content overflow-hidden">
                            <? the_sub_field('config') ?>
                        </div>
                        <button class="btn">(<span class="btn-count">0</span>) <span class="btn-text">Развернуть &#8595;</span></button>
                    </div>
                    <!-- end tab -->
                <? endwhile; ?>
            <? else: ?>
            <!-- begin tab -->
            <div class="tab">
                <div class="tab-content overflow-hidden">
                  <h5><?= the_title() ?></h5>
                  <? the_field('caption') ?>
                </div>
                <button class="btn">(<span class="btn-count">0</span>) <span class="btn-text">Развернуть &#8595;</span></button>
            </div>
            <!-- end tab -->
            <? endif; ?>
            <? if (have_rows('benefits')): ?>
                <!-- begin tab -->
                <div class="tab">
                    <div class="tab-content overflow-hidden">
                    <div class="benefits">
                        <h5>Фото</h5>
                        <? while (have_rows('benefits')): the_row(); ?>
                        <div class="card">
                            <a href="<? the_sub_field('image') ?>" data-lightbox="roadtrip" data-title="<? the_sub_field('text') ?>">
                              <div class="photo" style="background-image: url('<? the_sub_field('image') ?>')"></div>
                            </a>
                            <? the_sub_field('text') ?>
                        </div>
                        <? endwhile; ?>
                    </div>
                    </div>
                    <button class="btn">(<span class="btn-count">0</span>) <span class="btn-text">Развернуть &#8595;</span></button>
                </div>
                <!-- end tab -->
            <? endif; ?>
          </div> <!-- end tabs -->

        </div> <!-- end second-column -->

        <div class="show-mobile" style="display:none;">
          <? if (get_field('caption_first_column')): ?>
            <div class="caption">
              <? the_field('caption_first_column') ?>
            </div>
          <? endif; ?>
        </div>

        <div class="features" style="display:none;">
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Доставка по всей России</span>
            </div>
          </div>
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Выгодные лизинговые условия</span>
            </div>
          </div>
          <div class="item">
            <div class="content">
              <div class="icon"><? new Icon('clock'); ?></div>
              <span>Ввод в эксплуатацию и обучение персонала</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <? $video = get_field('video');
    $haveBenefits = have_rows('benefits');
    if ($video || $haveBenefits): ?>
      <div class="container block bottom" style="display:none;">
        <? if ($video): ?>
          <iframe class="video" width="560" height="315" src="<? the_field('video') ?>" frameborder="0"
                  allowfullscreen></iframe>
        <? endif; ?>
        <? if (!$haveBenefits): ?>
          <div class="benefits">
            <? while (have_rows('benefits')): the_row(); ?>
              <div class="card">
                <a href="<? the_sub_field('image') ?>" data-lightbox="roadtrip" data-title="<? the_sub_field('text') ?>">
                <div class="photo" style="background-image: url('<? the_sub_field('image') ?>')"></div>
                </a>
                <? the_sub_field('text') ?>
              </div>
            <? endwhile; ?>
          </div>
        <? endif; ?>
      </div>

      <div class="container block" style="padding:0;margin-top:-5em;">
        <!-- similar products -->
        <? $term = get_term_by('slug', 'show_in_homepage', 'product_options');
            $products = get_objects_in_term($term->term_id, 'product_options');
            if ($products): ?>
              <div class="container1 block1 list-block-product1" style="padding:1em;text-align:center;">
                <h4>Похожие товары</h4>
                <? new ProductSimilarList($products); ?>
              </div>
            <? endif; ?>
          <!-- /.similar products -->
      </div>

    <? endif; ?>
  </div>

<?php
new Form();

// отправка заявки в 1 клик
    $mail_to = 'info@medgrade.pro,mhause@mail.ru';
    $headers = array(
    	'From: medgrade.pro <info@medgrade.pro>',
        'Content-type: text/html; charset=utf-8',
    );

	global $post;
    $url = $_SERVER['REQUEST_URI'];

	if (isset($_POST['one-click-order-submit-btn'])) {

		$phone=$_POST['one-click-order-input'];
		$theme = 'Заказ в 1 клик - сайт medgrade.pro';
		$message='
		  <h3>Заказ в 1 клик:</h3>
          <div style="margin:15px 0;padding:20px;border:1px #f2f2f2 solid;">
          <h4>Телефон: '.$phone.'</h4>
		  <p>Аппарат: <b>'.$name.'</b></p>
          <p>URL: <b>'.$url.'</b></p>
          <p><a href="https://medgrade.pro'.$url.'">Перейти на страницу товара</a></p>
          </div>
          ';
		wp_mail($mail_to, $theme, $message, $headers);
		//echo '<script>location.replace("'."/thankyou".'");</script>';
	}

get_footer();
