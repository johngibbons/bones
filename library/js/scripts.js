/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}

var viewport = updateViewportDimensions();

/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 */ 

 /*
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


//Google Maps for home page

function initializeGoogleMaps() {

// Create an array of styles.
  var styles = [
    {
      stylers: [
        { hue: "#a9c3d9" },
      ]
    },
    {
      featureType: "road",
      elementType: "geometry",
      stylers: [
        { lightness: 100 },
      ]
    },
    {
      featureType: "poi.medical",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
    },
  ];

  // Create a new StyledMapType object, passing it the array of styles,
  // as well as the name to be displayed on the map type control.

  var latitude = document.getElementById('map-latitude').innerHTML;
  var longitude = document.getElementById('map-longitude').innerHTML;

  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(latitude, longitude),
    styles: styles
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

}

function loadGoogleMaps() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initializeGoogleMaps';
  document.body.appendChild(script);
}

window.onload = loadGoogleMaps;

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  navToggle();

    //custom nav styles based on number of items

  var numberMenuItems = $('.menu-item').length;
  var navLogoHeight = $('#nav-logo-container').height();
  var headerBarHeight = $('.header').height();

  var totalNavHeight = viewport.height - 120 - headerBarHeight;
  var menuItemHeight = totalNavHeight / numberMenuItems;

  $(window).resize(function () {
 
     // if we're on the home page, we wait the set amount (in function above) then fire the function
       waitForFinalEvent( function() {
        
        viewport = updateViewportDimensions();
        resizeNavHeight();
      
     }, timeToWaitForLast, "resize width"); 

  });

  //nice loading for images
  $("img").load(function() {
    $(this).parent().closest('.image-wrap').addClass("loaded");
  }).each(function() {
    if(this.complete) $(this).load();
  });

//navigation evenly spaced elements
function resizeNavHeight() {
  if (viewport.width < 768) {
    $('.menu-item a').css('height', menuItemHeight);
    $('.menu-item a').css('padding-top', menuItemHeight/2 - 14);
  }
  else {
    $('.menu-item a').css('height', 'auto');
  }
}

resizeNavHeight();


  var s = $(".sticky");
  var pos = s.offset();                    
  $(window).scroll(function() {
    var windowpos = $(window).scrollTop();
    if (windowpos >= pos.top  || $('.header').hasClass('opened')) {
      s.addClass("stuck");
      $('#home-content-title').addClass("visible");
    } else {
      s.removeClass("stuck"); 
      $('#home-content-title').removeClass("visible");
    }
  });

    $('.unit-image-thumb').first().addClass('active');
  //gallery function for single unit pages
    $(".unit-image-thumb").click(function(e) {
      e.preventDefault();
      var image = $(this).attr("rel");
      $(".unit-image-thumb").removeClass('active');
      $(this).addClass('active');
      $('.unit-image-frame').html('<img src="' + image + '"/>');
    });

  //dropdown for other units
    $('#unit-other-units').click(function() {
      $('.cta li a').toggleClass('opened');
    });

  var closeURL = window.location.protocol + "//" + window.location.host + "/alura/wp-content/themes/alura/library/images/close.png";
  var navURL = window.location.protocol + "//" + window.location.host + "/alura/wp-content/themes/alura/library/images/nav-icon.png";

  // swipebox gallery
    $( '.swipebox' ).swipebox( {
      afterOpen: function() {
        $('#swipebox-bottom-bar')
        $('#container').hide();
      },
      afterClose: function() {
        $('#container').show();
        navToggle();
      } 
    });


  // // fullscreen images
  //     var allImages = [];
  //     $( ".image-thumb" ).each(function( index ) {
  //       allImages.push($(this).attr("rel"));
  //     });
  //     console.log(allImages);

  //   $('.image-thumb').click(function() {
  //     var clickedThumb = $(this);
  //     var clickedImage = $(this).attr("rel");
  //     var relURL = window.location.protocol + "//" + window.location.host + "/alura/wp-content/themes/alura/library/images/close.png";
  //     $('.mobile-nav-icon').html('<img src="' + relURL + '"/>').addClass('close-btn').removeClass('mobile-nav-icon');
  //     fullscreen(clickedImage, clickedThumb);

  //     $('.close-btn img').click(function() {
  //       $('.full-back-nav').removeClass('hidden');
  //       $('.full-forward-nav').removeClass('hidden');
  //       var relURL = window.location.protocol + "//" + window.location.host + "/alura/wp-content/themes/alura/library/images/nav-icon.png";
  //       $('.image-full-frame, .image-full-nav').hide();
  //       $('.images-page-thumbs, .page-title').show();
  //       $('.close-btn').html('<img src="' + relURL + '"/>').addClass('mobile-nav-icon').removeClass('close-btn');
  //       navToggle();
  //     });

  //     $('img.full-back-nav').click(function() {
  //       currentImage = $('.image-full-frame').css("background-image");
  //       index = allImages.indexOf(currentImage);
  //       console.log(currentImage);

  //       i == 0 ? $('.full-back-nav').addClass('hidden') : $('.image-full-frame').css("background-image", 'URL(' + allImages[i-1] + ')');
  //     });

  //     $('img.full-forward-nav').click(function() {
  //       currentImage = $('.image-full-frame').css("background-image");

  //       for (i = 0; i < allImages.length; i++) { 
  //           if (allImages[i] == currentImage) {
  //             return i;
  //           }
  //       }
        
  //       $('.image-full-frame').css("background-image", 'URL(' + allImages[i+1] + ')');
  //     });
  //   });

function navToggle() {
  $('.mobile-nav-icon img').click(function() {
    $('.header').toggleClass('opened');
    $('.header').addClass('stuck');
    $('.page-title, .single-title, .entry-title').toggle();
    $('#content, #home-hero, .footer').toggle();
  });
};

// function fullscreen(image, thumb) {
//   $('.image-full-frame, .image-full-nav').show();
//   $('.images-page-thumbs, .page-title').hide();
//   $('.image-full-frame').css("background-image", 'URL(' + image + ')');
//   if ( $( thumb ).is( ":first-child" )) {$('.full-back-nav').addClass('hidden');}
//   if ( $( thumb ).is( ":last-child" )) {$('.full-forward-nav').addClass('hidden');}
// }

}); /* end of as page load scripts */
