<?php
/**
 * After Setting page / FAQ
 * 
 * @since 2.6
 * @package ctc
 * @subpackage admin
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<ul class="collapsible popout">
    <p class="description" style="text-align: center"><?php _e( 'Frequently Asked Questions', 'click-to-chat-for-whatsapp' ); ?></p>

    <li>
    <div class="collapsible-header"><?php _e( 'Show/Hide on Selected pages, devices', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/show-only-on-selected-pages/"><?php _e( 'Show only on selected pages' ) ?></a></p>
        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/hide-only-on-selected-pages/"><?php _e( 'Hide only on selected pages' ) ?></a></p>
        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/show-hide-on-mobile-desktop/"><?php _e( 'Show/Hide on Mobile/Desktop' ) ?></a></p>
    </div>
    </li>

    <li>
    <div class="collapsible-header"><?php _e( 'Change Values at page level', 'click-to-chat-for-whatsapp' ); ?> (number, ..)</div>
    <div class="collapsible-body">
        <p class="description">We can change the WhatsApp number, Call to Action, prefilled message while editing the post from the right side bar' )</p>
        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/change-values-at-page-level/"><?php _e( 'Change Settings at Page Level' ) ?></a></p>
    </div>
    </li>

    <li>
    <div class="collapsible-header"><?php _e( 'I Make Changes and Nothing Happens', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><a target="_blank" href="https://holithemes.com/plugins/click-to-chat/clear-cache/"><?php _e( 'Clear Cache' ) ?>:</a> <br>
            &emsp; - <?php _e( 'Cache plugins', 'click-to-chat-for-whatsapp' ); ?> <br>
            &emsp; - <?php _e( 'Server cache', 'click-to-chat-for-whatsapp' ); ?> <br>
            &emsp; - <?php _e( 'Browser Cache', 'click-to-chat-for-whatsapp' ); ?>
        </p>
    </div>
    </li>

    <li>
    <div class="collapsible-header"><?php _e( 'No WhatsApp Number Found!', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><?php _e( 'Add', 'click-to-chat-for-whatsapp' ); ?> <a href="#chat_settings"><?php _e( 'WhatsApp Number with Country Code', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><?php _e( 'If already added it might be cached version', 'click-to-chat-for-whatsapp' ); ?>, <strong><?php _e( 'Clear the Cache and try', 'click-to-chat-for-whatsapp' ); ?></strong></p>
        <p class="description"><?php _e( 'If still an issue, please contact us', 'click-to-chat-for-whatsapp' ); ?></p>
    </div>
    </li>

    <li>
    <div class="collapsible-header"><?php _e( 'Phone number shared via url is invalid', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><?php _e( 'Add WhatsApp Number With country code', 'click-to-chat-for-whatsapp' ); ?></p>
        <p class="description"><?php _e( 'If already added, clear the cache and check', 'click-to-chat-for-whatsapp' ); ?></p>
    </div>
    </li>

    <!-- <li>
    <div class="collapsible-header">Positon to place</div>
    <div class="collapsible-body">
        <p class="description">Center to the Screen</p>
        <p class="description">Different position for mobile, desktop (pro)</p>
    </div>
    </li> -->

    <li>
    <div class="collapsible-header"><?php _e( 'Contact Us', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><a href="http://api.whatsapp.com/send?phone=919494429789&text=<?php echo get_bloginfo('url'); ?>%0AHi%20HoliThemes!!" target="_blank"><?php _e( 'WhatsApp', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><?php _e( 'mail', 'click-to-chat-for-whatsapp' ); ?>: ctc@holithemes.com</p>
    </div>
    </li>

    <li>
    <div class="collapsible-header"><?php _e( 'HoliThemes On', 'click-to-chat-for-whatsapp' ); ?></div>
    <div class="collapsible-body">
        <p class="description"><a href="https://www.facebook.com/holithemes/" target="_blank"><?php _e( 'Facebook', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><a href="https://www.youtube.com/channel/UC2Tf_WB9PWffO2B3tswWCGw" target="_blank"><?php _e( 'YouTube', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><a href="https://twitter.com/holithemes" target="_blank"><?php _e( 'Twitter', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><a href="https://www.instagram.com/holithemes/" target="_blank"><?php _e( 'Instagram', 'click-to-chat-for-whatsapp' ); ?></a></p>
        <p class="description"><a href="https://www.linkedin.com/company/holithemes" target="_blank"><?php _e( 'LinkedIn', 'click-to-chat-for-whatsapp' ); ?></a></p>
    </div>
    </li>

    <!-- <div class="collapsible-header">Support Us</div>
    <div class="collapsible-body">
        <p class="description">If you like the plugin support us by giving 5 star rating</p>
    </div>
    </li> -->
    
</ul>