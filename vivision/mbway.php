

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<TITLE>Billing</TITLE>

    <script TYPE="text/javascript">
        window.onloadErrors = [];

        function paypalCheckoutLoadFailed() {
            window.onloadErrors.push(['paypal', 'checkout.js loading failed'])
        }
    </script>

    <!-- include vendor payment libs -->
    <script src="https://bitpay.com/bitpay.min.js"></script>
        <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn" onerror="paypalCheckoutLoadFailed()"></script>

    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/3.48.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/hosted-fields.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/vault-manager.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/paypal-checkout.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/apple-pay.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/google-payment.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/venmo.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.48.0/js/data-collector.min.js"></script>

    <script>
        function initSentry() {
            Sentry.init({
                dsn: 'https://348f783cbd8742deaebf2b58f377b642@sentry.namesilo.net/5',
                environment: 'production',
                attachStacktrace: true,
                beforeBreadcrumb(breadcrumb, hint) {
                    if (breadcrumb.category === 'xhr') {
                        breadcrumb.data.response = (hint.xhr).response;
                    }
                    return breadcrumb;
                }
            });
            Sentry.setTag('appVersion', '0.1');
        }
    </script>
    <script src="https://browser.sentry-cdn.com/5.27.1/bundle.min.js"
        integrity="sha384-oLDTaC1h1q52AeEe8tHrz2rHl4He0XwOB3/lsZ4kafbI6glka5MfnFbK9xkLAx44"
        crossorigin="anonymous"
        onload="initSentry()"
    ></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MNKQPHH');</script>
<!-- End Google Tag Manager -->

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"> 

<LINK REL="shortcut icon" HREF="/favicon.ico" TYPE="image/x-icon"> 

<META NAME="google" VALUE="notranslate">

<LINK REL="stylesheet" TYPE="text/css" HREF="/css/style.css?cb=5">
<LINK REL="stylesheet" TYPE="text/css" HREF="/css/cluetip.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="/shadowbox/shadowbox.css">

<SCRIPT TYPE="text/javascript" SRC="/global.js?cb=9"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="/jslib/jquery-1.9.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="/jslib/jquery.cluetip.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="/shadowbox/shadowbox.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="/jslib/process_block2.66.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" SRC="/jslib/jquery.idle-timer2.js"></SCRIPT>
















    <script>

        window.intercomSettings = {
                        email: 'danielchanfana@gmail.com',
            user_hash: '99dee08035f73ae977669dd28d65310e8b24c209e289b24e21ecfeac7920675e',
            "logged_in": 1,
            created_at: 1628016987,
            user_name: 'superbem',
            first_name: 'Daniel',
            "domains": 4,
                        app_id: "pwyqj8en"
        };

    </script>
    <script>
        (function () {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', w.intercomSettings);
            } else {
                var d = document;
                var i = function () {
                    i.c(arguments);
                };
                i.q = [];
                i.c = function (args) {
                    i.q.push(args);
                };
                w.Intercom = i;
                var l = function () {
                    var s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = 'https://widget.intercom.io/widget/pwyqj8en';
                    var x = d.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                };
                if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();
    </script>
    


<SCRIPT TYPE="text/javascript">

Shadowbox.init({players:['iframe']});

$(document).ready(function() {

    $('a.ct').cluetip({
        splitTitle: '|',
        cluetipClass: 'jtip',
        arrows: true, 
        dropShadow: true, 
        hoverIntent: false
    });

    nsToggleVisibility('cartAlertBox', 'hide');
    nsToggleVisibility('cartErrorBox', 'hide');
    nsToggleVisibility('informationAlertBox', 'hide');
    nsToggleVisibility('cart_next_discount', 'hide');

        nextRegistrationDiscount();
    
    
    
    
    
});

</SCRIPT>



<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '573967183017375'); 
fbq('trackSingle', '573967183017375', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=573967183017375&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

<!-- Quora Pixel Code -->
<script>
!function(q,e,v,n,t,s)
{if(q.qp) return; n=q.qp=function(){n.qp?
n.qp.apply(n,arguments):n.queue.push(arguments);};
n.queue=[];t=document.createElement(e);t.async=!0;t.src=v;
s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}
(window, 'script', 'https://a.quora.com/qevents.js');
qp('init', '55c48db0b64e4ab79582fa0c32310485'); qp('track', 'ViewContent');
</script>
<!-- End Quora Pixel Code -->


<SCRIPT TYPE="text/javascript">
$(document).ready(function(){      
    $('#state_tf').hide();
    $('#phone_intl').hide();
    $('#mobile_intl').hide();
    $('#fax_intl').hide();
    $('#form_vat_number').hide();
    $('#form_registration_number').hide();
});
</SCRIPT>

<SCRIPT TYPE="text/javascript">$(document).ready(function() {stateCheck('US', 1);});</SCRIPT>

<SCRIPT TYPE="text/javascript">

function stateCheck(country, just_state_label_toggle) {

    if(country == '') return;

    $('#state_label').html('<nobr>' + stateLabels(country) + ':</nobr>');

    if(country == 'US' || country == 'CA') {

        $('#state_select').show();
        $('#state_tf').hide();

        $('#phone_dom').show();
        $('#phone_intl').hide();

        $('#mobile_dom').show();
        $('#mobile_intl').hide();

        $('#fax_dom').show();
        $('#fax_intl').hide();

        $('#phone_dom_country_code').html('+1.');
        $('#mobile_dom_country_code').html('+1.');
        $('#fax_dom_country_code').html('+1.');

        if(!just_state_label_toggle) {

            loadOptions({
                  select:   document.getElementById('state'),
                  options:  eval('('+getURL('/country_states.php?ajax=1&op=country&country='+escape(country))+')')
            });

        }

        
    } else {

        $('#state_tf').show();
        $('#state_select').hide();

        $('#phone_intl').show();
        $('#phone_dom').hide();

        $('#mobile_intl').show();
        $('#mobile_dom').hide();

        $('#fax_intl').show();
        $('#fax_dom').hide();

        var return_data = getURL(location.href + '?ajax=1&op=get_phone_code&country=' + escape(country));
        var returned_options = eval('(' + return_data + ')');

        $('#phone_intl_country_code').html('+' + returned_options.code + '.');
        $('#mobile_intl_country_code').html('+' + returned_options.code + '.');
        $('#fax_intl_country_code').html('+' + returned_options.code + '.');

        
    }

}

function vatCheck(country) {

    var return_data = getURL(location.href + '?ajax=1&op=vat_check&country=' + escape(country));
    var returned_options = eval('(' + return_data + ')');

    var vat_check = returned_options.vat;

    if(vat_check == 1) {

        $('#form_vat_number').show();
        $('#form_registration_number').show();

    } else {

        $('#form_vat_number').hide();
        $('#form_registration_number').hide();

    }

}

</SCRIPT>

<!-- Hotjar Tracking Code -->
<script>
(function(h,o,t,j,a,r){
    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1727433,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- End Hotjar Tracking Code -->

<SCRIPT TYPE="text/javascript">

function validate(form) {
    var errors = new Array();

    if (!form.approve_terms.checked) {
        errors[errors.length] = 'You must agree to our Terms & Conditions';
    }

    var formIsValid = errors.length === 0;

    if (!formIsValid) {
        var errormessage = "The following problems were detected with the information you submitted:\n\n";
        for (var i = 0; i < errors.length; i++) {
            errormessage += ' - '+errors[i]+"\n";
        }
        errormessage += "\nPlease make the appropriate changes and resubmit.";
        alert(errormessage);        
    } else {
        showSubmitProgress();
    }
    return formIsValid;
}

function savedMethodsFormValidate(form){

    var errors = new Array();

    if (!form.saved_methods_approve_terms.checked) {
        errors[errors.length] = 'You must agree to our Terms & Conditions';
    }

    var formIsValid = errors.length == 0;

    if (!formIsValid) {
        var errormessage = "The following problems were detected with the information you submitted:\n\n";
        for (var i = 0; i < errors.length; i++) {
            errormessage += ' - '+errors[i]+"\n";
        }
        errormessage += "\nPlease make the appropriate changes and resubmit.";
        alert(errormessage);
    } else {
        showSubmitProgress();
    }
    return formIsValid;
}

function showSubmitProgress(){
    $("#submitButton").prop('disabled','disabled').css('opacity',0.25);
    $('#submitButtonField').html('<div id="formProcessingText">We are processing your order...</div>');

    $("#savedMethodsSubmitButton").prop('disabled','disabled').css('opacity',0.25);
    $('#savedMethodsSubmitButtonField').html('<div id="formProcessingText">We are processing your order...</div>');
}

function newCard(profile) {

    if(profile == '') {
        $('#newCard').fadeIn();
        nsToggleVisibility('expandNewPayment', 'hide');
        $('#stored_profile').val('');
    } else {
        $('#newCard').fadeOut();
        nsToggleVisibility('expandNewPayment', 'show');
    }

}

function showNickname(store_check) {

    if(store_check == '1') {
        nsToggleVisibility('card_nickname', 'show');
    } else {
        nsToggleVisibility('card_nickname', 'hide');
    }

}

function prePopulate() {

    $('#first_name').val("Daniel");
    $('#last_name').val("Santos");
    $('#address').val("Rua Elisa Laureano Santos");

            $('#address2').val("n8");
    
    $('#city').val("Rio Maior");
    $('#zip').val("2040-180");

    $('#country').val("PT");

    stateCheck("PT", 0);

    statePrePopulate();

}

function statePrePopulate() {

    $('#state').val("SANTAREM");
    $('#state_tfField').val("SANTAREM");

}

function handleOptions(checked, showFinalize, extraShow) {

    $('[name=payment_option]').prop('checked',false);
    $('[name=payment_option][value="' + checked + '"]').prop('checked',true);
    var line = $('[name=payment_option][value="' + checked + '"]').closest('tr');

    var load = line.find('[data-load-message]');
    if (load.length > 0) {
        $(load).html('<div id="formProcessingText">' + load.data('load-message') + '</div>');
        line.find('.payment_method_subsection').parent().hide();
    }

    $('.paymentAddonBlock').hide();
    nsToggleVisibility("finalizeOrder", showFinalize ? 'show' : 'hide');
    if(extraShow) {
        $.each(extraShow, function(k, v) {
            nsToggleVisibility(v, 'show');
        });
    }

}

function useAccountFunds() {

    handleOptions('account_funds', true, ["accountFundsBox"]);
    
    var return_data = getURL(location.href + '?ajax_account_funds=1');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.error != '') {

        $('#accountFundsVerbiage').html(returned_options.error);
        nsToggleVisibility('finalizeOrder', 'hide');

    }

    if(returned_options.success == '1') {

        $('#accountFundsVerbiage').html('You have selected to use your NameSilo account funds to pay for this order. Simply click the "Place My Order" button below to confirm this selection and finalize your order.');
        nsToggleVisibility('finalizeOrder', 'show');

    }

    $('html,body').animate({scrollTop: $('#accountFundsBox').offset().top},'slow');

}

function paypalSetExpress() {

    if(confirm('Please confirm our PayPal terms before proceeding:\n\nAfter completing your transaction on the PayPal site, you must return to our site in order to complete your transaction. Failure to do so will result in not completing the processing of your order.')) {

        handleOptions('paypal', false);
    
        var ba = $('#paypal_ba').is(':checked');
        if(ba == true) {
            var ba_extra = '&paypal_ba=1';
        }
    
        var return_data = getURL(location.href + '?ajax_payment_prepare=1&payment_option=paypal' + ba_extra);
        var returned_options = eval('(' + return_data + ')');
    
        var token = returned_options.token;    

        window.location = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" + token;

    }

}

function useBitpay() {

    var return_data = getURL(location.href + '?ajax_af_only_check=1&type=Bitcoin');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.error) {
        alert(returned_options.error);
        return false;
    }

    if(returned_options.cart_bounce) {
        window.location.href = 'shopping_cart.php';
        return false;
    }

    handleOptions('bitpay', false, ["bitpayPaymentForm"]);

    $('html,body').animate({scrollTop: $('#bitpayPaymentForm').offset().top},'slow');
    $('#bitpayButton').click();

}

function useBitcoin() {

    handleOptions('bitcoin', false);
    //alert('We are sorry, but there is currently a problem with Blockchain\'s API. We are therefore unable to process Bitcoin payments at this time. We hope they reoslve this issue shortly.');

    var return_data = getURL(location.href + '?ajax_af_only_check=1&type=Bitcoin');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.error) {
        alert(returned_options.error);
        return false;
    }

    if(returned_options.cart_bounce) {
        window.location.href = 'shopping_cart.php';
        return false;
    }

    if(returned_options.good == 1) {

        if(confirm('Please confirm our Bitcoin terms before proceeding:\n\nYou will be able to scan a QR code to process your order. After you make payment using your Bitcoin wallet, an order will automatically be generated and our system will email you a receipt. The transaction will be maked as "Processing" until we have received the requisite number of confirmations (this can sometimes take up to 1-2 hours). Our system will email you and award the account funds once we receive this confirmation.\n\nTHERE ARE ABSOLUTELY NO REFUNDS FOR BITCOIN PURCHASES.')) {

            beginProcess(bitcoinGenerateAddress);

        }

    }

}

function bitcoinGenerateAddress() {

    var return_data = getURL(location.href + '?ajax_bitcoin=1');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.error) {

        alert(returned_options.error);
        $.unblockUI();
        return false;

    } else {

        handleOptions('bitcoin', false, ["bitcoinBox"]);
        //alert(returned_options.new_address);

        var bitcoin_box_text = 'Please send <i>exactly</i> <b>' + returned_options.btc_amount + '</b> bitcoin to<br><b>' + returned_options.new_address + '</b><p></p>You can make the payment by manually entering the address above or simply scanning the QR code below with your Bitcoin wallet. Once you issue payment, your order will be automatically processed.<p></p>';
        var bitcoin_box_text = bitcoin_box_text + '<span class="highlight">If you do not send exactly ' + returned_options.btc_amount + ' (<u><i>not including</i></u> the transaction fee) then our system may automatically adjust your account funds total if you send less than what is requested.</span><p></p>';

        var qr_image = 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:' + returned_options.new_address + '?amount=' + returned_options.btc_amount + '&message=NameSilo Account Funds';

        var bitcoin_box_content = bitcoin_box_text + '<img src="' + qr_image + '">';

        //alert(bitcoin_box_content);

        $.unblockUI();

        $('#bitcoinPaymentDetails').html(bitcoin_box_content);
        $('html,body').animate({scrollTop: $('#bitcoinBox').offset().top},'slow');

        setInterval(bitcoinCheck, 7500);

    }

}

