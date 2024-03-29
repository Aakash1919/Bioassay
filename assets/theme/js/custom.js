$("form#regform").submit(function (event) {
    var payment_type = jQuery(this).val();
    if (payment_type == "Purchase Order") {
        var po_number = jQuery("#po_num").val();
        jQuery("#input_po_num").val(po_number);
        var tax_exempt_id = jQuery("#tax_exempt_id").val();
        jQuery("#sales_tax_exempt_num1").val(tax_exempt_id);
    }
});
function dis_check() {
    var discountcod = document.getElementById('discode').value;
    if (discountcod == '')
        exit;

    var dataString = "discountcod=" + discountcod;
    $.ajax({
        type: "POST",
        url: "/checkout/getDiscount",
        data: dataString,
        success: function (data) {
            if (data == "Invalid Code" || data == "Discount Code Expired") {
                $("#discode").val(data);
                return false;
            } else {
                location.reload();
            }
        }
    });
}

function clearall(quantity, id) {
    var code = document.getElementById(id).value;
    if (code == "Invalid Code") {
        document.getElementById(id).value = '';
    }
}
jQuery(document).on('change', "#paymenttype", function () {
    jQuery("#payment_type").val("");
    var payment_type = jQuery(this).val(); 
    jQuery("#po_details").css('display', 'none');
    if (payment_type == "Purchase Order") {
        jQuery("#po_details").toggle();
        jQuery("#po_column").css("display", "block");
        jQuery("#regform").attr("action", "/checkout/finalTransaction");
        jQuery("#bill_chkout_qtn").val("Submit Order");
        document.getElementById("bill_chkout_qtn").id = 'bill_submit_qtn'
        document.getElementById("bill_submit_qtn").type = 'submit'
    } else {
        if(document.getElementById("bill_submit_qtn")) {   
            document.getElementById("bill_submit_qtn").id = 'bill_chkout_qtn'
            document.getElementById("bill_chkout_qtn").type = 'button'
        }
        if (payment_type == "Credit Card") {
            jQuery("#po_details").toggle();
            jQuery("#wait").css("display", "block");
            jQuery("#bill_chkout_qtn").attr("disabled", true);
            jQuery("#po_column").css("display", "none");
            jQuery("#bill_chkout_qtn").attr("disabled", false);
            jQuery("#wait").css("display", "none");
        } else {
            jQuery("#po_details").toggle();
            jQuery("#po_column").css("display", "none");
            jQuery("#regform").attr("action", "/checkout/finalTransaction");
            jQuery("#po_num").attr("required", false);
        }
    }
    //payment_type
    jQuery("#payment_type").val(payment_type);
    jQuery("#bill_chkout_qtn").attr("disabled", false);
});

$(document).on('click', '#bill_chkout_qtn', function () {
    var payment_type = jQuery("#payment_type").val();
    if (payment_type === 'Credit Card') {
        submitForm("form#regform")
    }
    else if(payment_type === '') {
        // paypal Modal
      alert('Please Select Payment Type')
    }
     else {
        $("#regform").submit();
    }
})

$(document).on('click','.closeModal', function() {
    document.getElementById("hostedAccessPayment").style.display = "none";
})

$(function () {
    if (!window.AuthorizeNetPopup) window.AuthorizeNetPopup = {};
    if (!AuthorizeNetPopup.options) AuthorizeNetPopup.options = {
        onPopupClosed: null
        };

    AuthorizeNetPopup.closePopup = function () {
        document.getElementById("divAuthorizeNetPopupScreen").style.display = "none";
        document.getElementById("divAuthorizeNetPopup").style.display = "none";
        document.getElementById("iframeAuthorizeNet").src = "/empty.html";
        if (AuthorizeNetPopup.options.onPopupClosed) AuthorizeNetPopup.options.onPopupClosed();
        };


    AuthorizeNetPopup.openPopup = function (authToken) {
        var popup = document.getElementById("divAuthorizeNetPopup");
        var popupScreen = document.getElementById("divAuthorizeNetPopupScreen");
        var ifrm = document.getElementById("iframeAuthorizeNet");
        var form = document.forms["formAuthorizeNetPopup"];
        $("#popupToken").val(authToken);
        form.action = "https://test.authorize.net/payment/payment";
        ifrm.style.width = "442px";
        ifrm.style.height = "578px";

        form.submit();

        popup.style.display = "";
        popupScreen.style.display = "";
        centerPopup();
        };


    AuthorizeNetPopup.onReceiveCommunication = function (querystr) {
            var params = parseQueryString(querystr);
            switch (params["action"]) {
                case "successfulSave":
                    // window.location.href="/checkout/thanks"
                    break;
                case "cancel":
                    AuthorizeNetPopup.closePopup();
                    break;
                case "transactResponse":
                    AuthorizeNetPopup.closePopup();
                    var order = jQuery("input#order").val()
                    if(order) {
                        $.post( "/checkout/getAuthorizeResponse",{order : order}, function( data ) {
                            var jsonData = JSON.parse(data)
                            if(jsonData==true) {
                                window.location.href ='/checkout/thanks'
                            }
                        });
                    }
                    break;
                case "resizeWindow":
                    var w = parseInt(params["width"]);
                    var h = parseInt(params["height"]);
                    var ifrm = document.getElementById("iframeAuthorizeNet");
                    ifrm.style.width = w.toString() + "px";
                    ifrm.style.height = h.toString() + "px";
                    centerPopup();
                    break;
            }
        };


    function centerPopup() {
        var d = document.getElementById("divAuthorizeNetPopup");
        d.style.left = "50%";
        d.style.top = "50%";
        var left = -Math.floor(d.clientWidth / 2);
        var top = -Math.floor(d.clientHeight / 2);
        d.style.marginLeft = left.toString() + "px";
        d.style.marginTop = top.toString() + "px";
        d.style.zIndex = "2";
        if (d.offsetLeft < 16) {
            d.style.left = "16px";
            d.style.marginLeft = "0px";
            }
        if (d.offsetTop < 16) {
            d.style.top = "16px";
            d.style.marginTop = "0px";
            }
        }

    function parseQueryString(str) {
            var vars = [];
            var arr = str.split('&');
            var pair;
            for (var i = 0; i < arr.length; i++) {
                pair = arr[i].split('=');
                vars.push(pair[0]);
                vars[pair[0]] = unescape(pair[1]);
            }
            return vars;
        }
}());

var modal = document.getElementById("paypalModal");
var span = document.getElementsByClassName("close")[0];      
if(span) {  
    span.onclick = function() {
        modal.style.display = "none";
    }

}   
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function submitForm(form){
    var url = $(form).attr("action");
    var formData = {};
    $(form).find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    formData['bcountry'] = $('#bcountry').val();
    $.post(url, formData).done(function (data) {
       var jsonData = JSON.parse(data)
        if(jsonData) {
        jQuery("input#order").val(jsonData.order_id);
        AuthorizeNetPopup.openPopup(jsonData.token)
        $(window).scrollTop(0);
       }
    });
}