// Accordion
$(document).ready(function(){
    $('.accordion__header').click(function(event){
      if($('.accordion').hasClass('oneopen')){
          $('.accordion__body').not($(this).next()).slideUp(300);
      }
      
         $(this).next().slideToggle(300);
     
    });
  });

/* Modal Window */
document.addEventListener('DOMContentLoaded', function () {
   var modal = document.getElementById("myModal");
   var btn = document.getElementById("openModalBtn");
   var span = document.getElementsByClassName("modal-close")[0];
  
   btn.onclick = function() {
       modal.style.display = "block";
   }

   span.onclick = function() {
       modal.style.display = "none";
   }
});

 // Tabs
 document.addEventListener('DOMContentLoaded', function() {
  const tabButtons = document.querySelectorAll('.tabs__item');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach(button => {
      button.addEventListener('click', () => {
          const tab = button.getAttribute('data-tab');

          tabButtons.forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');

          tabContents.forEach(content => {
              if (content.id === tab) {
                  content.classList.add('active');
              } else {
                  content.classList.remove('active');
              }
          });
      });
  });
});

// Carousel
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.carousel-slide');
  const prevButton = document.querySelector('.carousel-button.prev');
  const nextButton = document.querySelector('.carousel-button.next');
  const indicators = document.querySelectorAll('.indicator');
  let currentSlide = 0;

  function showSlide(index) {
      slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === index);
          indicators[i].classList.toggle('active', i === index);
      });
      currentSlide = index;
  }

  function showNextSlide() {
      const nextSlide = (currentSlide + 1) % slides.length;
      showSlide(nextSlide);
  }

  function showPrevSlide() {
      const prevSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(prevSlide);
  }

  nextButton.addEventListener('click', showNextSlide);
  prevButton.addEventListener('click', showPrevSlide);

  indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => showSlide(index));
  });

  setInterval(showNextSlide, 5000); // Автоматическое переключение слайдов каждые 5 секунд
});
 