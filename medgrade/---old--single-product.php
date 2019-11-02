<?php
include_once 'block-form.php';
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
          <div class="hide-mobile">
          <? if (get_field('caption_first_column')): ?>
            <div class="caption">
              <? the_field('caption_first_column') ?>
            </div>
          <? endif; ?>
        </div>
        </div>
        <div class="info">
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
          </div>
          <? the_field('caption') ?>
        </div>
        
        <div class="show-mobile">
          <? if (get_field('caption_first_column')): ?>
            <div class="caption">
              <? the_field('caption_first_column') ?>
            </div>
          <? endif; ?>
        </div>

        <div class="features">
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
      <div class="container block bottom">
        <? if ($video): ?>
          <iframe class="video" width="560" height="315" src="<? the_field('video') ?>" frameborder="0"
                  allowfullscreen></iframe>
        <? endif; ?>
        <? if ($haveBenefits): ?>
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

    <? endif; ?>
  </div>

<?php
new Form();
get_footer();
