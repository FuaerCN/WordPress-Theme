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
<?php global $tt_author_vars; $tt_paged = $tt_author_vars['tt_paged']; $tt_author_id = $tt_author_vars['tt_author_id']; ?>
<?php $vm = UCLatestVM::getInstance($tt_paged, $tt_author_id); ?>
<?php if($vm->isCache && $vm->cacheTime) { ?>
<!-- Author Latest posts cached <?php echo $vm->cacheTime; ?> -->
<?php } ?>
<div class="author-tab-box articles-tab">
    <div class="tab-content latest-posts">
    <?php if($data = $vm->modelData) { $pagination_args = $data->pagination; $uc_latest_posts = $data->uc_latest_posts; ?>
        <?php if(count($uc_latest_posts) > 0) { ?>
        <?php $logged_user_id = get_current_user_id(); ?>
        <div class="loop-rows posts-loop-rows">
            <?php foreach ($uc_latest_posts as $uc_latest_post) { ?>
                <article id="<?php echo 'post-' . $uc_latest_post['ID']; ?>" class="post type-post status-publish <?php echo 'format-' . $uc_latest_post['format']; ?>">
                    <div class="entry-thumb hover-scale">
                        <a href="<?php echo $uc_latest_post['permalink']; ?>"><img width="250" height="170" src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $uc_latest_post['thumb']; ?>" class="thumb-medium wp-post-image lazy" alt="<?php echo $uc_latest_post['title']; ?>"></a>
                        <?php echo $uc_latest_post['category']; ?>
                    </div>
                    <div class="entry-detail">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo $uc_latest_post['permalink']; ?>" rel="bookmark"><?php echo $uc_latest_post['title']; ?></a><?php if($logged_user_id == $tt_author_id){?><span><a href="<?php echo tt_url_for('edit_post', $uc_latest_post['ID']); ?>" title="<?php _e('Edit Post', 'tt'); ?>"><i class="tico tico-new"></i></a> </span><?php } ?></h2>
                            <div class="entry-meta entry-meta-1">
                                <span class="author vcard"><a class="url" href="<?php echo $uc_latest_post['author_url']; ?>"><?php echo $uc_latest_post['author']; ?></a></span>
                                <span class="entry-date text-muted"><time class="entry-date" datetime="<?php echo $uc_latest_post['datetime']; ?>" title="<?php echo $uc_latest_post['datetime']; ?>"><?php echo $uc_latest_post['time']; ?></time></span>
                                <span class="comments-link text-muted"><i class="tico tico-comments-o"></i><a href="<?php echo $uc_latest_post['permalink'] . '#respond'; ?>"><?php echo $uc_latest_post['comment_count']; ?></a></span>
                            </div>
                        </header>
                        <div class="entry-excerpt">
                            <div class="post-excerpt"><?php echo $uc_latest_post['excerpt']; ?></div>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>

        <?php if($pagination_args['max_num_pages'] > 1) { ?>
            <?php tt_pagination(str_replace('999999999', '%#%', get_pagenum_link(999999999)), $pagination_args['current_page'], $pagination_args['max_num_pages']); ?>
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