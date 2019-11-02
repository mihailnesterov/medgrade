  </div>
  <footer id="footer">
    <div id="footer-box" class="container">
      <div>
        <div class="footer-title">Каталог</div>
        <? $product_types = get_terms('product_type', array(hide_empty => false));
        if ($product_types): foreach($product_types as $type): ?>
        <a href="/<?= $type->taxonomy . '/' . $type->slug ?>" class="footer-link"><?= $type->name ?></a>
        <? endforeach; endif; ?>
      </div>
      <div>
        <div class="footer-title">Быстрые ссылки</div>
        <? if(have_rows('hot_links', 'option')): while (have_rows('hot_links', 'option')): the_row(); ?>
        <a href="<? the_sub_field('link')?>" class="footer-link"><? the_sub_field('text') ?></a>
        <? endwhile; endif; ?>
        <a href="<?= get_template_directory_uri() ?>/sout/vedomost.pdf" class="footer-link" target="_blank">СОУТ ведомость</a>
        <a href="<?= get_template_directory_uri() ?>/sout/perechen.pdf" class="footer-link" target="_blank">СОУТ перечень рекомендаций</a>
      </div>
      <div>
        <? the_field('company_info1', 'option'); ?>
      </div>
      <div>
        <? the_field('company_info2', 'option'); ?>
      </div>
    </div>
  </footer>
</div>
<div id="toTop">&uarr;</div>
<?php wp_footer(); ?>
</body>
</html>
