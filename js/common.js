jQuery(function(o){
	o(".search-toggle").click(function() {
    o("body").removeClass("mobile-menu-active").toggleClass("search-active"),
    o(".header-search .search-field").focus()
  }),
  o(".mobile-menu-toggle").click(function() {
    o("body").removeClass("search-active").toggleClass("mobile-menu-active")
  }),
  o(".menu-item-has-children").prepend('<span class="submenu-toggle">'),
  o(".menu-item-has-children > .submenu-toggle").click(function(e) {
    o(this).parent().toggleClass("submenu-active"),
    e.preventDefault()
  });
});