function bitcoinCheck() {

    var return_data = getURL(location.href + '?ajax_bitcoin_check=1');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.good == 1) {
        window.location.href = 'blockchain_handler.php';
    }

}

function useDwolla() {

    if ($('#dwolla_customer_number').val() == '') {

        alert('You must enter your Dwolla customer number in the provided field.');

    } else {        
    
        if(confirm('Please confirm our Dwolla terms before proceeding:\n\nAfter completing your order on the Dwolla site, you must return to our site in order to complete your transaction. Failure to do so will result in not completing the processing of your order.\n\nFAILURE TO INCLUDE YOUR CORRECT CUSTOMER ID NUMBER WILL RESULT IN IMMEDIATE CANCELLATION OF YOUR ORDER AND YOU WILL BE SUBJECT TO ANY TRANSACTION FEES.')) {

            var return_data = getURL(location.href + '?ajax_payment_prepare=1&payment_option=dwolla&cid=' + $('#dwolla_customer_number').val());

            var returned_options = eval('(' + return_data + ')');
        
            if(returned_options.force_to_cart) {
        
                window.location = '/shopping_cart.php';
                return false;
        
            } else if(returned_options.error) {
        
                alert(returned_options.error);
                return false;
        
            } else {
        
                handleOptions('dwolla', false);
                var url = returned_options.redirect;
                //alert(url);
                window.location = url;
        
            }                
        
        }

    }

}

function dwollaCheck() {

    var return_data = getURL(location.href + '?ajax_ipn_check=1&payment_check=dwolla');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.good == 1) {
        nsToggleVisibility('submitButtonField', 'show');
    }

}

function useAlipay() {

    
        if ($('#alipay_email_address').val() == '') {

            alert('You must enter your AliPay email address in the provided field.');

        } else if(!stored_regex('email').test($('#alipay_email_address').val())) {
            
            alert('The email address you entered is not valid.');

        } else {

            var return_data = getURL(location.href + '?ajax_payment_prepare=1&payment_option=alipay' + '&cem=' + $('#alipay_email_address').val());

            var returned_options = eval('(' + return_data + ')');
            
            if(returned_options.force_to_cart) {
            
                window.location = '/shopping_cart.php';
                return false;
            
            } else if(returned_options.error) {
            
                alert(returned_options.error);
                return false;
            
            } else {
            
                handleOptions('alipay', false);
                var url = returned_options.redirect;
                //alert(url);
                window.location = url;
            
            }
    
        }

    
}

function alipayCheck() {

    var return_data = getURL(location.href + '?ajax_ipn_check=1&payment_check=alipay');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.good == 1) {
        nsToggleVisibility('submitButtonField', 'show');
    }

}

function useAlertPay() {

    if ($('#alertpay_email').val() == '') {

        alert('You must enter your Payza customer email address in the provided field.');

    } else {

        alert('****** PAYZA PROBLEM ******\n\nPayza is not working again in the United States.');

        /*    
            if(confirm('******************* PAYZA TERMS **********************\n\nPlease confirm our Payza terms before proceeding:\n\nAfter completing your order on the Payza site, you must click the link on the Payza site to return to our site in order to complete your transaction. Failure to do so will result in not completing the processing of your order.\n\nFAILURE TO INCLUDE YOUR CORRECT PAYZA CUSTOMER EMAIL ADDRESS WILL RESULT IN IMMEDIATE CANCELLATION OF YOUR ORDER AND YOU WILL BE SUBJECT TO ANY TRANSACTION FEES.')) {
        
                var fields_to_hide = ["accountFundsBox", "bitcoinBox", "finalizeOrder"];
        
                handleOptions('alert_pay', fields_to_hide, '');
        
                var return_data = getURL(location.href + '?ajax_alert_pay=1&em=' + $('#alertpay_email').val());
                var returned_options = eval('(' + return_data + ')');

                if(returned_options.force_to_cart) {

                    window.location = '/shopping_cart.php';
                    return false;

                } else {
            
                    window.location = returned_options.url;

                }
            
            }
    
        */

    }

}

function alertPayCheck() {

    var return_data = getURL(location.href + '?ajax_ipn_check=1&payment_check=alert_pay');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.good == 1) {
        nsToggleVisibility('submitButtonField', 'show');
    }

}

function useMoneybookers() {

    if ($('#moneybookers_customer_number').val() == '') {

        alert('You must enter your Skrill customer ID number in the provided field.');

    
    } else {
    
        if(confirm('Please confirm our Skrill terms before proceeding:\n\nAfter completing your order on the Skrill site, you must return to our site in order to complete your transaction. Failure to do so will result in not completing the processing of your order.\n\nFAILURE TO INCLUDE YOUR CORRECT CUSTOMER ID NUMBER WILL RESULT IN IMMEDIATE CANCELLATION OF YOUR ORDER AND YOU WILL BE SUBJECT TO ANY TRANSACTION FEES.')) {

            var return_data = getURL(location.href + '?ajax_payment_prepare=1&payment_option=moneybookers&cid=' + $('#moneybookers_customer_number').val());

            var returned_options = eval('(' + return_data + ')');

            if(returned_options.force_to_cart) {

                window.location = '/shopping_cart.php';
                return false;

            } else if(returned_options.error) {

                alert(returned_options.error);
                return false;

            } else {

                handleOptions('moneybookers', false);
                var url = returned_options.base_url + '?sid=' + returned_options.token;
                window.location = url;

            }                
        
        }

    }

}

function moneybookersCheck() {

    var return_data = getURL(location.href + '?ajax_ipn_check=1&payment_check=moneybookers');
    var returned_options = eval('(' + return_data + ')');

    if(returned_options.good == 1) {
        nsToggleVisibility('submitButtonField', 'show');
    }

}

function useBraintreeCCPayment(){
    handleOptions('braintree_card', true, ["braintreeCCPaymentForm"]);
    $('html,body').animate({scrollTop: $('#braintreeCCPaymentForm').offset().top},'slow');
}

function useBraintreePaypalPayment(){
    handleOptions('braintree_paypal', false, ["braintreePaypalPaymentForm"]);
    $('html,body').animate({scrollTop: $('#braintreePaypalPaymentForm').offset().top},'slow');
}

function useBraintreeGooglePayPayment() {
    handleOptions('braintree_googlepay', false, ["braintreeGooglePayPaymentForm"]);
    $('html,body').animate({scrollTop: $('#braintreeGooglePayPaymentForm').offset().top},'slow');
}

function useBraintreeApplePayPayment(){
    handleOptions('braintree_applepay', false, ["braintreeApplePayPaymentForm"]);
    $('html,body').animate({scrollTop: $('#braintreeApplePayPaymentForm').offset().top},'slow');
}

function useBraintreeVenmoPayment(){
    handleOptions('braintree_venmo', false, ["braintreeVenmoPaymentForm"]);
    $('html,body').animate({scrollTop: $('#braintreeVenmoPaymentForm').offset().top},'slow');
}

function useYuansferWeChatPayment(){
    handleOptions('yuansfer_wechat', false, ["yuansferWeChatPaymentForm"]);
    $('html,body').animate({scrollTop: $('#yuansferWeChatPaymentForm').offset().top},'slow');
}

function payWithBitpay(evt) {
    evt.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/bitpay/api/request',
        dataType: 'JSON',
        data: { amount: 10.79}
    }).done(function (data) {
        $('#bitpayId').val(data.data.id);
                bitpay.showInvoice(data.data.id);
    });
}

function payWithYuansferWeChat(evt){
    evt.preventDefault();

    // automatically accept terms and conditions
    $('#approve_terms').prop("checked", true);

    // replace button with "in progress"
    $('#yuansferWeChatButtonContainer').html('<div id="formProcessingText">We are processing your order...</div>');

    // get redirect url
    $.ajax({
        type: 'GET',
        url: '/billing.php?ajax_payment_prepare=1&payment_option=wechat',
        dataType: 'JSON'
    }).done(function (data) {
        if (data.redirect){
            window.location.href = data.redirect;
        }else if (data.error) {
            $('#yuansferWeChatButtonContainer').html('<a href="/"  id="yuansferWeChatButton" role="link" lang="us" title="Pay with WeChat" onclick="payWithYuansferWeChat(event)"><img src="/images/payment_options_wechat.png"/></a>');
            alert(data.error);
        }
    });
}

