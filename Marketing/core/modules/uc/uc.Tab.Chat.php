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
<?php global $tt_author_vars; $tt_paged = $tt_author_vars['tt_paged']; $tt_author_id = $tt_author_vars['tt_author_id']; $logged_user_id = get_current_user_id(); ?>
<?php $vm = UCChatVM::getInstance($tt_paged, $tt_author_id); ?>
<?php if($vm->isCache && $vm->cacheTime) { ?>
    <!-- Author chat cached <?php echo $vm->cacheTime; ?> -->
<?php } ?>
<div class="author-tab-box chat-tab">
    <div class="tab-content author-chat">
        <!-- 页内私信输入框 -->
        <div id="pmForm" class="pm-form">
<!--            <div class="pm-header">-->
<!--                <h2>--><?php //_e('Send Message', 'tt'); ?><!--</h2>-->
<!--            </div>-->
            <div class="pm-content">
                <div class="pm-inner">
                    <div class="pm-info">
                        <label class="pm-info_label caption-muted"><?php _e('Send to:', 'tt'); ?></label>
                        <span class="pm-info_receiver"><?php echo $tt_author_vars['tt_author']->display_name; ?></span>
                        <input class="receiver-id" type="hidden" value="<?php echo $tt_author_id; ?>">
                        <input class="pm_nonce" type="hidden" value="<?php echo wp_create_nonce('tt_pm_nonce'); ?>">
                    </div>
                    <textarea class="pm-text mt10" placeholder="<?php _e('Write your message here.', 'tt'); ?>" tabindex="1" required></textarea>
                </div>
            </div>
            <div class="pm-btns mt10">
                <button class="confirm btn btn-info ml10" data-box-type="modal" tabindex="2"><?php _e('SEND', 'tt'); ?></button>
            </div>
        </div>
        <?php if($data = $vm->modelData) { $pagination_args = $data->pagination; $messages = $data->messages; ?>
            <?php if(count($messages) > 0) { ?>
                <div class="tip"><?php echo sprintf(__('%d messages in total, %d new income messages (with green mark)', 'tt'), $data->messages_count, $data->unread_count); ?></div>
                <div class="loop-rows messages-loop-rows">
                    <?php foreach ($messages as $message) { ?>
                        <div id="<?php echo 'message-' . $message['msg_ID']; ?>" class="<?php echo $message['class']; ?>" data-msg-id="<?php echo $message['msg_ID']; ?>">
                            <a class="people-link" href="<?php echo $message['people_home']; ?>"><img class="avatar lazy" src="<?php echo LAZY_PENDING_AVATAR; ?>" data-original="<?php echo $message['chat_avatar']; ?>"></a>
                            <div class="msg-main">
                                <div class="msg-content">
                                    <a class="sender-label" href="<?php echo $message['people_home']; ?>"><?php echo $message['chat_name']; ?></a><?php echo ' : ' . $message['text']; ?>
                                </div>
                                <div class="msg-meta">
                                    <span class="msg-date text-muted"><?php echo $message['date']; ?></span>
                                    <span class="msg-act msg-act-delete pull-right" data-msg-id="<?php echo $message['msg_ID']; ?>"><?php _e('DELETE', 'tt'); ?></span>
                                    <span class="msg-act msg-act-reply pull-right" data-msg-id="<?php echo $message['msg_ID']; ?>"><?php _e('REPLY', 'tt'); ?></span>
                                    <?php if(!$message['read']) { ?>
                                    <span class="msg-act msg-act-mark pull-right" title="<?php _e('Unread message', 'tt'); ?>" data-msg-id="<?php echo $message['msg_ID']; ?>"><?php _e('MARK READ', 'tt'); ?></span>
                                    <?php } ?>
                                </div>
                                <?php if(!$message['read']) { ?>
                                <span class="unread-mark"><i class="tico tico-info-circle"></i></span>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if($pagination_args['max_num_pages'] > 1) { ?>
                    <?php tt_pagination(str_replace('999999999', '%#%', get_pagenum_link(999999999)), $pagination_args['current_page'], $pagination_args['max_num_pages']); ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>