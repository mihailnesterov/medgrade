$(document).ready(function () {
  var $page = $('#page-product-type');
  var $gettersTerms = $page.find('.getter_term');
  var $classesTerms = $page.find('.class_term');
  var $filtersLoadBtn = $page.find('.filters-load');
  var defLoadBtnLink = $filtersLoadBtn.attr('def_link');

  function updateLoadBtnLink() {
    var getters = [];
    var classes = [];
    $gettersTerms.each(function(index, item) {
      if (item.checked) {
        getters.push(item.value);
      }
    });
    $classesTerms.each(function(index, item) {
      if (item.checked) {
        classes.push(item.value);
      }
    });
    var getQuery = '';
    if (getters.length > 0) {
      getQuery += '?getters=' + getters.join(',');
    }
    if (classes.length > 0) {
      getQuery += (getQuery === '' ? '?' : '&') + 'classes=' + classes.join(',')
    }
    $filtersLoadBtn.attr('href', defLoadBtnLink + getQuery);
  }

  updateLoadBtnLink();

  $gettersTerms.add($classesTerms).on('change', function() {
    updateLoadBtnLink();
  });
});
