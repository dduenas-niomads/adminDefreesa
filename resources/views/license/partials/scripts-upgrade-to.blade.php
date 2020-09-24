<script src="{{ config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_URL_JS') }}" ></script>
<script>
    //Document Ready
    $(document).ready(function() {
        goToPlans = function () {
            location = "/upgrade";
        }
        checkout = function () {
            alert("checkout");
        }
        onLoad = function() {
            $('#modal-on-load').modal({ backdrop: 'static', keyboard: false });
        }
        updateCheckbox = function() {
            var checkbox = document.getElementById('visanetCheckbox');
            if (checkbox != null) {
                if (checkbox.checked) {
                    var button = document.getElementById('buttonUpgrade');
                    if (button != null) {
                        button.disabled = false;
                    }
                } else {
                    var button = document.getElementById('buttonUpgrade');
                    if (button != null) {
                        button.disabled = true;
                    }
                }
            }
        }
        openVisanet = function() {
            VisanetCheckout.configure({
                action: "/checkout?amount={{ $license['price'] }}&purchaseNumber={{ $purchaseNumber }}&type={{ $license['type'] }}",
                sessiontoken : "{{ $session }}",
                channel : "web",
                showamount : "true",
                formbuttoncolor : "#f91942",
                formbuttonsize : "LARGE",
                merchantid : "{{ config('visa.' . env('VISA_ENVIRONMENT') . '.VISA_MERCHANT_ID') }}",
                merchantlogo : "{{ env('APP_URL_LOGO_MINI') }}",
                merchantname : "{{ env('APP_NAME') }}",
                purchasenumber : "{{ $purchaseNumber }}",
                amount : "{{ $license['price'] }}",
                expirationminutes : "5",
                timeouturl : "{{ env('APP_URL') }}/upgrade",
                cardholdername : "{{ $user->name }}",
                cardholderlastname : "{{ isset($user->lastname) ? $user->lastname : '' }}",
                cardholderemail : "{{ $user->email }}"
            });
            VisanetCheckout.open();
        }
    });
</script>