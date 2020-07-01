jQuery(function($){

  // FitVids
  $('.entry-content').fitVids();

  // Search Toggle
  $('.search-toggle').click(function(){
    $('.search-toggle, .header-search').toggleClass('active');
    if( $(this).hasClass('active') ) {
      $('.mobile-menu-toggle, .nav-primary').removeClass('active');
    }
    $('.header-search .search-field').focus();
  });

  // Mobile Menu
  $('.mobile-menu-toggle').click(function(){
    $('.mobile-menu-toggle, .nav-primary').toggleClass('active');
    if( $(this).hasClass('active') ) {
      $('.search-toggle, .header-search').removeClass('active');
    }
  });
  $('.menu-item-has-children > .submenu-expand').click(function(e){
    $(this).toggleClass('expanded');
    e.preventDefault();
  });

  // Conditional Logic
  /*
  $('#wpforms-6307-field_7').change(function(){
    if( 'Referral' === $(this).val() ) {
      $('#wpforms-6307-field_8-container').removeClass('wpforms-conditional-hide');
      $('#wpforms-6307-field_9-container').addClass('wpforms-conditional-hide');
    } else if( 'Other' === $(this).val() ) {
      $('#wpforms-6307-field_9-container').removeClass('wpforms-conditional-hide');
      $('#wpforms-6307-field_8-container').addClass('wpforms-conditional-hide');
    } else {
      $('#wpforms-6307-field_8-container').addClass('wpforms-conditional-hide');
      $('#wpforms-6307-field_9-container').addClass('wpforms-conditional-hide');

    }
  });
  */

  // Включаем анимацию переполненной таблицы
  $('.wp-block-table').onAppearanceAddClass('show-overflow');

  // Smooth scrolling anchor links
  function ea_scroll( hash ) {
    var target = $( hash );
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      var top_offset = 0;
      if ( $('.site-header').css('position') == 'fixed' ) {
        top_offset = $('.site-header').height();
      }
      if( $('body').hasClass('admin-bar') ) {
        top_offset = top_offset + $('#wpadminbar').height();
      }
       $('html,body').animate({
         scrollTop: target.offset().top - top_offset
      }, 1000);
      return false;
    }
  }
  // -- Smooth scroll on pageload
  if( window.location.hash ) {
    ea_scroll( window.location.hash );
  }
  // -- Smooth scroll on click
  $('a[href*="#"]:not([href="#"]):not(.no-scroll)').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
      ea_scroll( this.hash );
    }
  });

  //  Back To Top Button
  // var btn_to_top = $('.to-top-button');

  // $(window).scroll(function() {
  //   if ($(window).scrollTop() > 300) {
  //     btn_to_top.addClass('show');
  //   } else {
  //     btn_to_top.removeClass('show');
  //   }
  // });

});