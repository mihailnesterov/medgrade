<?php
include_once 'block-icon.php';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PGQBX3R');</script>
<!-- End Google Tag Manager -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <meta name="google-site-verification" content="CttPHqjicqiU6jJ5pl27ycufcAAmMX1dFFANUreFNpc" />
  <meta name="yandex-verification" content="2ee94d05534d97e1" />

  <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '788372834951871');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=788372834951871&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGQBX3R"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
  var itemid = <?= the_ID() ?>;
  console.log(itemid);
  var dataLayer = window.dataLayer || [];
  dataLayer.push({
  'dynx_itemid': itemid
});
</script>

<div id="page">
  <header id="header">
    <div class="top-line-box">
      <div class="top-line container">
        <div class="contacts">
          <a class="email" href="mailto:<? the_field('email', 'option'); ?>">
            <? the_field('email', 'option'); ?>
          </a>
          <a class="phone" href="tel:<? the_field('contact_phone', 'option'); ?>">
            <? the_field('contact_phone_text', 'option'); ?>
          </a>
        </div>
        <!--
        <form class="search-form">
          <input type="text" placeholder="Поиск по сайту..." class="search-input"/>
          <label for="header-search" class="search-btn"><? new Icon('search', 'search-icon'); ?></label>
          <input type="submit" id="header-search"/>
        </form>
        -->
      </div>
    </div>
    <div class="menu container">
      <a href="/" class="logo">
        <img src="<?= get_stylesheet_directory_uri() ?>/img/logo.png">
      </a>
      <ul class="catalog">
        <? $product_types = get_terms('product_type', array(hide_empty => false));
        if ($product_types):
          foreach ($product_types as $type):
            $icon_id = $type->slug;
            switch ($type->slug) {
              case 'uzi':
                $icon_id = 'uzi';
                break;
              case 'tomography':
                $icon_id = 'tomografy';
                break;
              case 'rentgeny':
                $icon_id = 'rentgeny';
                break;
              case 'endoskopy':
                $icon_id = 'endoskopy';
                break;
              case 'reanimatsiya':
                $icon_id = 'reanimacia';
                break;
              case 'lor':
                $icon_id = 'lor';
                break;
              case 'hirurgiya':
                $icon_id = 'drugoe-oborudovanie';
                break;
            }
            ?>
            <li class="catalog-item">
              <a href="/<?= $type->taxonomy . '/' . $type->slug ?>">
                <? new Icon($icon_id, 'icon'); ?>
                <h3 class="h4 title"><?= $type->name ?></h3>
              </a>
            </li>
          <? endforeach; endif; ?>
      </ul>
    </div>
    <?php
    // код для генерации data/search.json - 
    // все что ниже раскомментировать и перейти на любую страницу
    
    /* $fp = fopen(TEMPLATEPATH."/data/search.json", "r+");
    ftruncate($fp, 0);
    fclose($fp);
    $keywords = require_once(TEMPLATEPATH.'/data/keywords.php');
    $posts = $wpdb->get_results("SELECT ID,post_title,guid FROM $wpdb->posts WHERE post_status='publish' AND post_type='product' ORDER BY post_title ASC");
    $res = array_merge($keywords,$posts);
    file_put_contents(TEMPLATEPATH.'/data/search.json',json_encode($res,JSON_UNESCAPED_UNICODE));
   */

    ?>

  </header>
