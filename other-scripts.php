<script type="text/javascript">
        function convertHTMLtoPDF() {
            const { jsPDF } = window.jspdf;
 
            let doc = new jsPDF('l', 'mm', [1550, 1300]);
            let pdfjs = document.querySelector('main');
            let prof = document.querySelector('.profession').textContent;
           
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            
            if(month < 10){
                month = '0' + month;
            }
            else if(day < 10){
                day = '0' + day;
            }

            let year = date.getFullYear();
            let res = "Резюме скачано - " + day + "." + month + "." + year;
            //print.innerHtml = res;
            let print = document.querySelector('.print-date').textContent = res;

            doc.addFont("libs/fonts/arial.ttf", "Arial", "normal");
            doc.addFont("libs/icofont/fonts/icofont.ttf", "IcoFont", "normal");
        
            doc.setFont("Arial");
            doc.setFont("IcoFont");
            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save(prof + ".pdf");
                },
                x: 12,
                y: 12
            });                
        } 

        setInterval(function(){
            let w = window.innerWidth;
            if(w < 560){
               $('.card-info .card').removeClass('horizontal');
               $('.footer-copyright .live-int').removeClass('right');
            }
            else{
               $('.card-info .card').addClass('horizontal');
               $('.footer-copyright .live-int').addClass('right');
            }
        }, 500);
         
        $(document).ready(function(){
            $('.toolp').tooltip();
        });
    </script>        
<!--Owl Carousel-->
<script src="libs/carousel/owl.carousel.min.js"></script>

<!-- Mask Input -->
<script src="libs/js/ajax_mail/jquery.maskedinput.js"></script> 
<!--Custom -->
<script src="libs/js/script.js"></script>
<!--Wow Js Lib -->
<script src="libs/js/wow/wow.js"></script>
<!--Execute Wow -->
<script>
  wow = new WOW(
  {
  boxClass: 'wow',     
  animateClass: 'animated', 
  offset: 10,         
  mobile: true,      
  live: true  
  }
  );
  wow.init();
</script>