function disableBraintree() {
    $('#braintreeOptionCard').attr('disabled', true);
    $('#paymentCCFieldImage label img').css('filter', 'grayscale(100%)').css('opacity', '0.5');

    $('#braintreeOptionPaypal').attr('disabled', true);
    $('#paymentPPFieldImage label img').css('filter', 'grayscale(100%)').css('opacity', '0.5');;

    $('#paymentOptionsNote').html('<br><span style="color:red">Payment methods for Credit Cards and PayPal are not currently functioning. Try another payment method or try to refresh in 5 minutes</span>');

    $('#standardForm').find('.preloader').hide();
}

function initBraintreeForms() {
    var form = $('#standardForm');
    var preloader = form.find('.preloader');
    var paymentMethodsOptions = form.find('input[name=payment_option]');
    var deviceData = $('#deviceData');
    var cardholderName = $('#cardholderName');
    var postalCode = $('#postal-code');
    var city = $('#city');
    var inputPaymentMethodNonce = $('#inputPaymentMethodNonce');

    if (typeof window.braintree == 'undefined'
        || typeof window.braintree.dataCollector == 'undefined'
        || typeof window.braintree.hostedFields == 'undefined'
        || typeof window.braintree.paypalCheckout == 'undefined'
        || typeof window.braintree.applePay == 'undefined'
        || typeof window.braintree.googlePayment == 'undefined'
        || typeof window.braintree.venmo == 'undefined'
    ) {
        console.log('unable to load braintree SDK libraries')
        disableBraintree()
        return;
    }

    // get client token and init hosted fields form
   preloader.show();

   setTimeout(function(){
       if(window.braintreeLoaded === false) {
           disableBraintree();
       }
    }, 30000);


    $.ajax({ 
        type: 'GET',
        url: '/account/api/braintree/keys',
        timeout: 20000,
        dataType: 'JSON' 
    }).done(function (data) { 
        createBraintreeClient(data); 
    }).fail(function (data) {
        disableBraintree();
    });

    function createBraintreeClient(key){
        braintree.client.create(
            { authorization: key },
            function(clientErr, clientInstance){
                if (clientErr) {
                    console.error(clientErr);
                    return;
                }

                createDataCollectorInstance(clientInstance);
            }
        );
    }

    function createDataCollectorInstance(clientInstance){
        braintree.dataCollector.create(
            { client: clientInstance, kount: true },
            function (error, dataCollector){
                if (error == null){
                    deviceData.val(dataCollector.deviceData);
                }

                createBraintreeHostedFields(clientInstance);
                createBraintreePaypalButton(clientInstance);
                createBraintreeApplePayButton(clientInstance);

                
                createBraintreeVenmoButton(clientInstance);
            }
        )
    }

    function createBraintreeHostedFields(clientInstance){
        braintree.hostedFields.create(
            {
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '14px'
                    },
                    'input.invalid': {
                        'color': 'red'
                    },
                    'input.valid': {
                        'color': 'green'
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        placeholder: 'Enter the card number'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: 'CVV2 Code'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: 'Enter expiration date'
                    }
                }
            }, initBraintreeHostedFields);
    }

    function initBraintreeHostedFields(hostedFieldsErr, hostedFieldsInstance){
        if (hostedFieldsErr) {
            Sentry.captureException(hostedFieldsErr);
            console.error(hostedFieldsErr);
            return;
        }

        $('#submitButton').on('click', function(e){ return processBraintreeHostedFields(e, hostedFieldsInstance); });
        window.braintreeLoaded = true;
        preloader.hide();                        
    }

    function processBraintreeHostedFields(evt, hostedFieldsInstance){

        if ($('#braintreeCCPaymentForm').is(':visible')) {
            // we will process the form manually, do not submit
            evt.preventDefault();
            evt.stopPropagation();

            // verify full form
            if (!validateBraintreeHostedFields(hostedFieldsInstance)){
                return false;
            }

            // all is okay - tokenize the card
            hostedFieldsInstance.tokenize({
                cardholderName: cardholderName.val()
            }, function (tokenizeErr, payload) {
                if (tokenizeErr) {
                    console.error(tokenizeErr);
                    return;
                }

                // fill the nonce field and submit the form
                inputPaymentMethodNonce.val(payload.nonce);
                //console.log(payload.nonce);
                form.submit();
            });
            return false;
        }

        // not our case - continue event chain
        return true;
    }

    function validateBraintreeHostedFields(hostedFieldsInstance){
        var fieldNameMap = {
            cvv: 'CVV',
            number: 'Card Number',
            expirationDate: 'Expiration Date'
        };

        var errors = [];
        
        // check new payment form fields
        var state = hostedFieldsInstance.getState();
        for (var fieldName in state.fields) {
            if (state.fields.hasOwnProperty(fieldName) && !state.fields[fieldName].isValid) {
                errors[errors.length] = fieldNameMap[fieldName] + ' is required';
            }
        }

        if (cardholderName.val().trim().length === 0) {
            errors.push('Cardholder name is required');
        }

        if (city.val().trim().length === 0) {
            errors.push('City is required');
        }

        if (postalCode.val().trim().length === 0) {
            errors.push('Postal code is required');
        } 

        return displayIfErrors(errors);
    }

    function displayIfErrors(errors){        
        if (errors.length > 0){
            errors.unshift('The following problems were detected with the information you submitted:\n');
            errors.push('\nPlease make the appropriate changes and resubmit.');
            alert(errors.join('\n'));
        }

        return errors.length == 0;
    }

    function createBraintreePaypalButton(clientInstance){
        braintree.paypalCheckout.create(
            { client: clientInstance },
            function (paypalCheckoutErr, paypalCheckoutInstance) {
                if (paypalCheckoutErr) {
                    Sentry.captureException(paypalCheckoutErr);
                    console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
                    return;
                }

                // Set up PayPal with the checkout.js library
                var paypalPaymentOptions = {
                    flow: 'checkout', // Required
                    amount:  paypalAmount, // Required
                    currency: 'USD', // Required
                    intent: 'capture'
                }
                paypal.Button.render({
                        env: 'production', // or 'sandbox'
                        payment: function () {
                            return paypalCheckoutInstance.createPayment(paypalPaymentOptions);
                        },
                        onAuthorize: function (data, actions) {
                            return paypalCheckoutInstance.tokenizePayment(data, function (tokenizeErr, payload) {
                                if (tokenizeErr) {
                                    console.error(tokenizeErr);
                                    return;
                                }

                                // fill the nonce field and submit the form
                                inputPaymentMethodNonce.val(payload.nonce);

                                // automatically accept terms and conditions
                                $('#approve_terms').prop("checked", true);

                                // replace button with "in progress"
                                $('#braintreePaypalButton').html('<div id="formProcessingText">We are processing your order...</div>');

                                // submit our form
                                //console.log(payload.nonce);
                                form.submit();
                            });
                        },
                        onCancel: function (data) {
                            console.log('paypal checkout.js payment cancelled', JSON.stringify(data, 0, 2));
                        },
                        onError: function (err) {
                            Sentry.captureException(JSON.stringify({code: err.code, message: err.message, paypalPaymentOptions: paypalPaymentOptions}));
                            console.error('paypal checkout.js error', err);
                            $('#braintreePaypalButton').html('Error occured during the checkout process.<br/>Please reload the page and try again.<br/>If the problem persists, contact support.')
                        }
                    },
                    '#braintreePaypalButton'
                ).then(function () {
                    // The PayPal button will be rendered in an html element with the id
                    // `paypal-button`. This function will be called when the PayPal button
                    // is set up and ready to be used.
                    // console.log('Paypal button rendered');
                });
            }
        );
    }

    function createBraintreeApplePayButton(clientInstance){
        //if (!window.ApplePaySession || !ApplePaySession.supportsVersion(3) || !ApplePaySession.canMakePayments()){
        if (!window.ApplePaySession || !ApplePaySession.supportsVersion(3)){
            // apple pay is not supported
            return;
        }

        braintree.applePay.create(
            {client: clientInstance},
            function(applePayErr, applePayInstance){
                if (applePayErr){
                    console.error('Error creating ApplePay button: ', applePayErr);
                    return;
                }

                // display apple pay option
                $('#applePayMethodSelectionRow').show();

                $('#braintreeApplePayButton').click( function(evt){
                    // setup apple pay session and button button
                    var paymentRequest = applePayInstance.createPaymentRequest({
                        total: {
                            label: 'NameSilo.com LLC',
                            amount: '10.79'
                        }
                        //,requiredBillingcontatFields:["postalAddress]
                    });

                    var session = new ApplePaySession(3, paymentRequest);
                    session.onvalidatemerchant = function(event){
                        applePayInstance.performValidation({
                            validationURL: event.validationURL,
                            displayName: 'NameSilo.com LLC'
                        }, function(err, merchantSession){
                            if (err){
                                alert('Apple Pay failed to load');
                                return;
                            }
                            session.completeMerchantValidation(merchantSession);
                        });
                    };

                    session.onpaymentauthorized = function(event){
                        applePayInstance.tokenize({
                            token: event.payment.token
                        }, function(tokenizeErr, payload){
                            if (tokenizeErr){
                                console.error('Error tokenizing Apple Pay: ', tokenizeErr);
                                return;
                            }                                               

                            // fill the nonce field and submit the form
                            inputPaymentMethodNonce.val(payload.nonce);

                            // automatically accept terms and conditions
                            $('#approve_terms').prop("checked", true);

                            // replace button with "in progress"
                            $('#braintreeApplePayButton').html('<div id="formProcessingText">We are processing your order...</div>');

                            session.completePayment(ApplePaySession.STATUS_SUCCESS);
                            
                            // submit our form
                            form.submit();                       
                        });
                    };

                    session.begin();
                });

                
            }
        );

    }

    
    function createBraintreeVenmoButton(clientInstance) {
        braintree.venmo.create(
            {client: clientInstance},
            function (venmoErr, venmoInstance) {
                if (venmoErr) {
                    console.error('Error creating Venmo:', venmoErr);
                    return;
                }

                if (!venmoInstance.isBrowserSupported()) {
                    console.log('Browser does not support Venmo');
                    return;
                }

                $('#venmoMethodSelectionRow').show();

                $('#braintreeVenmoButton').click( function(evt){
                    evt.preventDefault();
                    evt.stopPropagation();

                    venmoInstance.tokenize(function(tokenizeErr, payload){
                        if (tokenizeErr) {
                            if (tokenizeErr.code === 'VENMO_CANCELED') {
                                alert('App is not available or user aborted payment flow');
                            } else if (tokenizeErr.code === 'VENMO_APP_CANCELED') {
                                alert('User canceled payment flow');
                            } else {
                                alert('An error occurred: ' + tokenizeErr.message);
                            }
                            return;
                        }

                        // fill the nonce field and submit the form
                        inputPaymentMethodNonce.val(payload.nonce);

                        // automatically accept terms and conditions
                        $('#approve_terms').prop("checked", true);

                        // replace button with "in progress"
                        $('#braintreeVenmoButton').html('<div id="formProcessingText">We are processing your order...</div>');

                        // submit our form
                        form.submit();
                    });

                    return false;
                });
            }
        );
    }
}


var decodeEntities = (function() {
  // this prevents any overhead from creating the object each time
  var element = document.createElement('div');

  function decodeHTMLEntities (str) {
    if(str && typeof str === 'string') {
      // strip script/html tags
      str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
      str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
      element.innerHTML = str;
      str = element.textContent;
      element.textContent = '';
    }

    return str;
  }

  return decodeHTMLEntities;
})();

