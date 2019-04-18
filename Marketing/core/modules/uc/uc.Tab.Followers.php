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
<?php $vm = UCFollowersVM::getInstance($tt_paged, $tt_author_id); ?>
<?php if($vm->isCache && $vm->cacheTime) { ?>
    <!-- Author followers cached <?php echo $vm->cacheTime; ?> -->
<?php } ?>
<div class="author-tab-box follow-tab followers-tab">
    <div class="tab-content author-follow author-followers">
        <?php if($data = $vm->modelData) { $count = $data->count; $followers = $data->followers; $total = $data->total; $max_pages = $data->max_pages; ?>
            <?php if($count > 0) { ?>
                <div class="row">
                    <?php foreach ($followers as $follower) { ?>
                    <div class="follow-box follower-box col-md-4 col-sm-6">
                        <div class="box-inner transition">
                            <div class="cover" style="background-image: url(<?php echo $follower['cover']; ?>)">
                                <img class="avatar lazy" src="<?php echo LAZY_PENDING_AVATAR; ?>" data-original="<?php echo $follower['avatar']; ?>">
                                <div class="mask">
                                    <h2><?php echo $follower['display_name']; ?></h2>
                                    <p><?php echo __('Brief Intro : ', 'tt') . $follower['description']; ?></p>
                                </div>
                            </div>
                            <div class="user-stats">
                                <span class="following"><span class="unit"><?php _e('FOLLOWING', 'tt'); ?></span><?php echo $follower['following_count']; ?></span>
                                <span class="followers"><span class="unit"><?php _e('FOLLOWERS', 'tt'); ?></span><?php echo $follower['followers_count']; ?></span>
                                <span class="posts"><span class="unit"><?php _e('POSTS', 'tt'); ?></span><?php echo $follower['posts_count']; ?></span>
                            </div>
                            <div class="user-interact">
                            <?php if ($follower['ID'] != $logged_user_id) { ?>
                                <?php echo tt_follow_button($follower['ID']); ?>
                                <a class="pm-btn" href="javascript: void 0" data-receiver="<?php echo $follower['display_name']; ?>" data-receiver-id="1" title="<?php _e('Send a message', 'tt'); ?>"><i class="tico tico-envelope"></i><?php _e('Chat', 'tt'); ?></a>
                                <a class="dropdown-toggle more-link-btn" href="javascript: void 0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tico tico-list"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo $follower['home']; ?>"><?php _e('View Homepage', 'tt'); ?></a></li>
                                    <li><a href="<?php echo $follower['posts_url']; ?>"><?php _e('His Posts', 'tt'); ?></a></li>
                                    <li><a href="<?php echo $follower['comments_url']; ?>"><?php _e('His Comments', 'tt'); ?></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo $follower['activities_url']; ?>"><?php _e('Check Activities', 'tt'); ?></a></li>
                                </ul>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php if($max_pages > 1) { ?>
                    <div class="pagination-mini clearfix">
                        <?php if($tt_paged == 1) { ?>
                            <div class="col-md-3 prev disabled"><a href="javascript:;"><?php _e('← 上一页', 'tt'); ?></a></div>
                        <?php }else{ ?>
                            <div class="col-md-3 prev"><a href="<?php echo $data->prev_page; ?>"><?php _e('← 上一页', 'tt'); ?></a></div>
                        <?php } ?>
                        <div class="col-md-6 page-nums">
                            <span class="current-page"><?php printf(__('Current Page %d', 'tt'), $tt_paged); ?></span>
                            <span class="separator">/</span>
                            <span class="max-page"><?php printf(__('Total %d Pages', 'tt'), $max_pages); ?></span>
                        </div>
                        <?php if($tt_paged != $data->max_pages) { ?>
                            <div class="col-md-3 next"><a href="<?php echo $data->next_page; ?>"><?php _e('下一页 →', 'tt'); ?></a></div>
                        <?php }else{ ?>
                            <div class="col-md-3 next disabled"><a href="javascript:;"><?php _e('下一页 →', 'tt'); ?></a></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="empty-content">
                    <span class="tico tico-dropbox"></span>
                    <p><?php _e('Nothing found here', 'tt'); ?></p>
                    <a class="btn btn-info" href="/"><?php _e('Back to home', 'tt'); ?></a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>