(function ($) {
  "use strict";
  var $main_nav = $("#main-nav");
  var $toggle = $(".toggle");
  var defaultOptions = {
    disableAt: false,
    customToggle: $toggle,
    levelSpacing: 40,
    navTitle: "",
    levelTitles: true,
    levelTitleAsBack: true,
    pushContent: "#container",
    insertClose: 2,
  };
  var Nav = $main_nav.hcOffcanvasNav(defaultOptions);
  $(document).on("click", ".minus", function () {
    const $input = $(this).parent().find(".box");
    let count = parseInt($input.val(), 10) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.trigger("change");
    return false;
  });
  $(document).on("click", ".plus", function () {
    const $input = $(this).parent().find(".box");
    $input.val(parseInt($input.val(), 10) + 1);
    $input.trigger("change");
    return false;
  });
  $(".multipleitems").slick({
    infinite: true,
    slidesToShow: parseInt("3", 10),
    slidesToScroll: parseInt("1", 10),
    autoplay: true,
    arrows: false,
  });
  $(".desktop-story").slick({
    infinite: true,
    slidesToShow: parseInt("7", 10),
    slidesToScroll: parseInt("1", 10),
    autoplay: true,
    arrows: false,
  });
})(jQuery);


 // Shop Category
 $(window).on('load', function(){
    $('.shop-category').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow:"<i class='lni lni-chevron-left osahan-arrow osahan-left'></i>",
      nextArrow:"<i class='lni lni-chevron-right osahan-arrow osahan-right'></i>",
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 4.1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 3.1,
            slidesToScroll: 1
          }
        }
      ]
    });
    $('.shop-category').fadeIn();
    }); 