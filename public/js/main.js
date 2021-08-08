(function ($) {
	"use strict";
    jQuery(document).ready(function($){
        
        /*--------------------
            wow js init
        ---------------------*/
        new WOW().init();

        /*-------------------------
            magnific popup activation
        -------------------------*/
        $('.video-play-btn,.video-popup,.small-vide-play-btn').magnificPopup({
            type: 'video'
        });
        /*------------------
            back to top
        ------------------*/
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });
        /*-------------------------
            counter section activation
        ---------------------------*/
        var counternumber = $('.num-count');
        counternumber.counterUp({
            delay: 20,
            time: 5000 
        });
        
        /*---------------------------
            testimonial carousel
        ---------------------------*/
        var $tesitmonialCarousel = $('#testimonial-carousel');
        if ($tesitmonialCarousel.length > 0) {
            $tesitmonialCarousel.owlCarousel({
                loop: true,
                autoplay: true, //true if you want enable autoplay
                autoPlayTimeout: 1000,
                margin: 30,
                dots: false,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    960: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1920: {
                        items: 1
                    }
                }
            });
        }
       

    });
    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        //back to top show/hide
       var ScrollTop = $('.back-to-top');
       if ($(window).scrollTop() > 1000) {
           ScrollTop.fadeIn(1000);
       } else {
           ScrollTop.fadeOut(1000);
       }
       /*--------------------------
        sticky menu activation
       -------------------------*/
        var st = $(this).scrollTop();
        var mainMenuTop = $('.navbar-area');
        if ($(window).scrollTop() > 1000) {
            if (st > lastScrollTop) {
                // hide sticky menu on scrolldown 
                mainMenuTop.removeClass('nav-fixed');
                
            } else {
                // active sticky menu on scrollup 
                mainMenuTop.addClass('nav-fixed');
            }

        } else {
            mainMenuTop.removeClass('nav-fixed ');
        }
        lastScrollTop = st;
       
    });
           
    
    var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(
        function(event) {
            event.preventDefault();
            $('.app').toggleClass('sidenav-toggled');
        }
    );

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

    $(".reply-popup").click(function(){
        var btnId = this.id;
        var replyBox = "#reply-"+btnId;
        $(replyBox).toggle();
      });


      $('select[name="country"]').on('change', function() {
        var countryID = $(this).val();
            if(countryID) {
                $.ajax({
                    url: '/feed/cities/'+encodeURI(countryID),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            $('#code').text("+"+value.phonecode);
                            $('#codehidden').val(value.phonecode);
                            });
                        }
                });
            } else {
                $('select[name="city"]').empty();
            }
           });

    $('#custom-file-input').change(function(){
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = $('<img class="img-thumbnail rounded float-right m-2">');
                img.attr('src', e.target.result);
                // img.width('64px')
                img.height('64px');
                img.appendTo('#preview');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
    $('#linkInput').on('input',function(e){
        console.log(e.target.value);
        $('#modeliframe').attr("src", e.target.value );
        $('#linkurl').val(e.target.value)
    });
    $(document).on('click','.depoButton', function(){
        $('#ModalLabel').text($(this).data('name'));
        $('#gateWay').val($(this).data('gate'));
    });
}(jQuery));	
