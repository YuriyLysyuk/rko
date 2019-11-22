/*
* onAppearanceAddClass
*
* Метод, который позволяет добавить и убрать класс для объекта, как только он покажется в зоне просмотра
* если горизонтальный размер ребенка больше размера родителя
* 
* Пример использования 
* $('.wrap').onAppearanceAddClass('class');
*
*/

jQuery.fn.extend({
  onAppearanceAddClass: function(class_to_add) {
    var $window = jQuery( window ),
        window_height = $window.height(),
        array_of_$elements = [],
        indent_bottom = $window.height() / 2, // отступ снизу экрана, при котором будет проявляться действие в центре экрана
        delay_toggle = 700; // Скорость анимации переключения класса
    this.each(function(i,el) {
      array_of_$elements.push(jQuery( el ));
    })
    scrollHandler();
    if (array_of_$elements.length) {
      $window.on('resize', resizeHandler).on('resize', scrollHandler).on('scroll', scrollHandler);
    }
    function resizeHandler() {
      window_height = $window.height();
    }
    function watchProcessedElements(array_of_indexes) {
      var l, i;
      for (l = array_of_indexes.length, i = l - 1; i > -1; --i) {
        array_of_$elements.splice(array_of_indexes[i], 1);
      }
      if (!array_of_$elements.length) {
        $window.off('resize', resizeHandler).off('scroll', scrollHandler).off('resize', scrollHandler);
      }
    }
    function scrollHandler() {
      var i, l, processed = [];
      for ( l = array_of_$elements.length, i = 0; i < l; ++i ) {
        // Берем первого ребенка
        var child = array_of_$elements[i].children(":first");
        // Сравниваем скрытую ширину ребенка с шириной родителя
        if (child[0].scrollWidth > array_of_$elements[i].width()) {
          if ($window.scrollTop() + window_height > array_of_$elements[i].offset().top + indent_bottom) {        
              array_of_$elements[i].addClass(class_to_add).delay(delay_toggle).queue(function(){jQuery(this).removeClass(class_to_add).dequeue();});;
              processed.push(i); 
          }
        }
      }
      if (processed.length) {
        watchProcessedElements(processed);
      }
    }
    return this;
  }
})