$(document).ready(function(){

    if (typeof window.paypal == 'undefined') {
        window.onloadErrors.push(['paypal', 'missing paypal object'])
        $('#braintreePaypalButton').html('Unable to load PayPal')
    }

    if (window.onloadErrors.length > 0) {
        Sentry.captureException(window.onloadErrors);
    }

    nsToggleVisibility('expandNewPayment', 'hide');
    nsToggleVisibility('accountFundsBox', 'hide');
    nsToggleVisibility('bitpayPaymentForm', 'hide');
    nsToggleVisibility('braintreeCCPaymentForm', 'hide');
    nsToggleVisibility('braintreePaypalPaymentForm', 'hide');
    nsToggleVisibility('braintreeGooglePayPaymentForm', 'hide');
    nsToggleVisibility('braintreeApplePayPaymentForm', 'hide');
    nsToggleVisibility('braintreeVenmoPaymentForm', 'hide');
    nsToggleVisibility('yuansferWeChatPaymentForm', 'hide');
    nsToggleVisibility('bitcoinBox', 'hide');
    nsToggleVisibility('finalizeOrder', 'hide');

    
    
    
    
    
    
    
    
    
    
    window.braintreeLoaded = false;
    initBraintreeForms();

});

$(document).keypress(function(e) { 
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
    if(key == 13) {
        e.preventDefault();
    } 
});


var paypalAmount = '10.79';

</SCRIPT>

<script type="application/javascript">
    window.addEventListener('message', function(event) {
        if (event.origin == 'https://api.paymentwall.com') {
            processPaymentWallEvent(event);
            return;
        }
        if (event.origin == 'https://test.bitpay.com' || event.origin == 'https://bitpay.com') {
            processBitpayEvent(event);
            return;
        }
        console.log(event);
    },false);

    function processBitpayEvent(event) {
        payment_status = event.data.status;
        if (payment_status == "paid") {
            window.location.href = '/bitpay_success_handler.php';
            return;

            handleOptions('bitpay', true, ["bitpayPaymentForm"]);
            $('#approve_terms').prop("checked", true);
            $('#submitButton').click();
        }
    }

    function processPaymentWallEvent(event) {
        var eventData = JSON.parse(event.data);
        console.log(eventData);
        if (eventData.event == 'paymentSuccess') {
            window.location.href = '/payment_wall_handler.php';
        }
        if (eventData.event != 'externalPaymentMethodToggle') {
            return;
        }
        $('#paymentWallData').val(event.data);
        switch (eventData.data.paymentMethodName) {
            case 'NameSilo Account Funds':
                useAccountFunds();
                $('#approve_terms').prop("checked", true);
                $('#submitButton').click();
                break;
            case 'AliPay':
                $('html,body').animate({scrollTop: $('#paymentAlipayRadio').offset().top},'slow');
                $('input[name="payment_option"][value="alipay"]').click();
                break;
            case 'Bitpay':
                $('html,body').animate({scrollTop: $('#paymentBitpayRadio').offset().top},'slow');
                $('input[name="payment_option"][value="bitpay"]').click();
                break;
            case 'Paypal':
                paypalAmount = eventData.data.paymentSummary.total.amount_decimal;
                $('html,body').animate({scrollTop: $('#braintreeOptionPaypal').offset().top},'slow');
                $('input[name="payment_option"][value="braintree_paypal"]').click();
                break;
            case 'WeChat Pay':
                $('html,body').animate({scrollTop: $('#paymentWeChatFieldRadio').offset().top},'slow');
                $('input[name="payment_option"][value="yuansfer_wechat"]').click();
                break;
        }
    }
</script>

