<?php
/**
 * WhatsApp Chat  - main page .. 
 * 
 * @subpackage chat
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Chat' ) ) :

class HT_CTC_Chat {

    public function chat() {
        
        $options = get_option('ht_ctc_chat_options');
        $othersettings = get_option('ht_ctc_othersettings');
        $type = "chat";

        // If db values are not correct
		if ( !is_array($options)  || !isset($options['number']) ) {

            // in debug mode
            if ( isset($othersettings['debug_mode']) ) {
            ?>
            <script>console.log('please check plugin settings and save changes')</script>
            <?php
            }
            
            return;
        }
		
		

        $ht_ctc_chat = array();
        $ht_ctc_os = array();

        $page_id = get_the_ID();
        $page_url = get_permalink();
        $post_title = esc_html( get_the_title() );

        // page level
        $ht_ctc_pagelevel = get_post_meta( $page_id, 'ht_ctc_pagelevel', true );

        /**
         * show/hide
         * 
         * $page_display - page level settings  - show/hide/ null
         * $display - global settings 
         */
        $page_display = (isset($ht_ctc_pagelevel['show_hide'])) ? esc_attr($ht_ctc_pagelevel['show_hide']) : '';

        if ( 'show' !== $page_display ) {
            include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';
            // 'no' == $display - hided from global settings
            // 'hide' == $page_display - hided at page level settings
            if ( 'no' == $display || 'hide' == $page_display ) {
                return;
            }
        }
        

        // is mobile
        $is_mobile = ht_ctc()->device_type->is_mobile();
        // style
        $ht_ctc_chat['style_desktop'] = esc_attr( $options['style_desktop'] );
        $ht_ctc_chat['style_mobile'] = esc_attr( $options['style_mobile'] );

        // position
        $default_position = '';
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        $ht_ctc_chat['position'] = $position;
        $ht_ctc_chat['position_mobile'] = $position_mobile;
        

        

        // Number
        $ht_ctc_chat['number'] = (isset($ht_ctc_pagelevel['number'])) ? esc_attr($ht_ctc_pagelevel['number']) : esc_attr( $options['number'] );
        $ht_ctc_chat['number'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['number'], 'Click to Chat for WhatsApp', 'number' );

        // call to action
        $ht_ctc_chat['call_to_action'] = (isset($ht_ctc_pagelevel['call_to_action'])) ? esc_attr($ht_ctc_pagelevel['call_to_action']) : __( esc_attr( $options['call_to_action'] ) , 'click-to-chat-for-whatsapp' );
        $ht_ctc_chat['call_to_action'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['call_to_action'], 'Click to Chat for WhatsApp', 'call_to_action' );

        // prefilled text
        $ht_ctc_chat['pre_filled'] = (isset($ht_ctc_pagelevel['pre_filled'])) ? esc_attr($ht_ctc_pagelevel['pre_filled']) : __( esc_attr( $options['pre_filled'] ) , 'click-to-chat-for-whatsapp' );
        $ht_ctc_chat['pre_filled'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['pre_filled'], 'Click to Chat for WhatsApp', 'pre_filled' );

        // wa: wa.me  /  webapi: web/api.whatsapp,  
        $ht_ctc_chat['webandapi'] = 'wa';
        if ( isset( $options['webandapi'] ) ) {
            $ht_ctc_chat['webandapi'] = 'webapi';
        }

        $ht_ctc_chat['display_mobile'] = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $ht_ctc_chat['display_desktop'] = (isset($options['hideon_desktop'])) ? 'hide' : 'show';

        // number not added and is administrator
        $no_number = "added";
        $admin_url = admin_url( 'admin.php?page=click-to-chat' );
        $admin_link = "<a href='$admin_url'>WhatsApp number</a>";

        if ( '' == $ht_ctc_chat['number'] ) {
            $no_number = "<p style='background-color: #ffffff; margin:0; border: 1px solid #fbfbfb; padding:7px; border-radius:4px; box-shadow: 5px 10px 8px #888888;'>No WhatsApp Number Found!</p>";
            if ( current_user_can('administrator') ) {
                $no_number = "<p style='background-color: #ffffff; margin:0; border: 1px solid #fbfbfb; padding:11px; border-radius:4px; box-shadow: 5px 10px 8px #888888;'>No WhatsApp Number Found!<br><small style='color: red;'>Admin Notice:<br></small><small>Add $admin_link at pluign Settings<br>If already added, <strong>clear the Cache</strong> and try.<br>If still an issue, please contact plugin developers</small></p>";
                
            }
        }

        // class names
        $ht_ctc_chat['class_names'] = "ht-ctc ht-ctc-chat ctc-analytics ";
        $ht_ctc_chat['id'] = "ht-ctc-chat ";

        $ht_ctc_chat['css'] = "display: none; cursor: pointer; z-index: 99999999;";

        // analytics
        $ht_ctc_os['is_ga_enable'] = 'yes';
        $ht_ctc_os['is_fb_pixel'] = 'yes';
        // show effect
        $ht_ctc_os['show_effect'] = '';
        $ht_ctc_os['data-attributes'] = '';

        // hooks
        $ht_ctc_chat = apply_filters( 'ht_ctc_fh_chat', $ht_ctc_chat );
        $ht_ctc_os = apply_filters( 'ht_ctc_fh_os', $ht_ctc_os );

        // pre-filled  - have to run after filter hook. 
        $ht_ctc_chat['pre_filled'] = str_replace( array('{{url}}', '{url}', '{{title}}', '{title}', '{{site}}', '{site}' ),  array( $page_url, $page_url, $post_title, $post_title, HT_CTC_BLOG_NAME, HT_CTC_BLOG_NAME ), $ht_ctc_chat['pre_filled'] );

        // style for desktop, mobile
        if ( 'yes' == $is_mobile ) {
            $ht_ctc_chat['style'] = $ht_ctc_chat['style_mobile'];
            $wp_device = 'ctc_wp_mobile';
        } else {
            $ht_ctc_chat['style'] = $ht_ctc_chat['style_desktop'];
            $wp_device = 'ctc_wp_desktop';
        }

        // @uses at styles / easy call (after filter hook)
        $style = $ht_ctc_chat['style'];
        $style_desktop = $ht_ctc_chat['style_desktop'];
        $style_mobile = $ht_ctc_chat['style_mobile'];
        $call_to_action = $ht_ctc_chat['call_to_action'];

        $ht_ctc_chat['class_names'] .= " $wp_device style-$style ";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        $path_d = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_desktop. '.php';
        $path_m = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_mobile. '.php';

        
        if ( '' == $call_to_action ) {
            if ( '1' == $style || '4' == $style || '6' == $style || '8' == $style ) {
                $call_to_action = "WhatsApp us";
            }
        }

        $display_css = "display: none; ";

        // AMP
        $on = "";

        // AMP
        if ( isset($othersettings['amp']) ) {
            // ampforwp_is_amp_endpoint  / is_amp_endpoint / amp_is_request
            if ( function_exists( 'amp_is_request' ) && amp_is_request() ) {
            
                if ( 'yes' == $is_mobile ) {
                    if ( 'show' == $ht_ctc_chat['display_mobile'] ) {
                        $display_css = "";
                    }
                } else {
                    if ( 'show' == $ht_ctc_chat['display_desktop'] ) {
                        $display_css = "";
                    }
                }

                $pre = rawurlencode($ht_ctc_chat['pre_filled']);
                // 'single quote', 'double quote', '&', '<', '>'
                $pre = str_replace( array('%26%23039%3B', '%26quot%3B', '%26amp%3B', '%26lt%3B', '%26gt%3B'), array('', '', '', '<', '>'), $pre);
                $ext = $ht_ctc_chat['number'] . '?text=' . $pre;
                $wame_link = "https://wa.me/$ext";
                $on = "on=\"tap:AMP.navigateTo(url='$wame_link', target='_blank', opener='')\"";

                wp_deregister_script( 'ht_ctc_app_js' );
            }
        }
        

        
        if ( is_file( $path ) ) {
            do_action('ht_ctc_ah_before_fixed_position');
            ?>  
            <div class="<?php echo $ht_ctc_chat['class_names'] ?>" id="<?php echo $ht_ctc_chat['id'] ?>"  
                style="<?php echo $display_css ?> <?php echo $default_position ?>"  
                data-return_type="<?php echo $type ?>"  
                data-style="<?php echo $ht_ctc_chat['style'] ?>" 
                data-number="<?php echo $ht_ctc_chat['number'] ?>" 
                data-pre_filled="<?php echo $ht_ctc_chat['pre_filled'] ?>" 
                data-is_ga_enable="<?php echo $ht_ctc_os['is_ga_enable'] ?>" 
                data-is_fb_pixel="<?php echo $ht_ctc_os['is_fb_pixel'] ?>" 
                data-webandapi="<?php echo $ht_ctc_chat['webandapi'] ?>" 
                data-display_mobile="<?php echo $ht_ctc_chat['display_mobile'] ?>" 
                data-display_desktop="<?php echo $ht_ctc_chat['display_desktop'] ?>" 
                data-css="<?php echo $ht_ctc_chat['css'] ?>" 
                data-position="<?php echo $ht_ctc_chat['position'] ?>" 
                data-position_mobile="<?php echo $ht_ctc_chat['position_mobile'] ?>" 
                data-show_effect="<?php echo $ht_ctc_os['show_effect'] ?>" 
                data-no_number="<?php echo $no_number ?>" 
                <?php echo $ht_ctc_os['data-attributes'] ?>  
                <?php echo $on ?>  
                >
                <?php
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_chat"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_chat"><?php include $path_m; ?></div>
                    <?php
                } else {
                    include $path;
                }
                ?>
            </div>
            <?php
            do_action('ht_ctc_ah_after_fixed_position');
        }

        
    }

}

// new HT_CTC_Chat();

$ht_ctc_chat = new HT_CTC_Chat();

// wp_footer / wp_head / get_footer
$ht_ctc_chat_load_position = apply_filters( 'ht_ctc_chat_load_position', 'wp_footer' );

add_action( "$ht_ctc_chat_load_position", array( $ht_ctc_chat, 'chat' ) );

endif; // END class_exists check