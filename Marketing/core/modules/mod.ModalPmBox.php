<?php
/**
 * Copyright (c) 2014-2018, yunsheji.cc
 * All right reserved.
 *
 * @since 1.1.0
 * @package Marketing
 * @author 云设计
 * @date 2018/02/14 10:00
 * @link https://yunsheji.cc
 */
?>
<!-- 私信模态框 -->
<div id="pmBox" class="js-pm pm-form pm-form-modal fadeScale" role="dialog" aria-hidden="true">
    <div class="pm-header">
        <h2><?php _e('Send Message', 'tt'); ?></h2>
    </div>
    <div class="pm-content">
        <div class="pm-inner">
            <div class="pm-info">
                <label class="pm-info_label caption-muted"><?php _e('Send to:', 'tt'); ?></label>
                <span class="pm-info_receiver"></span>
                <input class="pm_nonce" type="hidden" value="<?php echo wp_create_nonce('tt_pm_nonce'); ?>">
            </div>
            <textarea class="pm-text mt10" placeholder="<?php _e('Write your message here.', 'tt'); ?>" tabindex="1" required></textarea>
        </div>
    </div>
    <div class="pm-btns mt20">
        <button class="cancel btn btn-default" tabindex="3"><?php _e('CANCEL', 'tt'); ?></button>
        <button class="confirm btn btn-info ml10" data-box-type="modal" tabindex="2"><?php _e('SEND', 'tt'); ?></button>
        <a class="cancel close-btn"><i class="tico tico-close"></i></a>
    </div>
</div>