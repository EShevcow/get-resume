/* 1) Tooltips
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('a.right');
    var instances = M.Tooltip.init(elems);
  });
*/

// 2) Masked Input
$(function($){
	$('[name="phone"]').mask("+7(999) 999-9999");
}); 

// 3) Character Counter
$(document).ready(function() {
    $('#message').characterCounter();
  });

// 4) Resend
$(".resend").click(function(){
    $('.invite-form').toggle('slow');
    $('.invited').toggle('slow');
  });

// 5) Sidenav
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
});
 

// 6) Dropdown
$('.dropdown-trigger').dropdown();

// 7) Collapsible
$(document).ready(function(){
 $('.collapsible').collapsible();
}); 


/* 8) Plugin Owl Carousel
$(function() {
  $(".carousel").owlCarousel({
    loop: true,
    items: 1,
    margin: 250,
    stagePadding: 150,
    onTranslated: animateImgFunc,
    onChanged: animateImgClear,
});
//Add class with animate image item
function animateImgFunc() {
  $(".owl-carousel .active .inner-logo .item-icon").addClass("animated zoomInDown");
}
//remove class with animate image item 
function animateImgClear() {
  $(".owl-carousel .active .inner-logo .item-icon").removeClass("animated zoomInDown");
}
});

// 9) 
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.parallax');
  var instances = M.Parallax.init(elems);
});
*/

// 10) Navigate Page Scroll
$('a.nav-link').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top -50
      }, 1500);
      return false;
    }
  }
});

// 11) Materialboxed
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.materialboxed');
  var instances = M.Materialbox.init(elems);
});

// 12) Scrollspy
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.spy');
  var instances = M.ScrollSpy.init(elems);
});

setInterval(function(){
  let w = window.innerWidth;
  if(w < 560){
    $('.card-info .card').removeClass('horizontal');
  }
}, 500);