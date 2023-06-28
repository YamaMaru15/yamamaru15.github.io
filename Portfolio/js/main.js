'use strict';

{
  // ハンバーガーメニュー
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

  $('.portfolio__pop--close-btn, .portfolio__popup--overlay').click(function() {
    $('.portfolio__popup--overlay, .portfolio__popup--content').fadeOut();
    $('.header').fadeIn();
  });

  // slider
  // $(document).ready(function(){
  //   $('#portfolio__slider-js').slick({
  //     arrows: true, // 前・次のボタンを表示する
  //     dots: true, // ドットナビゲーションを表示する
  //     appendDots: $('.portfolio__slider-dots'), // ドットナビゲーションの生成位置を変更
  //     speed: 1000, // スライドさせるスピード（ミリ秒）
  //     slidesToShow: 1, // 表示させるスライド数
  //     centerMode: true, // slidesToShowが奇数のとき、現在のスライドを中央に表示する
  //     variableWidth: true, // スライド幅の自動計算を無効化
  //   });
  // }); 

  // fadeUp Animation
function fadeUpAnime(){
  $('.fadeUp').each(function(){ //fadeUpTriggerというクラス名が
    var elemPos = $(this).offset().top-50;//要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight){
      $(this).addClass('fadeUpAnime');// 画面内に入ったらfadeUpというクラス名を追記
    }else{
      $(this).removeClass('fadeUpAnime');// 画面外に出たらfadeUpというクラス名を外す
    }
  });
}

// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function (){
  fadeUpAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function(){
  fadeUpAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述



  // contactform
  // $(function() {
  //   // validate
  //   $("#contact").validate({
  //       // Set the validation rules
  //       rules: {
  //           name: "required",
  //           email: {
  //               required: true,
  //               email: true
  //           },
  //           message: "required",
  //       },
  //       // Specify the validation error messages
  //       messages: {
  //           name: "Please enter your name",
  //           email: "Please enter a valid email address",
  //           message: "Please enter a message",
  //       },
  //       // submit handler
  //       submitHandler: function(form) {
  //         //form.submit();
  //          $(".message").show();
  //          $(".message").fadeOut(4500);
  //       }
  //   });
  // });
}