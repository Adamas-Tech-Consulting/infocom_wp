jQuery (function($){
	
      $('.speaker-details[data-toggle="tooltip"]').tooltip({
          animated: 'fade',
          placement: 'bottom',
          html: true,
      });

    $('.banner-item').slick({
        dots: false,
        infinite: false,
        autoplay: false, /* this is the new line */
        autoplaySpeed: 5000,
        arrows:true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
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
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });


      $('.conference-slide').slick({
        dots: false,
        infinite: true,
        autoplay: false, /* this is the new line */
        autoplaySpeed: 5000,
        arrows:true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
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
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });


      $('.testi-item').slick({
        dots: false,
        infinite: true,
        autoplay: true, /* this is the new line */
        autoplaySpeed: 5000,
        arrows:true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
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
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });

      new WOW().init();


      var change_elementor_options = function() {
        if ( typeof elementorFrontend === 'undefined' ) {
          return;
        }
      
        elementorFrontend.on( 'components:init', function() {
          elementorFrontend.utils.anchors.setSettings( 'selectors.targets', '.dummy-selector' );
        } );
      };
      
      $( window ).on( 'elementor/frontend/init', change_elementor_options );




      // handle links with @href started with '#' only
     /* $(document).on('click', '.event-tab-section li a[href^="#"]', function(e) {
        // target element id
        //alert("hello");
        $(this).addClass("active").parent().siblings().children().removeClass("active");
        var id = $(this).attr('href');
        var $this = $(this);
        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }
        
        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();
        
        // top position relative to the document
        var pos = $id.offset().top - 140;
        
        // animated top scrolling
        $('body, html').animate({scrollTop: pos});
      }); */
	
	
	  // Cache selectors
var lastId,
 topMenu = $("#mainNav"),
 topMenuHeight = topMenu.outerHeight()+1,
 // All list items
 menuItems = topMenu.find("a"),
 // Anchors corresponding to menu items
 scrollItems = menuItems.map(function(){
   var item = $($(this).attr("href"));
    if (item.length) { return item; }
 });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  $('html, body').stop().animate({ 
      scrollTop: offsetTop
  }, 850);
  e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;
   
   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top - 140 < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href=\"#"+id+"\"]").parent().addClass("active");
   }                   
});


      $('.popup-youtube').magnificPopup({
        disableOn: 0,
       // delegate: '.popup-youtube',
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
      });

      $('.popup-with-form').magnificPopup({
        type: 'inline',
        //delegate: '.popup-with-form',
        preloader: false,
        
        callbacks: {
            open: function () {
                $(this.content).find('video')[0].play();

            },
            close: function () {
                // Call pause() here instead of load()
                $(this.content).find('video')[0].pause();
            } 
        }
      });


      var url = $(".videopanel").attr('src');
      $(".infocom-video").on('hide.bs.modal', function() {
        $(".videopanel").attr('src', '');
      });
      $(".infocom-video").on('show.bs.modal', function() {
        $(".videopanel").attr('src', url);
      });

      

      $(window).scroll(function() {    
          var scroll = $(window).scrollTop();
      
          //>=, not <=
          if (scroll >= 50) {
              //clearHeader, not clearheader - caps H
              $(".site-header").addClass("is-hidden");
              $('.back-to-top').addClass("d-block");
              $('.back-bttn').addClass("d-block");
          } else {
              $(".site-header").removeClass("is-hidden");
              $('.back-to-top').removeClass("d-block");
              $('.back-bttn').removeClass("d-block");
          }
      }); //missing );


      $("a[href='#top']").click(function() {
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
      });

      $('.cat-list').on('change', function() {
       // $('.cat-list_item').removeClass('active');
       // $(this).addClass('active');
       var event_id=$(this).val();
       var event_id_list="";
       var flag=1;
       if(event_id==0)
       {
        flag=0;
         $('.cat-list > option').each(function() {
           if($(this).val()!=0)
           {
               event_id_list=event_id_list+$(this).val()+',';
           }
         
         });
         
       }
       else
       {
        flag=1;
       }
      
        $.ajax({
          type: 'POST',
          url: ajaxurl,
          dataType: 'html',
          data: {
            action: 'filter_projects',
            event_id:event_id,event_id_list:event_id_list,flag:flag,
          },
          success: function(res) {//alert(res);
            $('.project-tiles').html(res);

            
            $('.popup-with-form').magnificPopup({
              type: 'inline',
              //delegate: '.popup-with-form',
              preloader: false,
              
              callbacks: {
                  open: function () {
                      $(this.content).find('video')[0].play();
      
                  },
                  close: function () {
                      // Call pause() here instead of load()
                      $(this.content).find('video')[0].pause();
                  } 
              }
            });

            $('.popup-youtube').magnificPopup({
              disableOn: 0,
              type: 'iframe',
              mainClass: 'mfp-fade',
              removalDelay: 160,
              preloader: false,
              fixedContentPos: false
            });

          }
        })
      });


      $('.session-type li').on('click',function(){
        var session_type=$(this).attr("data-type");
        $(this).addClass('active').siblings().removeClass('active');
        //alert(session_type); 
            $.ajax({
              type: 'POST',
              url: ajaxurl,
              dataType: 'html',
              data: {
                action: 'session_type',
                session_type:session_type,
              },
              success: function(res) {
                //alert(res);
                //$('.project-tiles').html(res);
                $('.tabular-agenda').html(res);
              
              }
          });
      });


      $('.track-list li').on('click',function(){
        var track_list=$(this).attr("data-track");
        $(this).addClass('active').siblings().removeClass('active');
        //alert(track_list); 
            $.ajax({
              type: 'POST',
              url: ajaxurl,
              dataType: 'html',
              data: {
                action: 'track_list',
                track_list:track_list,
              },
              success: function(res) {
                //alert(res);
                //$('.project-tiles').html(res);
                $('.tabular-agenda').html(res);
              
              }
          });
      });

});