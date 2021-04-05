// Click to Chat
(function ($) {

var v = '3.2.5';

// ready
$(function () {
    
var url = window.location.href;
var post_title = (typeof document.title !== "undefined" ) ? document.title : '';
// is_mobile yes/no,  desktop > 1024 
var is_mobile = (typeof screen.width !== "undefined" && screen.width > 1024) ? "no" : "yes";


function ht_ctc() {
    console.log('ht_ctc');
    var ht_ctc_chat = document.querySelector('.ht-ctc-chat');
    if (ht_ctc_chat) {

        // display
        display_chat(ht_ctc_chat);

        // click
        ht_ctc_chat.addEventListener('click', function () {
            console.log('click event listener');

            // link
            ht_ctc_link(ht_ctc_chat);

            // analytics
            ht_ctc_chat_analytics(ht_ctc_chat);
        });

    }

    // shortcode - click
    // $('.ht-ctc-sc-chat').click(function () {
    $(document).on('click', '.ht-ctc-sc-chat', function () {
        console.log('shortcode click');

        var number = this.getAttribute('data-number');
        var pre_filled = this.getAttribute('data-pre_filled');
        pre_filled = pre_filled.replace(/\[url]/gi, url);
        pre_filled = encodeURIComponent(pre_filled);
        var webandapi = this.getAttribute('data-webandapi');

        // web/api.whatsapp or wa.me
        if ('webapi' == webandapi) {
            if (is_mobile == 'yes') {
                var base_link = 'https://api.whatsapp.com/send';
            } else {
                var base_link = 'https://web.whatsapp.com/send';
            }
            window.open(base_link + '?phone=' + number + '&text=' + pre_filled, '_blank', 'noopener');
        } else {
            // wa.me
            var base_link = 'https://wa.me/';
            window.open(base_link + number + '?text=' + pre_filled, '_blank', 'noopener');
        }

        // analytics
        ht_ctc_chat_analytics(this);
    });


}
ht_ctc();

// display based on device
function display_chat(p) {
    if (is_mobile == 'yes') {
        var display_mobile = p.getAttribute('data-display_mobile');
        if ( 'show' == display_mobile ) {

            // remove desktop style
            var rm = document.querySelector('.ht_ctc_desktop_chat');
            (rm) ? rm.remove() : '';

            var css = p.getAttribute('data-css');
            var position_mobile = p.getAttribute('data-position_mobile');
            p.style.cssText = position_mobile + css;
            display(p)
        }
    } else {
        var display_desktop = p.getAttribute('data-display_desktop');
        if ( 'show' == display_desktop ) {

            // remove mobile style
            var rm = document.querySelector('.ht_ctc_mobile_chat');
            (rm) ? rm.remove() : '';

            var css = p.getAttribute('data-css');
            var position = p.getAttribute('data-position');
            p.style.cssText = position + css;
            display(p)
        }
    }
}

function display(p) {
    // p.style.removeProperty('display');
    // var x = p.style.getPropertyValue("display");
    // p.style.display = "block";
    try {
        var dt = parseInt(p.getAttribute('data-show_effect'));
        $(p).show(dt);
    } catch (e) {
        p.style.display = "block";
    }

    try {
        ht_ctc_things(p);
    } catch (e) {}

}

function ht_ctc_things(p) {
    console.log('animations');
    // animations
    var animateclass = p.getAttribute('data-an_type')
    setTimeout(function () {
        p.classList.add('ht_ctc_animation', animateclass);
    }, 120);

    // cta hover effects
    $(".ht-ctc-chat").hover(function () {
        $('.ht-ctc-chat .ht-ctc-cta-hover').show(120);
    }, function () {
        $('.ht-ctc-chat .ht-ctc-cta-hover').hide(100);
    });
}

// analytics
function ht_ctc_chat_analytics(values) {
    console.log('analytics');

    var id = values.getAttribute('data-number');

    // Google Analytics
    var ga_category = 'Click to Chat for WhatsApp';
    var ga_action = 'chat: ' + id;
    var ga_label = post_title + ', ' + url;
    // if ga_enabled
    if ( 'yes' == values.getAttribute('data-is_ga_enable') ) {
        if (typeof gtag !== "undefined") {
            console.log('gtag');
            gtag('event', ga_action, {
                'event_category': ga_category,
                'event_label': ga_label,
            });
        } else if (typeof ga !== "undefined" && typeof ga.getAll !== "undefined") {
            console.log('ga');
            var tracker = ga.getAll();
            tracker[0].send("event", ga_category, ga_action, ga_label);
            // ga('send', 'event', ga_category, ga_action, ga_label);
        } else if (typeof __gaTracker !== "undefined") {
            __gaTracker('send', 'event', ga_category, ga_action, ga_label);
        }
    }

    // dataLayer
    if (typeof dataLayer !== "undefined") {
        console.log('dataLayer');
        dataLayer.push({
            'event': 'Click to Chat',
            'event_category': ga_category,
            'event_label': ga_label,
            'event_action': ga_action
        });
    }

    // FB Pixel
    if ( 'yes' == values.getAttribute('data-is_fb_pixel') ) {
        console.log('fb pixel');
        if (typeof fbq !== "undefined") {
            fbq('trackCustom', 'Click to Chat by HoliThemes', {
                'Category': 'Click to Chat for WhatsApp',
                'return_type': 'chat',
                'ID': id,
                'Title': post_title,
                'URL': url
            });
        }
    }

}

// link - chat
function ht_ctc_link(values) {

    var number = values.getAttribute('data-number');
    var pre_filled = values.getAttribute('data-pre_filled');
    pre_filled = pre_filled.replace(/\[url]/gi, url);
    pre_filled = encodeURIComponent(pre_filled);
    var webandapi = values.getAttribute('data-webandapi');

    if ( '' == number ) {
        values.innerHTML = values.getAttribute('data-no_number');
        return;
    }

    // web/api.whatsapp or wa.me 
    if ( 'webapi' == webandapi ) {
        if (is_mobile == 'yes') {
            var base_link = 'https://api.whatsapp.com/send';
        } else {
            var base_link = 'https://web.whatsapp.com/send';
        }
        window.open(base_link + '?phone=' + number + '&text=' + pre_filled, '_blank', 'noopener');
    } else {
        // wa.me
        var base_link = 'https://wa.me/';
        window.open(base_link + number + '?text=' + pre_filled, '_blank', 'noopener');
    }

}

});

})(jQuery);