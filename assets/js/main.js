;(function($){

$(document).ready(function(){

//========== HEADER ACTIVE STRATS ============= //
  var windowOn = $(window);
  windowOn.on('scroll', function () {
    var scroll = windowOn.scrollTop();
    if (scroll < 100) {
      $("#vl-header-sticky").removeClass("header-sticky");
    } else {
      $("#vl-header-sticky").addClass("header-sticky");
    }
  });
  
//========== HEADER ACTIVE ENDS ============= //

//========== MOBILE MENU STARTS ============= //
var vlMenuWrap = $('.vl-mobile-menu-active > ul').clone();
var vlSideMenu = $('.vl-offcanvas-menu nav');
vlSideMenu.append(vlMenuWrap);
if ($(vlSideMenu).find('.sub-menu, .vl-mega-menu').length != 0) {
  $(vlSideMenu).find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>');
}

var sideMenuList = $('.vl-offcanvas-menu nav > ul > li button.vl-menu-close, .vl-offcanvas-menu nav > ul li.has-dropdown > a');
$(sideMenuList).on('click', function (e) {
  console.log(e);
  e.preventDefault();
  if (!($(this).parent().hasClass('active'))) {
    $(this).parent().addClass('active');
    $(this).siblings('.sub-menu, .vl-mega-menu').slideDown();
  } else {
    $(this).siblings('.sub-menu, .vl-mega-menu').slideUp();
    $(this).parent().removeClass('active');
  }
});


$(".vl-offcanvas-toggle").on('click',function(){
$(".vl-offcanvas").addClass("vl-offcanvas-open");
$(".vl-offcanvas-overlay").addClass("vl-offcanvas-overlay-open");
});

$(".vl-offcanvas-close-toggle,.vl-offcanvas-overlay").on('click', function(){
$(".vl-offcanvas").removeClass("vl-offcanvas-open");
$(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
});

$(".vl-offcanvas-menu .sub-menu a").on("click", function () {
  $(".vl-offcanvas").removeClass("vl-offcanvas-open");
  $(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
});


//========== MOBILE MENU ENDS ============= //

//========== PAGE PROGRESS STARTS ============= // 
  var progressPath = document.querySelector(".progress-wrap path");
  var pathLength = progressPath.getTotalLength();
  progressPath.style.transition = progressPath.style.WebkitTransition =
  "none";
  progressPath.style.strokeDasharray = pathLength + " " + pathLength;
  progressPath.style.strokeDashoffset = pathLength;
  progressPath.getBoundingClientRect();
  progressPath.style.transition = progressPath.style.WebkitTransition =
    "stroke-dashoffset 10ms linear";
  var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength) / height;
    progressPath.style.strokeDashoffset = progress;
  };
  updateProgress();
  $(window).scroll(updateProgress);
  var offset = 50;
  var duration = 550;
  jQuery(window).on("scroll", function () {
    if (jQuery(this).scrollTop() > offset) {
      jQuery(".progress-wrap").addClass("active-progress");
    } else {
      jQuery(".progress-wrap").removeClass("active-progress");
    }
  });
  jQuery(".progress-wrap").on("click", function (event) {
    event.preventDefault();
    jQuery("html, body").animate({ scrollTop: 0 }, duration);
    return false;
  });
//========== PAGE PROGRESS STARTS ============= // 

//========== VIDEO POPUP STARTS ============= //
   if ($(".popup-youtube").length > 0) {
    $(".popup-youtube").magnificPopup({
    type: "iframe",
    });
    }
//========== VIDEO POPUP ENDS ============= //
AOS.init;
AOS.init({disable: 'mobile'});

//========== NICE SELECT ============= //
$('select').niceSelect();

}); 
//========== COUNTER UP============= //
const ucounter = $('.counter');
if (ucounter.length > 0) {
 ucounter.countUp();  
};

//========== CASE IMAGE ============= //
$('.cs_hover_active').hover(function () {
  $(this).addClass('active').siblings().removeClass('active');
  });

  $('.images-content-area').hover(function () {
    $(this).addClass('active').siblings().removeClass('active');
    });

//========== TESTIMONIAL AREA ============= //
// SLIDER //
$(".slider-brand-area").slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 0,
  speed: 7000,
  cssEase: "linear",
  pauseOnHover: true,
  slidesToShow:7,
  slidesToScroll:1,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});

// SLIDER //
$(".slider-brand-area2").slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 0,
  speed: 7000,
  cssEase: "linear",
  pauseOnHover: true,
  slidesToShow:5,
  slidesToScroll:1,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});

