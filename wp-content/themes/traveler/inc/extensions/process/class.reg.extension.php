<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Main class install
 */
class STRegExtension
{

    public $plugins_folder_baseurl;
    public function __construct()
    {
        add_filter('st_vina_list_extendsion',array($this,'list_extension'),10,1);
        add_action('st_vina_list_addons',array($this,'list_addons'),9);
        add_action( 'admin_menu',array($this,'st_vina_create_menu_in_admin'),10,9);
        $this->plugins_folder_baseurl = WP_PLUGIN_DIR;
    }
    public function st_vina_create_menu_in_admin(){
        add_submenu_page(
            'st_traveler_option',
            __('Extensions'),
            __('Extensions'),
            'manage_options',
            'st-vina-extensions',
            array($this,'st_vina_action_create_menu')
        );
    }
    public function st_vina_action_create_menu(){
        $list_page = apply_filters('st_vina_custom_page_extension_valid',array());
        $tab = isset($_REQUEST['extension-tab']) ? $_REQUEST['extension-tab'] : 'list';
        $task = isset($_REQUEST['extension-task']) ? $_REQUEST['extension-task'] : false;
        if($tab == 'list'){
            $argsl = array();
            st_vina_get_template('html-extentions.php',$argsl,__DIR__,__DIR__.'/views/');
        }
        elseif($tab == 'extendsion'){
            $args2 = array();
            st_vina_get_template('html-list-extenstions.php',$args2,__DIR__,__DIR__.'/views/');
        }
    }
    public function list_addons($list_addons){
        $list_addons = array(
            'traveler-viator' => array(
                'name' => __('Traveler Viator',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-viator-addon/25883249?irgwc=1&clickid=Vci3vTxyLxyOU6nwUx0Mo3Q3Ukix8cwEDwF5wo0&iradid=275988&irpid=2084894&iradtype=ONLINE_TRACKING_LINK&irmptype=mediapartner&mp_value1=&utm_campaign=af_impact_radius_2084894&utm_medium=affiliate&utm_source=impact_radius',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/282575832/traveler_viator_preview.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=10a07f07739cc02dde1345c4bf3205d4'
            ),
            'traveler-bokun' => array(
                'name' => __('Traveler Bokun',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-bokun-addon/26024431?s_rank=1',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/284460677/traveler_bokun_preview11.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=1a0efb8e9839904b60676de3cdcb0ee4'
            ),
            'traveler-optimize' => array(
                'name' => __('Traveler Optimize',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-optimize-addon/26117905?s_rank=1',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/284943027/traveler_op_preview11.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=74cfae2fb9c43f0fea2f67f688af3c35'
            ),
            'traveler-sms' => array(
                'name' => __('Traveler SMS',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-sms-addon/25726255?s_rank=6',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('Traveler SMS help to send SMS notification for Admin, Partner, and Customer when make a booking on the site by Traveler theme.',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/281114737/travelersms_preview.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=6219ee7f2b7f423ff91b8d639b092ab7'
            ),
            'traveler-duplicate' => array(
                'name' => __('Traveler Duplicate',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-duplicate-addon/26270682?s_rank=2',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('Traveler Duplicate Add-on will make it easier for you. Content such as price, availability of each service (hotel, tour, car, flight) will be fully copied.',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/285464240/traveler_duplicate_preview.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=5c41c57f27cf2dc0290e486c720b6894'
            ),
            'traveler-compare' => array(
                'name' => __('Traveler Compare',ST_TEXTDOMAIN),
                'url-download' => 'https://codecanyon.net/item/traveler-compare-addon/26481293',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('The new add-on that can be used for Traveler. It helps bookers can compare any services like Hotel, Tour, Car, Rental, Activity.',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'last_updated' => '5/5/2020',
                'price' => '39',
                'preview_image' => 'https://codecanyon.img.customer.envatousercontent.com/files/287845460/travelercompare_preview.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=53f87930affd70c3b9307f986f5f572f'
            ),
        );
        return $list_addons;
    }

    public function list_extension($list_extendsion){
        $list_extendsion = array(
            'traveler-razor-pay' => array(
                'name' => __('Traveler Razor Pay',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/travelertraveler-razor-pay.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-razor-pay.png',
                'last_updated' => '18/11/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-export' => array(
                'name' => __('Traveler Invoice',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-export.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-export.png',
                'last_updated' => '4/8/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-paypal-v2' => array(
                'name' => __('Traveler PayPal V2',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-paypal-v2.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-paypal-v2.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-paypal' => array(
                'name' => __('Traveler PayPal',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-paypal.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-paypal.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'vina-stripe' => array(
                'name' => __('Vina Stripe',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/vina-stripe.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/vina-stripe.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-twocheckout' => array(
                'name' => __('2Checkout',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-twocheckout.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-twocheckout.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            // 'traveler-skrill' => array(
            //     'name' => __('Skrill',ST_TEXTDOMAIN),
            //     'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-skrill.zip',
            //     'author' => __('ShineTheme',ST_TEXTDOMAIN),
            //     'url-author' => 'https://travelerwp.com/',
            //     'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
            //     'version' => '1.0.0',
            //     'requires' => '5.2 or higher',
            //     'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-skrill.png',
            //     'last_updated' => '5/5/2020',
            //     'homepage' => 'https://travelerwp.com'
            // ),
            'traveler-authorize' => array(
                'name' => __('Authorize.net',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-authorize.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-authorize.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-payu' => array(
                'name' => __('PayUbiz',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-payu.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-payu.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-dpo' => array(
                'name' => __('DPO',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-dpo.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-dpo.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-ipay88' => array(
                'name' => __('IPay88',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-ipay88.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-ipay88.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-onepay' => array(
                'name' => __('Onepay',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-onepay.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-onepay.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-onepay-atm' => array(
                'name' => __('Onepay ATM',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-onepay-atm.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-onepay-atm.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-payumoney' => array(
                'name' => __('PayUMoney',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-payumoney.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-payumoney.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-payulatam' => array(
                'name' => __('PayUlatam',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-payulatam.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-payulatam.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            'traveler-mercadopago' => array(
                'name' => __('Mercado Pago',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-mercadopago.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-mercadopago.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'
            ),
            
            'traveler-billplz' => array(
                'name' => __('Billplz',ST_TEXTDOMAIN),
                'url-download' => 'http://shinetheme.com/demosd/plugins/traveler/traveler-billplz.zip',
                'author' => __('ShineTheme',ST_TEXTDOMAIN),
                'url-author' => 'https://travelerwp.com/',
                'description' => __('This plugin is used for Traveler Theme',ST_TEXTDOMAIN),
                'version' => '1.0.0',
                'requires' => '5.2 or higher',
                'preview_image' => 'http://shinetheme.com/demosd/plugins/traveler/previews/traveler-billplz.png',
                'last_updated' => '5/5/2020',
                'homepage' => 'https://travelerwp.com'

            ),

        );
        return $list_extendsion;
    }
}
$STRegExtension = new STRegExtension();
