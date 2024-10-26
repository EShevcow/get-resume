<script type="text/javascript">
        function convertHTMLtoPDF() {
            const { jsPDF } = window.jspdf;
 
            let doc = new jsPDF('l', 'mm', [900, 1600]);
            let pdfjs = document.querySelector('main');
            let prof = document.querySelector('.profession').textContent;
            console.log(prof);
            doc.addFont("libs/fonts/arial.ttf", "Arial", "normal");
        
            doc.setFont("Arial");
            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save(prof + ".pdf");
                },
                x: 12,
                y: 12
            });                
        }            
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