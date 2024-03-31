'use strict';

{
  //hamburger menu
  $('#hamburger').on('click', function(){
      $('.header-list__title-humberger').toggleClass('humberger__close');
      $('.header-list__wrap-popup').slideToggle();
  });

  // popup title&text SET 
  $('.portfolio__col--yamamaru-img').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--yamamaru-content').fadeIn();
    $('.header').fadeOut();
  });

  $('.portfolio__col--typing-img').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--typing-content').fadeIn();
    $('.header').fadeOut();
  });

  $('.portfolio__col--memo-img').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--memo-content').fadeIn();
    $('.header').fadeOut();
  });

  $('.portfolio__col--prefectures-img').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--prefectures-content').fadeIn();
    $('.header').fadeOut();
  });

  $('.portfolio__pop--close-btn, .portfolio__popup--overlay').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--content').fadeOut();
    $('.header').fadeIn();
  });

  // slide
  $('.portfolio__popup--button').click(function() {
    $('.portfolio__slide--overlay, .portfolio__slide--prefectures-content').fadeIn();
  });

  $('.portfolio__slide--overlay').click(function() {
    $('.portfolio__slide--overlay, .portfolio__slide--prefectures-content').fadeOut();
  });

  $('.slide-items__wrap').slick({
    dots: true,
  });
  
  // fadeUp Animation
  function fadeUpAnime(){
    $('.fadeUp').each(function() {
      var elemPos = $(this).offset().top-50;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll >= elemPos - windowHeight){
        $(this).addClass('fadeUpAnime');
      }else{
        $(this).removeClass('fadeUpAnime');
      }
    });
  }

  $(window).scroll(function (){
    fadeUpAnime()
  });

  $(window).on('load', function(){
    fadeUpAnime();
  });
}