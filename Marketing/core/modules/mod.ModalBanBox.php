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
<!-- Ban模态框 -->
<div id="banBox" class="js-ban ban-form ban-form-modal fadeScale" role="dialog" aria-hidden="true">
    <div class="ban-header">
        <h2><?php _e('Account Management', 'tt'); ?></h2>
    </div>
    <div class="ban-content">
        <div class="ban-inner">
            <input class="ban-nonce" type="hidden" value="<?php echo wp_create_nonce('tt_ban_nonce'); ?>">
            <textarea class="ban-text mt10" placeholder="<?php _e('Write your reason here.', 'tt'); ?>" tabindex="1" required></textarea>
        </div>
    </div>
    <div class="ban-btns mt20">
        <button class="cancel btn btn-default" tabindex="3"><?php _e('CANCEL', 'tt'); ?></button>
        <button class="confirm btn btn-danger ml10" data-box-type="modal" tabindex="2"><?php _e('CONFIRM', 'tt'); ?></button>
        <a class="cancel close-btn"><i class="tico tico-close"></i></a>
    </div>
</div>