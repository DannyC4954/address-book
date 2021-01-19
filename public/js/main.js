$(document).ready(function(){

  // Fixed navigation bar
  // $(window).on("scroll", function() {
  //   if($(window).scrollTop() > 50) {
  //       $(".nav").addClass("nav-scroll");
  //   } else {
  //       //remove the background property so it comes transparent again (defined in your css)
  //      $(".nav").removeClass("nav-scroll");
  //   }
  // });

  $( ".menu" ).click(function() {
    $( ".side-bar" )
      // .animate({ fontSize: "24px" }, 500 )
      .css('z-index', 1)
      .css('overflow-x', "hidden")
      .css('top', 0)
      .css('left', 0)
      .css('position', 'fixed')
      .css('display', 'block')
    $(".options").delay(1500).fadeIn();
  });

  $( ".close-icon" ).click(function() {
    $( ".side-bar" ).delay(200).fadeOut();
      // .animate({ width: "0%" }, 500 )
  });

  });
