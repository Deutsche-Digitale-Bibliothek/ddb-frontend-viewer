/*!

    Custom scripts
    ------------------------
    DDB-Viewer script for cookies, sidebar adaption eg.

!*/


$(document).ready(function() {

    // Add loading indicator just for the OL3 element (throw error after 20sec; runs only if there is an .current element in the toc to ensure image data is given)
    if(!$('ul.toc .current')[0]) {
        $('#tx-dlf-map .loading').remove();
    } else {
        var startTime = new Date().getTime();
        var timer = setInterval(function() {
            if(new Date().getTime() - startTime > 20000){
                clearInterval(timer);
                $('#tx-dlf-map .loading .loading-wrapper').html('<div class="warning">Fehler beim Laden der Bilddaten. Bitte versuchen Sie die Seite erneut aufzurufen.</div>');
                return;
            }
            if($('#tx-dlf-map .ol-viewport')[0]) {
                $('#tx-dlf-map .loading').fadeOut(800,function() { $(this).remove(); });
                clearInterval(timer);
            }
        },200);
    }

    // check mobile device to specify click events
    function mobileCheck() {
        var check = false;
        (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }
    var mobileEvent = mobileCheck() ? 'touchstart' : 'click';

    // tabbar function
    $('.tab-nav button').on(mobileEvent, function() {

        // if we’re already active we have nothing to do
        if ($(this).hasClass('active')) {
            return;
        }

        var target = $(this).attr('data-target');
        $('.tab-nav button').removeClass('active');
        $(this).addClass('active');
        $('.tab-content-pane').each(function() {
            $(this).removeClass('active');
        });
        $(target).addClass('active');

        // if fulltext is selected enable fulltext-mode, otherwise deactivate if neccessary
        if ($(this).hasClass('tab-fulltext') && !$("#tx-dlf-tools-fulltext").hasClass("fulltext-visible")) {
            $("#tx-dlf-tools-fulltext").click();
        }

        // if image-adjustment is selected enable image adjustmen, otherwise deactivate it
        if ($(this).hasClass('tab-imageadjust')) {
            $("#tx-dlf-tools-imagetools a").click();
        } else if ($(".image-manipulation .slider-container").hasClass("open")) {
             $("#tx-dlf-tools-imagetools a").click();
        }

        return false;
    });

    // menu toggles for offcanvas sidebar and pagegrid dock
    $('.sidebar-toggle, .tx-dlf-dockCloseContainer').on(mobileEvent, function(event) {
        var toggleElement = ($(this).attr('class').split(' ')[0] == 'tx-dlf-dockCloseContainer') ? '.tx-dlf-pagegrid' : '.sidebar';
        $(toggleElement).toggleClass('open');
        $('body').addClass('movin');
        if(toggleElement.split(' ')[0] == '.tx-dlf-pagegrid') {
            if($(toggleElement).hasClass('open')) {
                Cookies.set('ddbViewerPagegridActive', 'open');
            } else {
                Cookies.remove('ddbViewerPagegridActive');
            }
            $('.tx-dlf-dockCloseContainer').attr({'title': ($(toggleElement).hasClass('open')) ? $('li#tab-thumbnails-hide').text() : $('li#tab-thumbnails-show').text()});
        } else {
            $(this).toggleClass('open');
            $('.header .controls').toggleClass('disabled');
        }
        setTimeout(function() {
            $('body').removeClass('movin');
        }, 300);
    });

    // scroll to current element in toc
    if($('.current')[0] && !$('.current').isInViewport()) {
        $('#tab-toc').delay(1000).animate({
            scrollTop: $('.current').offset().top
        }, 3500);
    }

    // scroll to current element in search results
    if($('.sru-result-headline h3.active')[0] && !$('.sru-result-headline h3.active').isInViewport()) {
        $('#tab-search').delay(1000).animate({
            scrollTop: $('.sru-result-headline h3.active').offset().top
        }, 1500);
    }

    // Avoid broken image display if METS definitions are wrong
    $('.provider img').each(function() {
        if((typeof this.naturalWidth != "undefined" && this.naturalWidth == 0 ) || this.readyState == 'uninitialized' ) {
            $(this).parents('.header').addClass('missing-provider-image');
        }
    });

    // Check if there are is a download list. Otherwise disable tab nav element
    if(!$('#tab-downloads ul li')[0]) {
        $('.tab-downloads').addClass('disabled').attr({
            'title': $('#tab-downloads-disabled').text(),
            'disabled': 'disabled'
        });
    }

    // Check if there is a fulltext available. Otherwise disable tab nav element
    if(!$('#tx-dlf-tools-fulltext')[0]) {
        $('.tab-fulltext').addClass('disabled').attr({
            'title': $('li#tab-fulltext-disabled').text(),
            'disabled': 'disabled'
        });
    }

    // If we have a fulltext and it is visible switch to fulltext tab
    if (dlfUtils.getCookie("tx-dlf-pageview-fulltext-select") == 'enabled') {
        $('#tx-dlf-tools-fulltext').click();
    }

    // Check if the image manipulation is available
    $("#tx-dlf-tools-imagetools").bind('cssClassChanged', function(){
        if($("#tx-dlf-tools-imagetools").hasClass('deactivate')) {
            $('.tab-imageadjust').addClass('disabled').attr({
                'title': $('li#tab-imageadjust-disabled').text(),
                'disabled': 'disabled'
            });
        }
    });

    // Add active span to pagegrids paging and remove separate characters and after all this we split the result in two or three chunks to hide some numbers via CSS (Oh my, how stupid is that? Developers hell, here i come.)
    $('.tx-dlf-pagegrid-pagebrowser').html(function(_, html) {
        var newHTML = html.replace(/- \d+ -/g, function addActive(el) { return '<span class="active">'+el.replace(' -','').replace('- ','')+'</span>'; }).replace(/ - /g,'').split(/\.{3}(?!\.)/g);
        return (newHTML.length == 3) ? '<span class="nav-chunk part-1">'+newHTML[0]+'</span>...<span class="nav-chunk part-2">'+newHTML[1]+'</span>...<span class="nav-chunk part-3">'+newHTML[2]+'</span>' : '<span class="nav-chunk">'+newHTML[0]+'</span>...<span class="nav-chunk">'+newHTML[1]+'</span>';
    });

    // Resize function for sidebar (based on jQueryUI)
    var resize = $(".sidebar"), containerWidth = $(".main-wrapper").width();
    $(resize).resizable({
        handles: 'e',
        maxWidth: 900,
        minWidth: 370,
        animate: false,
        start: function(event, ui) {
            // to ensure proper width adaption disable CSS animations
            $('body').addClass('static');
        },
        resize: function(event, ui) {
            var currentWidth = ui.size.width;
            $('.document-view').width(containerWidth - currentWidth-10);
        },
        stop: function(event, ui) {
            // bring back (accidently) hidden canvas elements
            $('canvas.ol-unselectable').show();
            // fire resize window event to ensure the OL3 built in updateSize() function is triggered
            window.dispatchEvent(new Event('resize'));
            // set cookie to ensure settings stay present for next page eg.
            Cookies.set('ddbViewerSidebarWidth', ui.size.width);
            // bring back all the fancy animations
            $('body').removeClass('static');
        }
    });

    // enable click on fullscreen button
    $('button.fullscreen').on(mobileEvent, function() {
        if($('body.fullscreen')[0]) {
            exitFullscreen();
        } else {
            enterFullscreen();
        }
    });

    // if cookie for fullscreen view is present adapat initial page rendering
    if(Cookies.get('ddbViewerFullscreen')) {
        $('body').addClass('fullscreen static');
        $('.zoom .fullscreen').addClass('active').attr('title',$('li#document-fullscreen-close').text());
    }

    // If Cookie with sidebar width is present adapt page
    if(Cookies.get('ddbViewerSidebarWidth') && $(window).width() > 768) {
        var sidebarWidth = Cookies.get('ddbViewerSidebarWidth'),
            containerWidth = $('.main-wrapper').width(),
            documentViewWidth = containerWidth - sidebarWidth - 10;
        $('.sidebar').width(sidebarWidth);
        $('.document-view').width(documentViewWidth);
    }

    // If Cookie with pagegrid dock status is present just open it
    if(Cookies.get('ddbViewerPagegridActive')) {
        $('.tx-dlf-pagegrid').addClass('open');
        // Add title attribute to pagegrid trigger
        $('.tx-dlf-dockCloseContainer').attr({'title':$('li#tab-thumbnails-hide').text()});
    } else {
      $('.tx-dlf-dockCloseContainer').attr({'title':$('li#tab-thumbnails-show').text()});
    }

    // Finally all things are settled. Curtain up!
    $('body').removeClass('hidden');
    setTimeout(function() { $('body').removeClass('static'); }, 1000);

    // Force new window/tab for external links
    $('a[href^="http"]:not([href^="http://localhost"]):not([href*="dev.fiz-karlsruhe.de"]):not([href*="deutsche-digitale-bibliothek.de"])').attr('target','_blank');

});

$(document).keyup(function(e) {
    // Check if ESC key is pressed end fullscreen mode
    if (e.keyCode == 27 && $('body.fullscreen')[0]) {
            return exitFullscreen();
    }
});

// Activate fullscreen mode and set corresponding cookie
function enterFullscreen() {
    setTimeout(function() { window.dispatchEvent(new Event('resize')); }, 220);
    $("body").addClass('fullscreen'); $('.zoom .fullscreen').addClass('active').attr('title',$('li#document-fullscreen-close').text());
    Cookies.set('ddbViewerFullscreen', 'true');
}

// Exit fullscreen mode and drop cookie
function exitFullscreen() {
    setTimeout(function() { window.dispatchEvent(new Event('resize')); }, 220);
    $("body").removeClass('fullscreen'); $('.zoom .fullscreen').removeClass('active').attr('title',$('li#document-fullscreen').text());
    Cookies.remove('ddbViewerFullscreen');
}

// prototype function to retrieve if the given element is inside the viewport
$.fn.isInViewport = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
};

// Helper function to create a trigger a custom event when a CSS class was added
(function(){
    var originalAddClassMethod = jQuery.fn.addClass;

    jQuery.fn.addClass = function(){
        // Execute the original method.
        var result = originalAddClassMethod.apply( this, arguments );

        // trigger a custom event
        jQuery(this).trigger('cssClassChanged');

        // return the original result
        return result;
    }
})();

// EOF
