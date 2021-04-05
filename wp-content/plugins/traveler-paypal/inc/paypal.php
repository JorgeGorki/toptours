<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STGatewayPaypal
 *
 * Created by ShineTheme
 *
 */
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

if (!class_exists('STGatewayPaypal') and class_exists('STPaypal')) {
    class STGatewayPaypal extends STAbstactPaymentGateway
    {
        public static $_ints;
        private $_gateway_id = 'st_paypal';

        function __construct()
        {
            add_filter('st_payment_gateway_st_paypal_name', array($this, 'get_name'));
        }


        /**
         * @update 1.2.0
         * @return bool
         */
        function _pre_checkout_validate()
        {
            return true;

        }

        function html()
        {
            echo Traveler_Paypal_Payment::get_inst()->loadTemplate('paypal');
        }

        function check_complete_purchase($order_id)
        {
            $paypal = new STPaypal();
            $total = get_post_meta($order_id, 'total_price', true);
            $total = round((float)$total, 2);
            $currency = TravelHelper::get_current_currency('name');

            $booking_currency_conversion = st()->get_option('booking_currency_conversion');
            if (!empty($booking_currency_conversion)) {
                foreach ($booking_currency_conversion as $k => $v) {
                    if ($v['name'] == $currency) {
                        $total = $total / $v['rate'];
                        $total = round((float)$total, 2);
                        $currency = "USD";
                    }
                }
            }

            $response = $paypal->completePurchase(
                array(
                    'amount' => (float)$total,
                    'currency' => $currency,
                    'description' => __('Traveler Booking', 'traveler-paypal'),
                    'returnUrl' => $this->get_return_url($order_id),
                    'cancelUrl' => $this->get_cancel_url($order_id)
                )
            );


            if ($response->isSuccessful()) {

                $data = $response->getData();
                //Try to create user and create new orders with paypal transaction detail
                self::paypal_checkout($data, $order_id);

                return array(
                    'status' => true
                );

            } elseif ($response->isRedirect()) {
                //$response->redirect(); // this will automatically forward the customer
                return array('status' => false, 'redirect_url' => $response->getRedirectUrl(), 'func' => 'check_completePurchase');
//                    return ;
            } else {
                // not successful
                return array('status' => false, 'message' => $response->getMessage());

            }
        }

        function package_completed_checkout($order_id){
            if (!class_exists('STAdminPackages')) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st0'), 'message' => __('This function is off', 'traveler-paypal')];
            }

            $paypal = new STPaypal();

            $order = STAdminPackages::get_inst()->get('*', $order_id);

            $currency = TravelHelper::get_current_currency('name');

            $total = (float)$order->package_price;

            $booking_currency_conversion = st()->get_option('booking_currency_conversion');
            if (!empty($booking_currency_conversion)) {
                foreach ($booking_currency_conversion as $k => $v) {
                    if ($v['name'] == $currency) {
                        $total = $total / $v['rate'];
                        $total = round((float)$total, 2);
                        $currency = "USD";
                    }
                }
            }

            $purchase = [
                'amount' => $total,
                'currency' => $currency,
                'description' => __('Member Package', 'traveler-paypal'),
                'returnUrl' => STAdminPackages::get_inst()->get_return_url($order_id),
                'cancelUrl' => STAdminPackages::get_inst()->get_cancel_url($order_id),
            ];

            $response = $paypal->completePurchase($purchase);

            if ($response->isSuccessful()) {

                $data = $response->getData();
                //Try to create user and create new orders with paypal transaction detail
                self::paypal_checkout($data, $order_id);

                return array(
                    'status' => true
                );

            } elseif ($response->isRedirect()) {
                //$response->redirect(); // this will automatically forward the customer
                return array('status' => false, 'redirect_url' => $response->getRedirectUrl(), 'func' => 'check_completePurchase');
//                    return ;
            } else {
                // not successful
                return array('status' => false, 'message' => $response->getMessage());

            }
        }


        function do_checkout($order_id)
        {
            $paypal = new STPaypal();

            $total = get_post_meta($order_id, 'total_price', true);
            $total = round((float)$total, 2);
            $currency = TravelHelper::get_current_currency('name');
            $booking_currency_conversion = st()->get_option('booking_currency_conversion');
            if (!empty($booking_currency_conversion)) {
                foreach ($booking_currency_conversion as $k => $v) {
                    if ($v['name'] == $currency) {
                        $total = $total / $v['rate'];
                        $total = round((float)$total, 2);
                        $currency = "USD";
                    }
                }
            }

            $purchase = array(
                'amount' => (float)$total,
                'currency' => $currency,
                'description' => __('Traveler Booking', 'traveler-paypal'),
                'returnUrl' => $this->get_return_url($order_id),
                'cancelUrl' => $this->get_cancel_url($order_id),
            );
            $pp = $paypal->get_authorize_url($order_id, $purchase);


            if (isset($pp['redirect_url']) and $pp['redirect_url'])
                $pp_link = $pp['redirect_url'];


            do_action('st_before_redirect_paypal');

            if (!isset($pp_link)) {
                return array(
                    'status' => false,
                    'message' => isset($pp['message']) ? $pp['message'] : false,
                    'data' => isset($pp['data']) ? $pp['data'] : false,
                );
            }
            if (!$pp_link) {
                return array(
                    'status' => false,
                    'message' => __('Can not get Paypal Authorize URL.', 'traveler-paypal')
                );
            } else {

                return array(
                    'status' => true,
                    'redirect' => $pp_link
                );
            }
        }

        public function package_do_checkout($order_id)
        {
            if (!class_exists('STAdminPackages')) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st0'), 'message' => __('This function is off', 'traveler-paypal')];
            }
            $order = STAdminPackages::get_inst()->get('*', $order_id);

            $currency = TravelHelper::get_current_currency('name');

            $total = (float)$order->package_price;

            $booking_currency_conversion = st()->get_option('booking_currency_conversion');
            if (!empty($booking_currency_conversion)) {
                foreach ($booking_currency_conversion as $k => $v) {
                    if ($v['name'] == $currency) {
                        $total = $total / $v['rate'];
                        $total = round((float)$total, 2);
                        $currency = "USD";
                    }
                }
            }

            $purchase = [
                'amount' => $total,
                'currency' => $currency,
                'description' => __('Member Package', 'traveler-paypal'),
                'returnUrl' => STAdminPackages::get_inst()->get_return_url($order_id),
                'cancelUrl' => STAdminPackages::get_inst()->get_cancel_url($order_id),
            ];

            $gateway = Omnipay::create('PayPal_Express');
            $gateway->setUsername(st()->get_option('paypal_api_username'));
            $gateway->setPassword(st()->get_option('paypal_api_password'));
            $gateway->setSignature(st()->get_option('paypal_api_signature'));
            if (st()->get_option('paypal_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
            }

            $response = $gateway->purchase($purchase)->send();

            if ($response->isSuccessful()) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st1')];
            } elseif ($response->isRedirect()) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st1'), 'redirect_url' => $response->getRedirectUrl()];
            } else {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st0'), 'message' => $response->getMessage(), 'data' => $purchase];
            }
        }

        function get_name()
        {
            return __('Paypal', 'traveler-paypal');
        }

        static function paypal_checkout($transaction = array(), $order_id = false)
        {
            $default = array(
                'EMAIL' => false,
                'CHECKOUTSTATUS' => '',
                'PAYERID' => '',
                'FIRSTNAME' => '',
                'LASTNAME' => '',
                'DESC' => ''
            );


            $data = wp_parse_args($transaction, $default);

            if (isset($transaction['PAYMENTREQUEST_0_TRANSACTIONID'])) {
                $data['transaction_id'] = $transaction['PAYMENTREQUEST_0_TRANSACTIONID'];
            }

            if ($order_id) {
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        if (array_key_exists($key, $default))
                            update_post_meta($order_id, 'pp_' . strtolower($key), $value);
                    }
                }
                return array('status' => true);
            }

        }

        /**
         *
         * Check payment method for all items or specific is enable
         *
         * @update 1.1.7
         * @param bool $item_id
         * @return bool
         */
        function is_available($item_id = false)
        {
            if (!class_exists('STPaypal')) {
                return false;

            }

            $result = false;

            if (st()->get_option('pm_gway_st_paypal_enable') == 'on') {
                $result = true;
            }
            if ($item_id) {
                $meta = get_post_meta($item_id, 'is_meta_payment_gateway_st_paypal', true);
                if ($meta == 'off') {
                    $result = false;
                }
            }


            return $result;
        }

        function get_option_fields()
        {
            return array(
                array(
                    'id' => 'paypal_email',
                    'label' => __('Paypal Email', 'traveler-paypal'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Payal Email Account', 'traveler-paypal'),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ),
                array(
                    'id' => 'paypal_enable_sandbox',
                    'label' => __('Paypal Enable Sandbox', 'traveler-paypal'),
                    'type' => 'on-off',
                    'section' => 'option_pmgateway',
                    'std' => 'on',
                    'desc' => __('Allow you to enable sandbox mod for testing', 'traveler-paypal'),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ),
                array(
                    'id' => 'paypal_api_username',
                    'label' => __('Paypal API Username', 'traveler-paypal'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Paypal API Username', 'traveler-paypal'),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ),
                array(
                    'id' => 'paypal_api_password',
                    'label' => __('Paypal API Password', 'traveler-paypal'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Paypal API Password', 'traveler-paypal'),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ),
                array(
                    'id' => 'paypal_api_signature',
                    'label' => __('Paypal API Signature', 'traveler-paypal'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Paypal API Signature', 'traveler-paypal'),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                )
            );
        }

        function get_default_status()
        {
            return true;
        }

        function is_check_complete_required()
        {
            return true;
        }

        function get_logo()
        {
            return Traveler_Paypal_Payment::get_inst()->pluginUrl . 'assets/img/pp-logo.png';
        }

        function getGatewayId()
        {
            return $this->_gateway_id;
        }

        static function instance()
        {
            if (!self::$_ints) {
                self::$_ints = new self();
            }

            return self::$_ints;
        }

        static function add_payment($payment)
        {
            $payment['st_paypal'] = self::instance();

            return $payment;
        }
    }

    add_filter('st_payment_gateways', array('STGatewayPaypal', 'add_payment'));
}

