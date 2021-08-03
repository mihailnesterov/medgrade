$(document).ready(function() {
  var $header = $('#header');
  var $menu = $header.find('.menu');
  var $searchInput = $header.find('.search-input');

  $menu.find('.catalog').slicknav({
    label: 'Каталог',
    parentTag: 'div',
    appendTo: $menu,
  });

  $header.find('.search-form').on('submit', function(e) {
    e.preventDefault();
    window.location.href = '/search?phrase=' + $searchInput.val();
  });
});
