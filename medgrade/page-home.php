<?php
include_once 'block-product_list.php';
get_header();
?>

  <div id="page-home">
  <?php get_search_form(); ?>
  
<? if (have_rows('banners')): ?>
  <div class="banners-box container block banners-box-desktop"><?php // css banners-box-desktop ?>
  <div class="banners banners-desktop">
  <? while (have_rows('banners')): the_row(); ?>
    <div class="img" style="background-image: url('<? the_sub_field('image') ?>')">
      <? $btn_link = get_sub_field('btn_link'); if (get_sub_field('has_btn') && get_sub_field('btn_text') && $post): ?>
        <a href="/<?= $btn_link->post_type ?>/<?= $btn_link->post_name ?>" class="open-form btn sm"><? the_sub_field('btn_text') ?></a>
       
      <? endif; ?>
    </div>
    <? endwhile; ?>
    </div>
    <? new Icon('arrow-left', 'slick-prev'); ?>
    <? new Icon('arrow-right', 'slick-next'); ?>
    </div>
    <?
  endif; ?>

  <?php // banners-box-mobile ?>
  <div class="banners-box container block banners-box-mobile">
    <div class="banners banners-mobile">
      <div class="img">
        <img src="/wp-content/uploads/2019/09/action-dc-8-mobile.jpg" alt="mindray dc-8">
          <a href="/product/mindray-dc-8" class="open-form btn sm">Получить КП</a>
      </div>
      <div class="img">
        <img src="/wp-content/uploads/2019/08/mob_slider1.jpg" alt="mindray resona">
          <a href="/product/mindray-resona-7" class="open-form btn sm">Получить КП</a>
      </div>
      <div class="img">
        <img src="/wp-content/uploads/2019/08/mob_slider2.jpg" alt="aohua">
          <a href="/product/endoskopiya-aohua-vme-2800" class="open-form btn sm">Получить КП</a>
      </div>
      <div class="img">
        <img src="/wp-content/uploads/2019/08/mob_slider3.jpg" alt="titan 2000">
          <a href="/product/rentgeny-gemss-titan-2000" class="open-form btn sm">Получить КП</a>
      </div>
      <div class="img">
        <img src="/wp-content/uploads/2019/08/mob_slider4.jpg" alt="mega medical net 3000a">
          <a href="/product/lor-mega-medical-net-3000a" class="open-form btn sm">Получить КП</a>
      </div>
    </div>
  </div>
  <?php // end banners-box-mobile ?>

    <? if (have_rows('features')): ?>
      <div class="features container block">

        <? while (have_rows('features')) : the_row(); ?>
          <div class="feature">
            <a href= https://medgrade.pro/lizing/ >
            <h2 class="h3 title"><? the_sub_field('title') ?></h2>
            <div class="caption"><? the_sub_field('caption') ?> </a></div>
            <a href="https://medgrade.pro/lizing/" class="btn sm">Подробнее...</a>
            <? new Icon(get_sub_field('icon'), 'icon'); ?>
          </div>
        <? endwhile; ?>
      </div>
    <? endif; ?>

    <? $term = get_term_by('slug', 'show_in_homepage', 'product_options');
    $products = get_objects_in_term($term->term_id, 'product_options');
    if ($products): ?>
      <div class="container block list-block-product">
        <? new ProductList($products); ?>
      </div>
    <? endif; ?>

    <!--
    <div id="clients" class="block">
      <div class="container">
        <h2 class="block-title">Нашими клиентами являются такие сети медицинских центров как:</h2>
        <div class="box">
          <div class="client">
            <div class="img"
                 style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/clients/invitro.png"></div>
          </div>
          <div class="client">
            <div class="img"
                 style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/clients/hemotest.png"></div>
          </div>
          <div class="client">
            <div class="img"
                 style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/clients/helix.png"></div>
          </div>
          <div class="client">
            <div class="img"
                 style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/clients/smclinika.png"></div>
          </div>
          <div class="client">
            <div class="img"
                 style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/clients/ava.png"></div>
          </div>
        </div>
      </div>
    </div>
    -->

    <? if (have_rows('stages')): ?>
      <div class="stages-box">
        <div class="stages block container">
          <? while (have_rows('stages')) : the_row(); ?>
            <div class="stage">
              <span><? the_sub_field('caption') ?></span>
            </div>
          <? endwhile; ?>
        </div>
      </div>
    <? endif; ?>

    <!--
    <div id="map" class="container block">
      <h2 class="block-title">Мы работаем по всей России</h2>
      <div id="map-img" style="background-image: url('<?= get_stylesheet_directory_uri() ?>/img/russia.png"></div>
    </div>
    -->

    <!--
    <div id="subscribe" class="block">
      <div id="subscribe-box" class="container">
        <div class="btn">Перейти в каталог</div>
        <div>
          <div id="subscribe-title">Подпишитесь на рассылку и узнайте о скидках первым!</div>
          <div id="subscribe-block">
            <input type="text" placeholder="Введите свой e-mail" class="input">
            <div class="btn-check"><? new Icon('check', 'icon'); ?></div>
          </div>
        </div>
      </div>
    </div>
    -->
    </div>

    <?php
    get_footer();