<STYLE>

    .payment_method_subsection {
        width:440px;
        border:2px dotted #CCC;
        padding:3px;
    }

    #standardForm {
        position: relative;
    }

    .preloader .loader__img {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
        width: 64px;
        height: 64px;
        opacity: .5;
    }

    .preloader {
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: rgba(255, 255, 255, .5);
    }

    .hosted-field {
        height: 50px;
        box-sizing: border-box;
        width: 100%;
        padding: 12px;
        display: inline-block;
        box-shadow: none;
        font-weight: 600;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #dddddd;
        line-height: 20px;
        background: #fcfcfc;
        margin-bottom: 12px;
        background: linear-gradient(to right, white 50%, #fcfcfc 50%);
        background-size: 200% 100%;
        background-position: right bottom;
        transition: all 300ms ease-in-out;
    }

    .hosted-field--input {
        font-size: 14px!important;
        margin: 0!important;
        padding: 0!important;
        width: 100%!important;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border: none!important;
        background-color: transparent!important;
    }

    .hosted-field--input:focus {
        outline: 0;
    }
    
    .hosted-field--label {
        font-family: courier, monospace;
        text-transform: uppercase;
        font-size: 14px;
        display: block;
        margin-bottom: 6px;
    }

    @supports (-webkit-appearance: -apple-pay-button) { 
        .apple-pay-button {
            display: inline-block;
            -webkit-appearance: -apple-pay-button;
        }
        .apple-pay-button-black {
            -apple-pay-button-style: black;
        }
        .apple-pay-button-white {
            -apple-pay-button-style: white;
        }
        .apple-pay-button-white-with-line {
            -apple-pay-button-style: white-outline;
        }
    }

    #wrapper { width: 1070px; }
    #outerContainerTop, #outerContainerBottom {display: none; }
    #innerContentContainer { width: 1050px; padding: 8px 10px; border-radius: 11px; }
    #innerContentContainerContent { width: 1049px; }
    #innerContentContainerLeft { width: 780px; }

</STYLE>

</HEAD>
<BODY>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNKQPHH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<DIV ID="wrapper">

    <DIV ID="topLogoNav">
    
        <DIV ID="logoCell">
        
            <A HREF="/"><IMG SRC="/images/logo_main.gif" CLASS="topLogo" ALT="Cheapest everyday domain prices on the web, easy processes and enhanced security on all domains"></A>
            
        </DIV>

        <DIV ID="navCell">
        
            <DIV ID="textLinks">

                <A HREF="/shopping_cart.php">My Cart <SPAN ID="cartItemsHeader">(1)</SPAN></A> |
            
                                    
                    <A HREF="/account_home.php">My Account</A> |

                                    
                
                <A HREF="/account_domains.php">Manage My Domains</A>

                                    | <A HREF="/logout.php" ONCLICK="return confirm('Are you sure you want to log out? You will lose any items in your shopping cart upon logging out.');">Log Out</A>
                
                                    <DIV STYLE="padding:5px 5px 0 0;">
                        Logged in as superbem                                            </DIV>
                                
            </DIV>

            <DIV ID="navTabs">

                <!-- <DIV CLASS="left">&nbsp;</DIV> -->

                <DIV CLASS="right">
            
                    <UL CLASS="topTabs">
                        <LI ><A HREF="/"><SPAN>home</SPAN></A></LI>
                        <LI ><A HREF="/domain/search-domains"><SPAN>register</SPAN></A></LI><!-- https://new.namesilo.com/domain-search?beta=1 -->
                        <LI ><A HREF="/domain/transfer-domains"><SPAN>transfer</SPAN></A></LI> <!-- https://new.namesilo.com/domain-transfer -->
                        <LI ><A HREF="/hosting"><SPAN>hosting</SPAN></A></LI>
                        <LI ><A HREF="/Marketplace"><SPAN>marketplace</SPAN></A></LI><!-- https://new.namesilo.com/marketplace?beta=1-->
                        <LI ><A HREF="/pricing"><SPAN>pricing</SPAN></A></LI>
                        <LI ><A HREF="/api-reference"><SPAN>API</SPAN></A></LI>
                        <LI ><A HREF="/why_us.php"><SPAN>why us?</SPAN></A></LI>
                        <LI ><A HREF="/support/v2"><SPAN>support</SPAN></A></LI>
                    </UL>

                </DIV>

                <DIV CLASS="clear"></DIV>    

            </DIV>
            
        </DIV>

        <DIV CLASS="clear"></DIV>
        
    </DIV>

    <DIV ID="outerContainerTop"></DIV>

    <DIV ID="innerContentContainer">        
    
        <DIV ID="innerContentContainerPush"></DIV>        

        <DIV ID="innerContentContainerContent">

            
            <DIV ID="innerContentContainerLeft">



<div id="detailBox">
    <div class="header"><span class="highlight">New Payment</span></div>
    <div class="content">
        <iframe src="https://api.paymentwall.com/api/subscription?key=c1072f66fcea316f05b749776df365c2&uid=364503&widget=pw_1&amount=10.79&currencyCode=USD&ag_name=Total&ag_external_id=id%3Acc0d00f49fc217dfeba622005faf0bb2&ag_type=fixed&sign_version=3&tax_id=&email=danielchanfana%40gmail.com&history%5Bregistration_date%5D=1577208362&ps=all&user_cart=%7B%22items%22%3A%5B%7B%22item_name%22%3A%22vivision.org%22%2C%22quantity%22%3A1%2C%22price%22%3A%2210.79%22%2C%22subtotal%22%3A10.79%7D%5D%2C%22discount%22%3A0%2C%22subtotal%22%3A10.79%2C%22total%22%3A10.79%7D&uniqueOrderId=cc0d00f49fc217dfeba622005faf0bb2&affiliate=&calculate_tax=1&disable_external_payment_systems%5B0%5D=bitpay&session=3d2cdd398cdd10505a9fc3fc403ca94d&sign=13d9c2525fadfd3fe1dfaf00d101c11529694230b6f648ef0fea09e661296ab5"
                width="" height="" style="width:100%;height:100%;min-width:680px;min-height:1280px;" frameborder="0"></iframe>
    </div>
</div>

<p></p>

<FORM METHOD="post" onSubmit="return validate(this)" ID="standardForm">
    <div class="preloader">
        <div class="loader__img">
            <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M78.75 16.18V1.56a64.1 64.1 0 0 1 47.7 47.7H111.8a49.98 49.98 0 0 0-33.07-33.08zM16.43 49.25H1.8a64.1 64.1 0 0 1 47.7-47.7V16.2a49.98 49.98 0 0 0-33.07 33.07zm33.07 62.32v14.62A64.1 64.1 0 0 1 1.8 78.5h14.63a49.98 49.98 0 0 0 33.07 33.07zm62.32-33.07h14.62a64.1 64.1 0 0 1-47.7 47.7v-14.63a49.98 49.98 0 0 0 33.08-33.07z" fill="#223f9a" fill-opacity="1"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="-90 64 64" dur="400ms" repeatCount="indefinite"></animateTransform></g></svg>
        </div>
    </div>

    <SCRIPT TYPE="text/javascript">
        document.write(unescape('%3Cinput%20type%3D%22hidden%22%20name%3D%22trigger%22%20value%3D%221%22%3E'));
    </SCRIPT>

    <input type="hidden" name="device_data" id="deviceData" value="" />
    <input type="hidden" name="payment_method_nonce" id="inputPaymentMethodNonce" value="" />
    <input type="hidden" name="payment_wall_data" id="paymentWallData" value="" />

    <DIV ID="detailBox">
        <DIV CLASS="header"><SPAN CLASS="highlight">New Payment Options</SPAN></DIV>
        <DIV CLASS="content">
                            Please select how you would like to pay for this order:
            
            <div id="paymentOptionsNote"></div>

            <TABLE STYLE="margin-top:7px;">

                


                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentCCFieldRadio">
                            <INPUT NAME="payment_option" value="braintree_card" id="braintreeOptionCard" TYPE="radio" CLASS="formClear" onClick="useBraintreeCCPayment();">
                        </TD>
                        <TD STYLE="" ID="paymentCCFieldImage" COLSPAN="2">
                            <label for="braintreeOptionCard">
                                <IMG SRC="/images/payment_options_credit_cards.gif">
                            </label>
                        </TD>
                    </TR>
                    <TR>
                        <TD STYLE="width:20px;" ID="paymentPPFieldRadio">
                            <INPUT NAME="payment_option" value="braintree_paypal" id="braintreeOptionPaypal" TYPE="radio" CLASS="formClear" onClick="useBraintreePaypalPayment();">
                        </TD>
                        <TD STYLE="" ID="paymentPPFieldImage" COLSPAN="2">
                            <label for="braintreeOptionPaypal">
                                <IMG SRC="/images/payment_options_paypal.gif">
                            </label>
                        </TD>
                    </TR>

                    
                    <TR ID="applePayMethodSelectionRow" style="display: none;">
                        <TD STYLE="width:20px;" ID="paymentAPFieldRadio">
                            <INPUT NAME="payment_option" value="braintree_applepay" id="braintreeOptionApplePay" TYPE="radio" CLASS="formClear" onClick="useBraintreeApplePayPayment();">
                        </TD>
                        <TD STYLE="" ID="paymentAPFieldImage" COLSPAN="2">
                            <label for="braintreeOptionApplePay">
                                <IMG SRC="/images/payment_options_applepay.png">
                            </label>
                        </TD>
                    </TR>
                    <TR ID="venmoMethodSelectionRow" style="display: none;">
                        <TD STYLE="width:20px;" ID="paymentVenmoFieldRadio">
                            <INPUT NAME="payment_option" value="braintree_venmo" id="braintreeOptionVenmo" TYPE="radio" CLASS="formClear" onClick="useBraintreeVenmoPayment();">
                        </TD>
                        <TD STYLE="" ID="paymentVenmoFieldImage" COLSPAN="2">
                            <label for="braintreeOptionVenmo">
                                <IMG SRC="/images/payment_options_venmo.png">
                            </label>
                        </TD>
                    </TR>


                
                                    <TR ID="wechatMethodSelectionRow">
                        <TD STYLE="width:20px;" ID="paymentWeChatFieldRadio">
                            <INPUT NAME="payment_option" value="yuansfer_wechat" id="yuansferOptionWeChat" TYPE="radio" CLASS="formClear" onClick="useYuansferWeChatPayment();">
                        </TD>
                        <TD STYLE="" ID="paymentWeChatFieldImage" COLSPAN="2">
                            <label for="yuansferOptionWeChat">
                                <IMG SRC="/images/payment_options_wechat.png">
                            </label>
                        </TD>
                    </TR>
                
                
                    <TR>
                        <TD STYLE="width:20px;" ID="paymentAccountFundsRadio">
                            <INPUT TYPE="radio" NAME="payment_option" VALUE="account_funds" CLASS="formClear js-account-funds-option" ID="payment_option_account_funds" onClick="useAccountFunds();" >
                        </TD>
                        <TD STYLE="" ID="paymentAccountFundsImage" COLSPAN="2">
                            <label for="payment_option_account_funds"><IMG SRC="/images/payment_options_account_funds.gif"></label>
                        </TD>
                    </TR>
                
                                    <TR style="display: none !important;">
                        <TD STYLE="width:20px;" ID="payPalRadio"><INPUT TYPE="radio" NAME="payment_option" VALUE="paypal" CLASS="formClear" ID="payment_option_paypal" onClick="paypalSetExpress();" ></TD>
                        <TD STYLE="" ID="payPalField" data-load-message="Connecting to PayPal..."><A HREF="javascript:;" onClick="paypalSetExpress();"><IMG SRC="/images/payment_options_paypal.gif" ID="paypal_button" STYLE="margin:5px 0 10px 0;"></A></TD>
                        <TD ID="paypal_ba_field">
                                                            <DIV CLASS="payment_method_subsection">
                                    <INPUT TYPE="checkbox" NAME="paypal_ba" ID="paypal_ba" VALUE="1" CLASS="formClear" checked>
                                    <SMALL>
                                        <LABEL FOR="paypal_ba">
                                        Check this box to create a PayPal billing agreement with us in order to use your PayPal account for 
                                        automatic renewals. This requires a linked bank account or credit card so don't check this if you do 
                                        not have either. You can cancel at any time within your PayPal account.
                                        </LABEL>
                                    </SMALL>
                                </DIV>
                                                    </TD>
                    </TR>
                
                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentBitcoinRadio"><INPUT TYPE="radio" NAME="payment_option" VALUE="bitcoin" CLASS="formClear" ID="payment_option_bitcoin" onClick="useBitcoin();" ></TD>
                        <TD STYLE="" ID="paymentBitcoinImage">
                            <label for="payment_option_bitcoin"><IMG SRC="/images/payment_options_bitcoin.gif" ID="bitcoin_button"></label></TD>
                    </TR>
                
                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentBitpayRadio"><INPUT TYPE="radio" NAME="payment_option" VALUE="bitpay" CLASS="formClear" ID="payment_option_bitpay" onClick="useBitpay();" ></TD>
                        <TD STYLE="" ID="paymentBitpayImage">
                            <label for="payment_option_bitpay"><IMG SRC="/images/payment_options_bitpay.svg " ID="bitpay_button"></label></TD>
                    </TR>
                
                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentMoneybookersRadio"><INPUT TYPE="radio" NAME="payment_option" VALUE="moneybookers" CLASS="formClear" ID="payment_option_moneybookers" onClick="useMoneybookers();" ></TD>
                        <TD STYLE="" ID="paymentMoneybookersImage" data-load-message="Connecting to Skrill...">
                            <label for="payment_option_moneybookers"><IMG SRC="/images/moneybookers.gif" ID="moneybookers_button"></label>
                        </TD>
                        <TD ID="moneybookers_field">
                            <DIV CLASS="payment_method_subsection">
                                <SMALL>Please provide your Skrill customer ID number in the field below.
                                <BR>
                                <A HREF="/images/moneybookers_popup.gif" REL="shadowbox;height=160;width=720" TITLE="Locate your Customer ID Number">Click here</A> if you do not know how to get your customer ID number.</SMALL>
                                <DIV STYLE="float:left;width:230px;padding-top:5px;">
                                    <INPUT TYPE="text" ID="moneybookers_customer_number" NAME="moneybookers_customer_number" STYLE="width:220px;" VALUE="">
                                </DIV>
                                <DIV STYLE="float:right;width:210px;padding-top:5px;">
                                    <A HREF="javascript:;" onClick="useMoneybookers();"><IMG SRC="/images/button_go.gif"></A>                                </DIV>
                                <DIV CLASS="clear"></DIV>                            
                                                            </DIV>
                        </TD>
                    </TR>
                
                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentDwollaRadio">
                            <INPUT TYPE="radio" NAME="payment_option" VALUE="dwolla" CLASS="formClear" ID="payment_option_dwolla" onClick="useDwolla();" ></TD>
                        <TD STYLE="" ID="paymentDwollaImage" data-load-message="Connecting to Dwolla...">
                            <label for="payment_option_dwolla"><IMG SRC="/images/payment_options_dwolla.gif" ID="dwolla_button"></label></TD>
                        <TD ID="dwolla_field">
                            <DIV CLASS="payment_method_subsection">
                                <SMALL>Please provide your Dwolla customer number in the field below.
                                <BR>
                                <A HREF="/images/dwolla_popup.gif" REL="shadowbox;height=95;width=720" TITLE="Locate your Dwolla ID Number">Click here</A> if you do not know how to get your customer number.</SMALL>
                                <DIV STYLE="float:left;width:230px;padding-top:5px;">
                                    <INPUT TYPE="text" ID="dwolla_customer_number" NAME="dwolla_customer_number" STYLE="width:220px;" VALUE="">
                                </DIV>
                                <DIV STYLE="float:right;width:210px;padding-top:5px;">
                                    <A HREF="javascript:;" onClick="useDwolla();"><IMG SRC="/images/button_go.gif"></A>
                                </DIV>
                                <DIV CLASS="clear"></DIV>
                            </DIV>
                        </TD>
                    </TR>
                
                                    <TR>
                        <TD STYLE="width:20px;" ID="paymentAlipayRadio"><INPUT TYPE="radio" NAME="payment_option" VALUE="alipay" CLASS="formClear" ID="payment_option_alipay" onClick="useAlipay();" ></TD>
                        <TD STYLE="" ID="paymentAlipayImage" data-load-message="Connecting to AliPay...">
                            <label for="payment_option_alipay"><IMG SRC="/images/payment_options_alipay.gif" ID="alipay_button"></label></TD>
                        <TD ID="alipay_field">
                            <DIV CLASS="payment_method_subsection">
                                <SMALL>Please provide your AliPay email address in the field below.
                                <BR>
                                <DIV STYLE="float:left;width:230px;padding-top:5px;">
                                    <INPUT TYPE="text" ID="alipay_email_address" NAME="alipay_email_address" STYLE="width:220px;" VALUE="">
                                </DIV>
                                <DIV STYLE="float:right;width:210px;padding-top:5px;">
                                    <A HREF="javascript:;" onClick="useAlipay();"><IMG SRC="/images/button_go.gif"></A>
                                </DIV>
                                <DIV CLASS="clear"></DIV>
                            </DIV>
                        </TD>
                    </TR>
                           </TABLE>
        </DIV>
    </DIV>

    <P></P>

<!-- CC PAYMENT FORM BEGIN -->
    <div id="braintreeCCPaymentForm" class="paymentAddonBlock">
        <div id="braintreeNewPaymentMethodBox">
            <div ID="detailBox">
                <div class="header"><span class="highlight">Billing Details:</span> Enter your billing information below</div>
                <div class="content">

                    <br>
                    <label class="hosted-field--label" for="card-number">Card Number</label>
                    <div id="card-number" class="hosted-field"></div>

                    <label class="hosted-field--label" for="cardholderName">Cardholder Name</label>
                    <div class="hosted-field">
                        <input type="text" class="hosted-field--input" autocomplete="name" autocorrect="off" autocapitalize="none" spellcheck="false" id="cardholderName" placeholder="Enter cardholder name">
                    </div>

                    <div style="overflow: hidden;">    
                    <div style="float: left; width: 49%;">    
                    <label class="hosted-field--label" for="expiration-date">Expiration Date</label>
                    <div id="expiration-date" class="hosted-field"></div>
                    </div>

                    <div style="float: right; width: 49%;">    
                    <label class="hosted-field--label" for="cvv">CVV</label>
                    <div id="cvv" class="hosted-field"></div>
                    </div>
                    </div>
                    <br>

                    <label class="hosted-field--label" for="country">Country</label>
                    <div class="hosted-field">
                        <select name="country" id="country" class="hosted-field--input" onChange="stateCheck(this.options[this.selectedIndex].value, 0)" tabindex="1">
                            <OPTION  VALUE="US">United States</OPTION>
<OPTION  VALUE="CA">Canada</OPTION>
<OPTION  VALUE="GB">United Kingdom</OPTION>
<OPTION  VALUE="AF">Afghanistan</OPTION>
<OPTION  VALUE="AL">Albania</OPTION>
<OPTION  VALUE="DZ">Algeria</OPTION>
<OPTION  VALUE="AS">American Somoa</OPTION>
<OPTION  VALUE="AD">Andorra</OPTION>
<OPTION  VALUE="AO">Angola</OPTION>
<OPTION  VALUE="AI">Anguilla</OPTION>
<OPTION  VALUE="AQ">Antarctica</OPTION>
<OPTION  VALUE="AG">Antigua and Barbuda</OPTION>
<OPTION  VALUE="AR">Argentina</OPTION>
<OPTION  VALUE="AM">Armenia</OPTION>
<OPTION  VALUE="AW">Aruba</OPTION>
<OPTION  VALUE="AU">Australia</OPTION>
<OPTION  VALUE="AT">Austria</OPTION>
<OPTION  VALUE="AZ">Azerbaijan</OPTION>
<OPTION  VALUE="BS">Bahamas</OPTION>
<OPTION  VALUE="BH">Bahrain</OPTION>
<OPTION  VALUE="BD">Bangladesh</OPTION>
<OPTION  VALUE="BB">Barbados</OPTION>
<OPTION  VALUE="BY">Belarus</OPTION>
<OPTION  VALUE="BE">Belgium</OPTION>
<OPTION  VALUE="BZ">Belize</OPTION>
<OPTION  VALUE="BJ">Benin</OPTION>
<OPTION  VALUE="BM">Bermuda</OPTION>
<OPTION  VALUE="BT">Bhutan</OPTION>
<OPTION  VALUE="BO">Bolivia</OPTION>
<OPTION  VALUE="BA">Bosnia and Herzegovina</OPTION>
<OPTION  VALUE="BW">Botswana</OPTION>
<OPTION  VALUE="BV">Bouvet Island</OPTION>
<OPTION  VALUE="BR">Brazil</OPTION>
<OPTION  VALUE="IO">British Indian Ocean Territory</OPTION>
<OPTION  VALUE="BN">Brunei Darussalam</OPTION>
<OPTION  VALUE="BG">Bulgaria</OPTION>
<OPTION  VALUE="BF">Burkina Faso</OPTION>
<OPTION  VALUE="BI">Burundi</OPTION>
<OPTION  VALUE="KH">Cambodia</OPTION>
<OPTION  VALUE="CM">Cameroon</OPTION>
<OPTION  VALUE="CV">Cape Verde</OPTION>
<OPTION  VALUE="KY">Cayman Islands</OPTION>
<OPTION  VALUE="CF">Central African Republic</OPTION>
<OPTION  VALUE="TD">Chad</OPTION>
<OPTION  VALUE="CL">Chile</OPTION>
<OPTION  VALUE="CN">China</OPTION>
<OPTION  VALUE="CO">Colombia</OPTION>
<OPTION  VALUE="KM">Comoros</OPTION>
<OPTION  VALUE="CD">Congo, The Democratic Republic Of The</OPTION>
<OPTION  VALUE="CR">Costa Rica</OPTION>
<OPTION  VALUE="HR">Croatia</OPTION>
<OPTION  VALUE="CW">Curacao</OPTION>
<OPTION  VALUE="CY">Cyprus</OPTION>
<OPTION  VALUE="CZ">Czech Republic</OPTION>
<OPTION  VALUE="DK">Denmark</OPTION>
<OPTION  VALUE="DJ">Djibouti</OPTION>
<OPTION  VALUE="DM">Dominica</OPTION>
<OPTION  VALUE="DO">Dominican Republic</OPTION>
<OPTION  VALUE="TL">East Timor</OPTION>
<OPTION  VALUE="EC">Ecuador</OPTION>
<OPTION  VALUE="EG">Egypt</OPTION>
<OPTION  VALUE="SV">El Salvador</OPTION>
<OPTION  VALUE="GQ">Equatorial Guinea</OPTION>
<OPTION  VALUE="ER">Eritrea</OPTION>
<OPTION  VALUE="EE">Estonia</OPTION>
<OPTION  VALUE="ET">Ethiopia</OPTION>
<OPTION  VALUE="FK">Falkland Islands (Malvinas)</OPTION>
<OPTION  VALUE="FO">Faroe Islands</OPTION>
<OPTION  VALUE="FJ">Fiji</OPTION>
<OPTION  VALUE="FI">Finland</OPTION>
<OPTION  VALUE="FR">France</OPTION>
<OPTION  VALUE="GF">French Guiana</OPTION>
<OPTION  VALUE="PF">French Polynesia</OPTION>
<OPTION  VALUE="GA">Gabon</OPTION>
<OPTION  VALUE="GM">Gambia</OPTION>
<OPTION  VALUE="GE">Georgia</OPTION>
<OPTION  VALUE="DE">Germany</OPTION>
<OPTION  VALUE="GH">Ghana</OPTION>
<OPTION  VALUE="GI">Gibraltar</OPTION>
<OPTION  VALUE="GR">Greece</OPTION>
<OPTION  VALUE="GL">Greenland</OPTION>
<OPTION  VALUE="GD">Grenada</OPTION>
<OPTION  VALUE="GP">Guadeloupe</OPTION>
<OPTION  VALUE="GU">Guam</OPTION>
<OPTION  VALUE="GT">Guatemala</OPTION>
<OPTION  VALUE="GG">Guernsey</OPTION>
<OPTION  VALUE="GN">Guinea</OPTION>
<OPTION  VALUE="GW">Guinea-Bissau</OPTION>
<OPTION  VALUE="GY">Guyana</OPTION>
<OPTION  VALUE="HT">Haiti</OPTION>
<OPTION  VALUE="HN">Honduras</OPTION>
<OPTION  VALUE="HK">Hong Kong</OPTION>
<OPTION  VALUE="HU">Hungary</OPTION>
<OPTION  VALUE="IS">Iceland</OPTION>
<OPTION  VALUE="IN">India</OPTION>
<OPTION  VALUE="ID">Indonesia</OPTION>
<OPTION  VALUE="IQ">Iraq</OPTION>
<OPTION  VALUE="IE">Ireland</OPTION>
<OPTION  VALUE="IL">Israel</OPTION>
<OPTION  VALUE="IT">Italy</OPTION>
<OPTION  VALUE="CI">Ivory Coast</OPTION>
<OPTION  VALUE="JM">Jamaica</OPTION>
<OPTION  VALUE="JP">Japan</OPTION>
<OPTION  VALUE="JE">Jersey</OPTION>
<OPTION  VALUE="JO">Jordan</OPTION>
<OPTION  VALUE="KZ">Kazakhstan</OPTION>
<OPTION  VALUE="KE">Kenya</OPTION>
<OPTION  VALUE="KI">Kiribati</OPTION>
<OPTION  VALUE="KR">Korea, Republic Of</OPTION>
<OPTION  VALUE="XK">Kosovo</OPTION>
<OPTION  VALUE="KW">Kuwait</OPTION>
<OPTION  VALUE="KG">Kyrgyzstan</OPTION>
<OPTION  VALUE="LA">Laos</OPTION>
<OPTION  VALUE="LV">Latvia</OPTION>
<OPTION  VALUE="LB">Lebanon</OPTION>
<OPTION  VALUE="LS">Lesotho</OPTION>
<OPTION  VALUE="LR">Liberia</OPTION>
<OPTION  VALUE="LY">Libya</OPTION>
<OPTION  VALUE="LI">Liechtenstein</OPTION>
<OPTION  VALUE="LT">Lithuania</OPTION>
<OPTION  VALUE="LU">Luxembourg</OPTION>
<OPTION  VALUE="MO">Macao</OPTION>
<OPTION  VALUE="MK">Macedonia</OPTION>
<OPTION  VALUE="MG">Madagascar</OPTION>
<OPTION  VALUE="MW">Malawi</OPTION>
<OPTION  VALUE="MY">Malaysia</OPTION>
<OPTION  VALUE="MV">Maldives</OPTION>
<OPTION  VALUE="ML">Mali</OPTION>
<OPTION  VALUE="MT">Malta</OPTION>
<OPTION  VALUE="MH">Marshall Islands</OPTION>
<OPTION  VALUE="MQ">Martinique</OPTION>
<OPTION  VALUE="MR">Mauritania</OPTION>
<OPTION  VALUE="MU">Mauritius</OPTION>
<OPTION  VALUE="YT">Mayotte</OPTION>
<OPTION  VALUE="MX">Mexico</OPTION>
<OPTION  VALUE="FM">Micronesia, Federated States Of</OPTION>
<OPTION  VALUE="MD">Moldova, Republic Of</OPTION>
<OPTION  VALUE="MC">Monaco</OPTION>
<OPTION  VALUE="MN">Mongolia</OPTION>
<OPTION  VALUE="ME">Montenegro</OPTION>
<OPTION  VALUE="MA">Morocco</OPTION>
<OPTION  VALUE="MZ">Mozambique</OPTION>
<OPTION  VALUE="MM">Myanmar</OPTION>
<OPTION  VALUE="NA">Namibia</OPTION>
<OPTION  VALUE="NR">Nauru</OPTION>
<OPTION  VALUE="NP">Nepal</OPTION>
<OPTION  VALUE="NL">Netherlands</OPTION>
<OPTION  VALUE="AN">Netherlands Antilles</OPTION>
<OPTION  VALUE="NC">New Caledonia</OPTION>
<OPTION  VALUE="NZ">New Zealand</OPTION>
<OPTION  VALUE="NI">Nicaragua</OPTION>
<OPTION  VALUE="NE">Niger</OPTION>
<OPTION  VALUE="NG">Nigeria</OPTION>
<OPTION  VALUE="MP">Northern Mariana Islands</OPTION>
<OPTION  VALUE="NO">Norway</OPTION>
<OPTION  VALUE="OM">Oman</OPTION>
<OPTION  VALUE="PK">Pakistan</OPTION>
<OPTION  VALUE="PW">Palau</OPTION>
<OPTION  VALUE="PS">Palestinian Territory</OPTION>
<OPTION  VALUE="PA">Panama</OPTION>
<OPTION  VALUE="PG">Papua New Guinea</OPTION>
<OPTION  VALUE="PY">Paraguay</OPTION>
<OPTION  VALUE="PE">Peru</OPTION>
<OPTION  VALUE="PH">Philippines</OPTION>
<OPTION  VALUE="PN">Pitcairn</OPTION>
<OPTION  VALUE="PL">Poland</OPTION>
<OPTION  VALUE="PT">Portugal</OPTION>
<OPTION  VALUE="PR">Puerto Rico</OPTION>
<OPTION  VALUE="QA">Qatar</OPTION>
<OPTION  VALUE="RE">Reunion</OPTION>
<OPTION  VALUE="RO">Romania</OPTION>
<OPTION  VALUE="RU">Russian Federation</OPTION>
<OPTION  VALUE="RW">Rwanda</OPTION>
<OPTION  VALUE="SH">Saint Helena</OPTION>
<OPTION  VALUE="KN">Saint Kitts And Nevis</OPTION>
<OPTION  VALUE="LC">Saint Lucia</OPTION>
<OPTION  VALUE="VC">Saint Vincent And The Grenadines</OPTION>
<OPTION  VALUE="WS">Samoa</OPTION>
<OPTION  VALUE="SM">San Marino</OPTION>
<OPTION  VALUE="ST">Sao Tome And Principe</OPTION>
<OPTION  VALUE="SA">Saudi Arabia</OPTION>
<OPTION  VALUE="SN">Senegal</OPTION>
<OPTION  VALUE="RS">Serbia</OPTION>
<OPTION  VALUE="SC">Seychelles</OPTION>
<OPTION  VALUE="SL">Sierra Leone</OPTION>
<OPTION  VALUE="SG">Singapore</OPTION>
<OPTION  VALUE="SK">Slovakia</OPTION>
<OPTION  VALUE="SI">Slovenia</OPTION>
<OPTION  VALUE="SB">Solomon Islands</OPTION>
<OPTION  VALUE="SO">Somalia</OPTION>
<OPTION  VALUE="ZA">South Africa</OPTION>
<OPTION  VALUE="SS">South Sudan</OPTION>
<OPTION  VALUE="ES">Spain</OPTION>
<OPTION  VALUE="LK">Sri Lanka</OPTION>
<OPTION  VALUE="SD">Sudan</OPTION>
<OPTION  VALUE="SR">Suriname</OPTION>
<OPTION  VALUE="SJ">Svalbard And Jan Mayen</OPTION>
<OPTION  VALUE="SZ">Swaziland</OPTION>
<OPTION  VALUE="SE">Sweden</OPTION>
<OPTION  VALUE="CH">Switzerland</OPTION>
<OPTION  VALUE="SY">Syria</OPTION>
<OPTION  VALUE="TW">Taiwan</OPTION>
<OPTION  VALUE="TJ">Tajikistan</OPTION>
<OPTION  VALUE="TZ">Tanzania</OPTION>
<OPTION  VALUE="TH">Thailand</OPTION>
<OPTION  VALUE="TG">Togo</OPTION>
<OPTION  VALUE="TO">Tonga</OPTION>
<OPTION  VALUE="TT">Trinidad And Tobago</OPTION>
<OPTION  VALUE="TN">Tunisia</OPTION>
<OPTION  VALUE="TR">Turkey</OPTION>
<OPTION  VALUE="TM">Turkmenistan</OPTION>
<OPTION  VALUE="TC">Turks And Caicos Islands</OPTION>
<OPTION  VALUE="TV">Tuvalu</OPTION>
<OPTION  VALUE="UG">Uganda</OPTION>
<OPTION  VALUE="UA">Ukraine</OPTION>
<OPTION  VALUE="AE">United Arab Emirates</OPTION>
<OPTION  VALUE="UY">Uruguay</OPTION>
<OPTION  VALUE="UZ">Uzbekistan</OPTION>
<OPTION  VALUE="VU">Vanuatu</OPTION>
<OPTION  VALUE="VA">Vatican City</OPTION>
<OPTION  VALUE="VE">Venezuela</OPTION>
<OPTION  VALUE="VN">Vietnam</OPTION>
<OPTION  VALUE="VG">Virgin Islands, British</OPTION>
<OPTION  VALUE="VI">Virgin Islands, US</OPTION>
<OPTION  VALUE="EH">Western Sahara</OPTION>
<OPTION  VALUE="YE">Yemen</OPTION>
<OPTION  VALUE="ZR">Zaire</OPTION>
<OPTION  VALUE="ZM">Zambia</OPTION>
<OPTION  VALUE="ZW">Zimbabwe</OPTION>
                        </select>
                    </div>
                    
                    <label class="hosted-field--label" for="address">Address</label>
                    <div id="address" class="hosted-field">
                        <input type="text" class="hosted-field--input" autocomplete="address-line1" autocorrect="off" autocapitalize="none" spellcheck="false" name="address" id="address" placeholder="Enter your address" tabindex="2">
                    </div>

                    <label class="hosted-field--label" for="address2">Address 2</label>
                    <div id="address2" class="hosted-field">
                        <input type="text" class="hosted-field--input" autocomplete="address-line2" autocorrect="off" autocapitalize="none" spellcheck="false" name="address2" id="address2" placeholder="" tabindex="3">
                    </div>

                    <label class="hosted-field--label" for="city">City</label>
                    <div class="hosted-field">
                        <input type="text" class="hosted-field--input" autocomplete="address-level2" autocorrect="off" autocapitalize="none" spellcheck="false" name="city" id="city" placeholder="Enter your city" tabindex="4">
                    </div>

                    <label class="hosted-field--label">State:</label>
                    <div class="hosted-field" ID="state_select">
                        <select name="state" class="hosted-field--input" id="state">
                        <OPTION  VALUE="AL">Alabama</OPTION>
<OPTION  VALUE="AK">Alaska</OPTION>
<OPTION  VALUE="AZ">Arizona</OPTION>
<OPTION  VALUE="AR">Arkansas</OPTION>
<OPTION  VALUE="CA">California</OPTION>
<OPTION  VALUE="CO">Colorado</OPTION>
<OPTION  VALUE="CT">Connecticut</OPTION>
<OPTION  VALUE="DE">Delaware</OPTION>
<OPTION  VALUE="DC">District of Columbia</OPTION>
<OPTION  VALUE="FL">Florida</OPTION>
<OPTION  VALUE="GA">Georgia</OPTION>
<OPTION  VALUE="HI">Hawaii</OPTION>
<OPTION  VALUE="ID">Idaho</OPTION>
<OPTION  VALUE="IL">Illinois</OPTION>
<OPTION  VALUE="IN">Indiana</OPTION>
<OPTION  VALUE="IA">Iowa</OPTION>
<OPTION  VALUE="KS">Kansas</OPTION>
<OPTION  VALUE="KY">Kentucky</OPTION>
<OPTION  VALUE="LA">Louisiana</OPTION>
<OPTION  VALUE="ME">Maine</OPTION>
<OPTION  VALUE="MD">Maryland</OPTION>
<OPTION  VALUE="MA">Massachusetts</OPTION>
<OPTION  VALUE="MI">Michigan</OPTION>
<OPTION  VALUE="MN">Minnesota</OPTION>
<OPTION  VALUE="MS">Mississippi</OPTION>
<OPTION  VALUE="MO">Missouri</OPTION>
<OPTION  VALUE="MT">Montana</OPTION>
<OPTION  VALUE="NE">Nebraska</OPTION>
<OPTION  VALUE="NV">Nevada</OPTION>
<OPTION  VALUE="NH">New Hampshire</OPTION>
<OPTION  VALUE="NJ">New Jersey</OPTION>
<OPTION  VALUE="NM">New Mexico</OPTION>
<OPTION  VALUE="NY">New York</OPTION>
<OPTION  VALUE="NC">North Carolina</OPTION>
<OPTION  VALUE="ND">North Dakota</OPTION>
<OPTION  VALUE="OH">Ohio</OPTION>
<OPTION  VALUE="OK">Oklahoma</OPTION>
<OPTION  VALUE="OR">Oregon</OPTION>
<OPTION  VALUE="PA">Pennsylvania</OPTION>
<OPTION  VALUE="RI">Rhode Island</OPTION>
<OPTION  VALUE="SC">South Carolina</OPTION>
<OPTION  VALUE="SD">South Dakota</OPTION>
<OPTION  VALUE="TN">Tennessee</OPTION>
<OPTION  VALUE="TX">Texas</OPTION>
<OPTION  VALUE="UT">Utah</OPTION>
<OPTION  VALUE="VT">Vermont</OPTION>
<OPTION  VALUE="VA">Virginia</OPTION>
<OPTION  VALUE="WA">Washington</OPTION>
<OPTION  VALUE="WV">West Virginia</OPTION>
<OPTION  VALUE="WI">Wisconsin</OPTION>
<OPTION  VALUE="WY">Wyoming</OPTION>
<OPTION  VALUE="AE">Armed Forces Africa</OPTION>
<OPTION  VALUE="AA">Armed Forces Americas</OPTION>
<OPTION  VALUE="AE">Armed Forces Canada</OPTION>
<OPTION  VALUE="AE">Armed Forces Europe</OPTION>
<OPTION  VALUE="AE">Armed Forces Middle East</OPTION>
<OPTION  VALUE="AP">Armed Forces Pacific</OPTION>
                        </select>
                    </div>
                    <div class="hosted-field" ID="state_tf">
                        <input type="text" class="hosted-field--input" id="state_tffield" name="state_tf" value="">
                    </div>

                    <label class="hosted-field--label" for="postal-code">Postal Code</label>
                    <div class="hosted-field">
                        <input type="text" class="hosted-field--input" autocomplete="postal-code" autocorrect="off" autocapitalize="none" spellcheck="false" id="postal-code" name="postal_code" placeholder="Enter billing postal code">
                    </div>

                                        <label class="hosted-field--label" for="save_cc">
                        <input type="checkbox"
                               id="save_cc"
                               name="save_cc"
                               checked="checked"
                               value="1"
                               style="width: auto; height: auto; border: none">
                        Save this card for faster checkouts</label>
                    
                </div>
            </div>
        </div>
    </div>
<!-- CC PAYMENT FORM END -->

<!-- PAYPAL PAYMENT FORM BEGIN -->
    <div id="braintreePaypalPaymentForm" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with PayPal</SPAN></DIV>
            <DIV CLASS="content">
                By clicking "PayPal Checkout" button you agree to our  <a href="/popups/terms.php" rel="shadowbox;height=420;width=575">Terms &amp; Conditions</a> <img src="/images/required_icon.gif" class="requiredIcon">
            </DIV>
        </DIV>

        <div id="braintreePaypalButton" style="text-align: center; padding-top: 30px;"></div>
    </div>
<!-- PAYPAL PAYMENT FORM END -->

    

<!-- APPLE PAY PAYMENT FORM BEGIN -->
    <div id="braintreeApplePayPaymentForm" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with PayPal</SPAN></DIV>
            <DIV CLASS="content">
                By clicking "Pay" button you agree to our  <a href="/popups/terms.php" rel="shadowbox;height=420;width=575">Terms &amp; Conditions</a> <img src="/images/required_icon.gif" class="requiredIcon">
            </DIV>
        </DIV>
        <div id="braintreeApplePayButtonContainer" style="text-align: center; padding-top: 30px;">
            <a lang="us" id="braintreeApplePayButton" class="apple-pay-button apple-pay-button-black" title="Pay with ApplePay" role="link"></a>
        </div>
    </div>
<!-- APPLE PAY PAYMENT FORM END -->

<!-- VENMO PAYMENT FORM BEGIN -->
    <div id="braintreeVenmoPaymentForm" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with Venmo</SPAN></DIV>
            <DIV CLASS="content">
                By clicking "Pay" button you agree to our  <a href="/popups/terms.php" rel="shadowbox;height=420;width=575">Terms &amp; Conditions</a> <img src="/images/required_icon.gif" class="requiredIcon">
            </DIV>
        </DIV>
        <div id="braintreeVenmoButtonContainer" style="text-align: center; padding-top: 30px;">
            <a href="/"  id="braintreeVenmoButton" role="link" lang="us" title="Pay with Venmo"><img src="/images/button_order_venmo.png"/></a>
        </div>
    </div>
<!-- VENMO PAYMENT FORM END -->

<!-- YUANSFER PAYMENT FORM BEGIN -->
    <div id="yuansferWeChatPaymentForm" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with WeChat</SPAN></DIV>
            <DIV CLASS="content">
                By clicking "Pay" button you agree to our  <a href="/popups/terms.php" rel="shadowbox;height=420;width=575">Terms &amp; Conditions</a> <img src="/images/required_icon.gif" class="requiredIcon">
            </DIV>
        </DIV>
        <div id="yuansferWeChatButtonContainer" style="text-align: center; padding-top: 30px;">
            <a href="/"  id="yuansferWeChatButton" role="link" lang="us" title="Pay with WeChat" onclick="payWithYuansferWeChat(event);"><img src="/images/payment_options_wechat.png"/></a>
        </div>
    </div>
<!-- YUANSFER PAYMENT FORM END -->


<!-- BITPAY PAYMENT FORM BEGIN -->
    <div id="bitpayPaymentForm" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with Bitpay</SPAN></DIV>
            <DIV CLASS="content">
                By clicking "Pay" button you agree to our  <a href="/popups/terms.php" rel="shadowbox;height=420;width=575">Terms &amp; Conditions</a> <img src="/images/required_icon.gif" class="requiredIcon">
            </DIV>
        </DIV>
        <div id="bitpayButtonContainer" style="text-align: center; padding-top: 30px;">
            <input type="hidden" name="bitpayId" id="bitpayId" value="">
            <a href="/"  id="bitpayButton" title="Pay with Bitpay" onclick="payWithBitpay(event);"><img src="/images/payment_options_bitpay.svg" style="width:214px" /></a>
        </div>
    </div>
<!-- BITPAY PAYMENT FORM END -->






    <P></P>

    <DIV ID="accountFundsBox" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">NameSilo Account Funds</SPAN></DIV>
            <DIV CLASS="content" ID="accountFundsVerbiage"></DIV>
        </DIV>
    </DIV>

    <DIV ID="bitcoinBox" class="paymentAddonBlock">
        <DIV ID="detailBox">
            <DIV CLASS="header"><SPAN CLASS="highlight">Pay with Bitcoin</SPAN></DIV>
            <DIV CLASS="content" ID="bitcoinPaymentDetails"></DIV>
        </DIV>
    </DIV>

    <DIV ID="finalizeOrder">
        
        
        <DIV CLASS="elementContainer" STYLE="text-align:center;" ID="submitButtonField">
            <DIV CLASS="elementContainer" STYLE="text-align:center;">
                <INPUT TYPE="CHECKBOX" ID="approve_terms" NAME="approve_terms" CLASS="formClear" >
                <LABEL FOR="approve_terms">I accept the NameSilo.com <A HREF="/popups/terms.php" REL="shadowbox;height=420;width=575">Terms & Conditions</A> <IMG SRC="/images/required_icon.gif" CLASS="requiredIcon"></LABEL>
            </DIV>
            <INPUT TYPE="image" SRC="/images/button_place_my_order.gif" ID="submitButton" CLASS="formClear" STYLE="width:223px;height:41px">
        </DIV>
    </DIV>
</FORM>
</DIV>

<DIV ID="innerContentContainerRight">
    
<DIV ID="cartBox" CLASS="cartTableHide">

    <DIV CLASS="top"></DIV>

    <DIV ID="content">

                    <DIV CLASS="header"><IMG SRC="/images/header_your_shopping_cart.gif"></DIV>
        <DIV ID="cartAlertBox"></DIV>
        <DIV ID="cartErrorBox"></DIV>

        <BR>

        
            <TABLE CELLPADDING="0" CELLSPACING="0" ID="cartTable">

                <TR>
                    <TH>NameSilo Discount Program</TH>
                </TR>

                <TR>
                    <TD>

                        <TABLE CELLPADDING="0" CELLSPACING="0" CLASS="cartInnerTable">

                            <TR>
                                <TD>

                                    <A HREF="/account_discount_program.php"><IMG
                                                SRC="/images/discount_program_small.gif"
                                                STYLE="float:right;padding:0 0 5px 2px;"></A>

                                    Save money on this order by joining the <A HREF="/account_discount_program.php">NameSilo
                                        Discount Program</A>.
                                    There is no obligation or fees to join... just savings on our already lowest
                                    everyday prices!

                                </TD>
                            </TR>

                        </TABLE>

                    </TD>
                </TR>

            </TABLE>

        
        <div style="width:100%;">

            <div style="float:left;">

                
                    <TABLE CELLPADDING="0" CELLSPACING="0" ID="cartTable">

                        <TR>

                            <TH>Configuration Options</TH>

                        </TR>

                        <TR>

                            <TD>

                                <TABLE CELLPADDING="0" CELLSPACING="0" CLASS="cartInnerTable">

                                    
                                        <TR>

                                            <TD CLASS="configureText" STYLE="vertical-align:top;">Service
                                                Link:</TD>
                                            <TD CLASS="configureValue">

                                                
                                                    
                                                        None (default)

                                                    
                                                
                                            </TD>

                                        </TR>

                                        <TR>

                                            <TD CLASS="configureText">
                                                NameServers:</TD>
                                            <TD CLASS="configureValue">

                                                
                                                    
                                                        Default
                                                        <SMALL>(can change later)</SMALL>

                                                    
                                                
                                            </TD>

                                        </TR>

                                    
                                    
                                        <TR>

                                            <TD CLASS="configureText">Auto-Renew:</TD>
                                            <TD CLASS="configureValue">

                                                
                                                    No
                                                
                                            </TD>

                                        </TR>

                                    
                                    
                                    
                                    
                                    
                                                                            <TR ID="cart_next_discount">
                                            <TD CLASS="configureText">Next Discount: <A CLASS="ct"
                                                                                        TITLE="Next Discount|The number of additional domain registrations that you must add to this order to qualify for the next bulk discount."><IMG
                                                            SRC="/images/question_new.png"
                                                            STYLE="width:12px;height:12px;"></A></TD>
                                            <TD CLASS="configureValue highlight" ID="cart_next_discount_number"></TD>
                                        </TR>
                                                                    </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                            </div>
                        <div class="clear"></div>
        </div>

        <TABLE CELLPADDING="0" CELLSPACING="0" ID="cartTable" CLASS="cartTableHide">
            <TR>
                <TH STYLE="width:30%;">Item</TH>
                <TH STYLE="width:20%;">QTY</TH>
                <TH STYLE="width:25%;">Price</TH>
                <TH STYLE="width:25%;">Sub</TH>
            </TR>
                                                <TR ID="0_cart_container">
                        <TD COLSPAN="4">
                            <TABLE CELLPADDING="0" CELLSPACING="0" CLASS="cartInnerTable">
                                <TR>
                                    <TD COLSPAN="4" ID="0_cart_display" CLASS="domainDisplay">
                                                                                vivision.org                                                                            </TD>
                                </TR>

                                <TR>
                                    <TD ID="0_cart_type" STYLE="width:41%;">
                                                                                Registration                                                                                                                                                                                                                                            </TD>

                                    <TD STYLE="width:20%;text-align:center;">
                                                                                                                                    1                                                                                                                        </TD>

                                    <TD ID="0_cart_price"
                                        STYLE="width:25%;text-align:center;">

                                                                                    $10.79                                                                            </TD>

                                    <TD ID="0_cart_subtotal"
                                        STYLE="width:25%;text-align:center;">
                                        $10.79</TD>

                                </TR>
                                                                                                                                                                                <TR>
                                            <TD ID="1_cart_display" COLSPAN="2">
                                                WHOIS Privacy                                                                                            </TD>
                                            <TD ID="1_cart_price" STYLE="text-align:center;">
                                                $0.00</TD>
                                            <TD ID="1_cart_subtotal" STYLE="text-align:center;">
                                                $0.00</TD>
                                        </TR>
                                                                                                </TABLE>
                        </TD>
                    </TR>
                                                                    <TR>
                <TD ROWSPAN="6">
                                    </TD>
                <TD CLASS="cart_extended" COLSPAN="2">ICANN FEES:</TD>
                <TD CLASS="cart_extended_value">Included!</TD>
            </TR>

            <TR>
                <TD CLASS="cart_extended" COLSPAN="2">PROCESSING:</TD>
                <TD CLASS="cart_extended_value">Free!</TD>
            <TR ID="cart_order_subtotal_container"
                style="display:none;">

                <TD CLASS="cart_order_subtotal_text" COLSPAN="2">SUBTOTAL:</TD>
                <TD ID="cart_order_subtotal" CLASS="cart_order_subtotal">
                    $10.79</TD>
            </TR>

            <TR ID="cart_order_discount_container"
                style="display:none;">
                <TD CLASS="cart_order_discount_text" COLSPAN="2">DISCOUNT:</TD>
                <TD ID="cart_order_discount" CLASS="cart_order_discount">
                    ($0.00                    )
                </TD>
            </TR>

            <TR>
                <TD CLASS="cart_order_total_text" COLSPAN="2">TOTAL:</TD>
                <TD ID="cart_order_total" CLASS="cart_order_total">
                    $10.79</TD>
            </TR>
        </TABLE>

        
        
            <DIV ALIGN="CENTER" CLASS="cartTableHide">
                                    <A HREF="/shopping_cart.php"><IMG SRC="/images/button_modify.gif"></A>
                            </DIV>

        

    </DIV>

    <DIV CLASS="bottom"></DIV>

</DIV>

<P>


    

<DIV STYLE="margin:20px 0;">
    <A HREF="/help.php" ID="liveChatButton"></A>
</DIV>

<DIV STYLE="margin:20px 0;">
    <A HREF="/popups/videos/namesilo_vid1.php" onClick="NewWindow(this.href,'name','485','285','yes');return false;"><IMG SRC="/images/right_video_button.jpg"></A>
</DIV>

</DIV>

<DIV CLASS="clear"></DIV>

        </DIV>

        <DIV CLASS="clear"></DIV>
        
    </DIV>

    <DIV ID="outerContainerBottom"></DIV>
    
</DIV>

<DIV ID="footer">

    <DIV ID="footerContent">
    
        <DIV CLASS="left">
        
            <A HREF="/" STYLE="padding-left:0;">Home</A> |
            <A HREF="https://new.namesilo.com/domain-search?beta=1">Register</A> |
            <A HREF="/transfer">Transfer</A> |
            <A HREF="/pricing">Pricing</A> |
            <A HREF="/Support">Support</A> |            

                            <A HREF="/account_home.php">My Account</A> |
            
            <A HREF="/contact_us.php">Contact Us</A>
            
                        
             | <A HREF="/whois.php">WHOIS</A>
             
            
            <P>

            <DIV CLASS="copyright">
                &copy; 2009 - 2021 NameSilo, LLC
                <BR>
                All Rights Reserved
            </DIV>

            <DIV CLASS="paymentOptions">
                <IMG SRC="/images/payment_options_bottom_alp.gif" alt="We accept Visa, Amex, Discover, Mastercard, PayPal, Bitcoin, Dwolla, and Skrill and AliPay">
            </DIV>

            <DIV CLASS="clear"></DIV>
            
        </DIV>

        <DIV CLASS="middle">

            <DIV CLASS="twitter">                
                <A HREF="https://twitter.com/namesilo" ID="twitterLink" TARGET="_blank" TITLE="Follow NameSilo on Twitter">Follow us on Twitter</A>
            </DIV>

            <DIV CLASS="facebook">                
                <A HREF="http://www.facebook.com/namesilo" ID="facebookLink" TARGET="_blank" TITLE="Like NameSilo on Facebook">Like us on Facebook</A>
            </DIV>

            <DIV CLASS="clear"></DIV>

        </DIV>

        <DIV CLASS="right">
        
            <IMG SRC="/images/icann_logo_new.gif" TITLE="NameSilo is proud to be an ICANN-accredited registrar">
            
        </DIV>

        <DIV CLASS="clear"></DIV>
        
    </DIV>

</DIV>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19852558-3', 'auto');
  ga('send', 'pageview');

</script>

<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"17194243"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
<script>!function(s,a,e,v,n,t,z){if(s.saq)return;n=s.saq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!s._saq)s._saq=n;n.push=n;n.loaded=!0;n.version='1.0';n.queue=[];t=a.createElement(e);t.async=!0;t.src=v;z=a.getElementsByTagName(e)[0];z.parentNode.insertBefore(t,z)}(window,document,'script','https://tags.srv.stackadapt.com/events.js');saq('ts', 'ipmmGw91iYmYtGMPVHkI4w');</script>
<!-- Snap Pixel Code -->
<script type='text/javascript'>
    (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
    {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
        a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
        r.src=n;var u=t.getElementsByTagName(s)[0];
        u.parentNode.insertBefore(r,u);})(window,document,
        'https://sc-static.net/scevent.min.js');
    snaptr('init', '5b31b432-c3df-44e1-8907-ac0206bde7b0');
    snaptr('track', 'PAGE_VIEW');
</script>
<!-- End Snap Pixel Code -->






<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6791c40e3ca103fa","token":"286f7bcea5f74621b5e5af1fb32a7352","version":"2021.7.0","si":10}'></script>
</BODY>
</HTML>