// SLIDER //
$(".slider-brand-area4").slick({
  arrows: false,
  autoplay: true,
  autoplaySpeed: 0,
  speed: 7000,
  cssEase: "linear",
  pauseOnHover: true,
  slidesToShow:3,
  slidesToScroll:1,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
// SLIDER //
$(".testimonail-widget-slider").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  dots: true,
  arrows: false,
  centerMode: false,
  focusOnSelect: true,
  loop: true,
  autoplay:true,
  autoplaySpeed:2000,
  infinite: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

// SLIDER //
$(".hero2-section-slider").slick({
  autoplay:true,
  autoplaySpeed:2000,
  speed:2000,
  slidesToShow:1,
  slidesToScroll:1,
  pauseOnHover:false,
  dots:true,
  arrows:false,
  cssEase:'linear',
  fade:true,
  draggable:true,
  infinite: true,
});

// SLIDER //
$(".testimonail-widget-slider2").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  dots: true,
  arrows: false,
  centerMode: true,
  focusOnSelect: true,
  loop: true,
  autoplay:true,
  autoplaySpeed:2000,
  infinite: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
      }
    }
  ]
});

// SLIDER //
$(".testimonial-dots-main").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  autoplay:true,
  dots:true,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  asNavFor: ".main-images-area",
  infinite: true,
});

$(".main-images-area").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: ".testimonial-dots-main",
  dots: false,
  arrows: true,
  centerMode: false,
  focusOnSelect: true,
  loop: true,
  autoplay:true,
  autoplaySpeed:2000,
  infinite: true,
  fade:true,
  prevArrow: $(".testimonial-prev-arrow"),
  nextArrow: $(".testimonial-next-arrow"), 
});

// SLIDER //
$(".testimonial-dots-main2").slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  arrows: false,
  autoplay:true,
  dots:true,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  infinite: true,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
      }
    }
  ]
});

// SLIDER //
$(".testimonial-dots-main5").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  autoplay:true,
  dots:false,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  infinite: true,
  prevArrow: $(".testimonial-prev-arrow5"),
  nextArrow: $(".testimonial-next-arrow5"), 
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
      }
    }
  ]
});

// SLIDER //
$(".testimonial-dots-main7").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  autoplay:true,
  dots:false,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  asNavFor: ".main-images-area7",
  infinite: true,
  prevArrow: $(".testimonial-prev-arrow"),
  nextArrow: $(".testimonial-next-arrow"), 
});

$(".main-images-area7").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: ".testimonial-dots-main7",
  dots: false,
  arrows: false,
  centerMode: false,
  focusOnSelect: true,
  loop: true,
  autoplay:true,
  autoplaySpeed:2000,
  infinite: true,
  fade:true,
});

// SLIDER //
$(".gallery-slider-area").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  autoplay:true,
  dots:false,
  centerMode: true,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  infinite: true,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
      }
    }
  ]
});

// SLIDER //
$(".gallery-slider-area3").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  autoplay:true,
  dots:true,
  centerMode: false,
  autoplaySpeed:2000,
  loop: true,
  focusOnSelect: true,
  vertical:false,
  infinite: true,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
      }
    }
  ]
});


// SLIDER //
$(".hero9-slider-area").slick({
  autoplay:true,
  autoplaySpeed:2000,
  speed:2000,
  slidesToShow:1,
  slidesToScroll:1,
  pauseOnHover:false,
  dots:false,
  arrows:true,
  cssEase:'linear',
  fade:true,
  draggable:true,
  infinite: true,
  prevArrow: $(".testimonial-prev-arrow-h9"),
  nextArrow: $(".testimonial-next-arrow-h9"), 
});
//========== PRELOADER ============= //
$(window).on("load", function (event) {
  setTimeout(function () {
    $(".preloader").fadeToggle();
  }, 200);
});
//========== GSAP AREA ============= //

function animateElements() {
  $('.progressbar').each(function () {
    var elementPos = $(this).offset().top;
    var topOfWindow = $(window).scrollTop();
    var percent = $(this).find('.circle').attr('data-percent');
    var percentage = parseInt(percent, 10) / parseInt(100, 10);
    var animate = $(this).data('animate');
    if (elementPos < topOfWindow + $(window).height() - 10 && !animate) {
      $(this).data('animate', true);
      $(this).find('.circle').circleProgress({
        startAngle: -Math.PI / 2,
        value: percent / 100,
        size: 80,
        thickness: 5,
        emptyFill: "#F6F8FA",
        fill: {
          color: '#00D348'
        }
      }).on('circle-animation-progress', function (event, progress, stepValue) {
        $(this).find('div').text((stepValue*100).toFixed() + "%");
      }).stop();
    }
  });
}

// Show animated elements
animateElements();
$(window).scroll(animateElements);

})(jQuery);