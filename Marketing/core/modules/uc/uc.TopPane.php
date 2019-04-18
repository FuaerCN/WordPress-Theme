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
<?php global $tt_author_vars; ?>
<?php $tt_author_vars['tt_author_id'] = get_queried_object_id(); ?>
<?php $tt_author_vars['tt_author'] = get_user_by('ID', $tt_author_vars['tt_author_id']); ?>
<?php $tt_author_vars['tt_paged'] = get_query_var('tt_paged') ? : 1; ?>
<!-- 作者头像及背景图 -->
<section class="billboard author-header mb20" style="background-image: url(<?php echo tt_get_user_cover($tt_author_vars['tt_author_id']); ?>)">
    <div class="container text-center">
        <div class="avatar-wrap"><img class="avatar" src="<?php echo tt_get_avatar($tt_author_vars['tt_author_id'], 'medium'); ?>"><?php echo tt_get_member_icon($tt_author_vars['tt_author_id']); ?></div>
        <h2><?php echo $tt_author_vars['tt_author']->display_name; ?><?php if(get_current_user_id() == $tt_author_vars['tt_author_id']){ ?><a class="edit-profile" href="<?php echo tt_url_for('my_settings'); ?>"><i class="tico tico-pencil2"></i></a><?php } ?></h2><!-- TODO vip gender icon -->
        <p class="author-bio" title="<?php echo $description = get_the_author_meta('description', $tt_author_vars['tt_author_id']); ?>"><?php echo $description; ?></p>
        <?php if(!is_user_logged_in() || get_current_user_id() != $tt_author_vars['tt_author_id']) { ?>
        <div class="author-interact">
            <?php echo tt_follow_button($tt_author_vars['tt_author_id']); ?>
            <a class="pm-btn" href="javascript: void 0" data-receiver="<?php echo $tt_author_vars['tt_author']->display_name; ?>" data-receiver-id="<?php echo $tt_author_vars['tt_author_id']; ?>" title="<?php _e('Send a message', 'tt'); ?>"><i class="tico tico-envelope"></i><?php _e('Chat', 'tt'); ?></a>
        </div>
        <?php } ?>
    </div>
</section>