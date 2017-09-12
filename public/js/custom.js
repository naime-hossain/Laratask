  $(document).ready(function() { // makes sure the whole site is loaded
         


      
        
          //preloader
          $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(350).css({'overflow':'visible'});


     

             //nicescroll
         $("html").niceScroll({
               cursorcolor:"#002c53"
        });
             //datepicker
 //            $(function () {
 //     $('#datepicker').datepicker({  
 //         minDate:new Date()
 //      });
 // });
             var clock;
               clock = $('.clock').FlipClock({
          clockFace: 'TwelveHourClock'
        });
        });   

