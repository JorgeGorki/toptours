// Click to Chat
document.addEventListener('DOMContentLoaded', function() {

    // M.AutoInit();

    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems, {});

    var elems = document.querySelectorAll('.collapsible');
    M.Collapsible.init(elems, {});

    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems, {});

    var elems = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(elems, {});

    // var elems = document.querySelectorAll('.tabs');
    // M.Tabs.getInstance(elems, {});

});

(function($){

// ready
$(function(){

$('select').formSelect();
$('.collapsible').collapsible();
$('.modal').modal();
$('.tooltipped').tooltip();

$('.ht-ctc-color').wpColorPicker();

// show/hide settings
function ht_ctc_show_hide_options () {

    // default display
    var val = $('.select_show_or_hide').find(":selected").val();
    if (val == 'show') {
        $(".showbased").show();
    } else if (val == 'hide') {
        $(".hidebased").show();
    }

    // on change
    $(".select_show_or_hide").on("change", function (e) {
        
        var change_val = e.target.value;
        $(".showbased").hide();
        $(".hidebased").hide();

        if (change_val == 'show') {
            $(".showbased").show(500);
        } else if (change_val == 'hide') {
            $(".hidebased").show(500);
        }
    });

}
ht_ctc_show_hide_options();

// call to action
var cta_styles = ['.ht_ctc_s2', '.ht_ctc_s3', '.ht_ctc_s3_1', '.ht_ctc_s7'];
cta_styles.forEach(ht_ctc_admin_cta);

function ht_ctc_admin_cta(style) {
    // default display
    var val = $(style + ' .select_cta_type').find(":selected").val();
    if (val == 'hide') {
        $(style + " .cta_stick").hide();
    }

    // on change
    $(style + " .select_cta_type").on("change", function (e) {
        var change_val = e.target.value;
        if (change_val == 'hide') {
            $(style + " .cta_stick").hide(100);
        } else {
            $(style + " .cta_stick").show(200);
        }
    });
}

function ht_ctc_admin_animations() {
    // default display
    var val = $('.select_an_type').find(":selected").val();
    if (val == 'no-animation') {
        $(".an_delay").hide();
        $(".an_itr").hide();
    }

    // on change
    $(".select_an_type").on("change", function (e) {

        var change_val = e.target.value;
        // $(".showbased").hide();
        // $(".hidebased").hide();

        if (change_val == 'no-animation') {
            $(".an_delay").hide();
            $(".an_itr").hide();
        } else {
            $(".an_delay").show(500);
            $(".an_itr").show(500);
        }
    });
}
ht_ctc_admin_animations();

// on change - styles
$(".chat_select_style").on("change", function (e) {
    $(".customize_styles_link").animate({ fontSize: '1.2em' }, "slow");
});

// Deskop, Mobile
if ($('#hideon_desktop').is(':checked')) {
    $(".ht_ctc_admin_desktop").hide();
}

if ($('#hideon_mobile').is(':checked')) {
    $(".ht_ctc_admin_mobile").hide();
}

$(".hidebasedondevice").on("change", function (e) {
    if ($('#hideon_desktop').is(':checked')) {
        $(".ht_ctc_admin_desktop").hide();
    } else {
        $(".ht_ctc_admin_desktop").show();
    }

    if ($('#hideon_mobile').is(':checked')) {
        $(".ht_ctc_admin_mobile").hide();
    } else {
        $(".ht_ctc_admin_mobile").show();
    }
});

// hide nothing or hide only on one device.
$(document).on('click', '.hidebasedondevice', function () {
    $('.hidebasedondevice').not(this).prop('checked', false);
});

        
});


})(jQuery);
