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
<?php

/**
 * Class MeEditPostVM
 */
class MeEditPostVM extends BaseVM {

    /**
     * @var int 文章ID
     */
    private $_postId;

    /**
     * @var int 用户ID
     */
    private $_userId;

    protected function __construct() {
        $this->_cacheUpdateFrequency = 'daily';
        $this->_cacheInterval = 3600*24; // 缓存保留一天
    }

    /**
     * 获取实例
     *
     * @since   2.0.0
     * @param   int    $post_id   文章ID
     * @param   int    $user_id   用户ID
     * @return  static
     */
    public static function getInstance($post_id = 0, $user_id = 0) {
        $instance = new static();
        $instance->_cacheKey = 'tt_cache_' . $instance->_cacheUpdateFrequency . '_vm_' . __CLASS__ . '_post' . $post_id . '_user' . $user_id;
        $instance->_postId = $post_id;
        $instance->_userId = $user_id;
        $instance->_enableCache = false; // 待编辑文章不使用缓存
        $instance->configInstance();
        return $instance;
    }

    protected function getRealData() {
        $post = get_post($this->_postId);
        if(!$post || (!current_user_can('publish_posts') && $post->post_author != $this->_userId)) return null; //不存在的文章或普通编辑以下权限用户最多只能编辑自己的文章

        $post_categories = wp_get_post_categories($this->_postId);
        $all_categories = get_categories();
        $all_tags = wp_get_post_tags($this->_postId);
        $tag_names = array();
        foreach ($all_tags as $all_tag) {
            $tag_names[] = $all_tag->name;
        }

        $cc = get_post_meta( $post->ID, 'tt_post_copyright', true );
        $cc = $cc ? maybe_unserialize($cc) : array('source_title' => '', 'source_link' => '');

        $free_dl = get_post_meta( $post->ID, 'tt_free_dl', true ) ? : '';
        $sale_dl = get_post_meta( $post->ID, 'tt_sale_dl2', true ) ? : '';

        return (object)array(
            'ID' => $post->ID,
            'post_title' => $post->post_title,
            'post_excerpt' => $post->post_excerpt,
            'post_content' => $post->post_content,
            'post_cat_id' => $post_categories[0]->ID,
            'all_cats' => $all_categories,
            'all_tags' => $all_tags,
            'tags' => implode(',', $tag_names),
            'cc_title' => $cc['source_title'],
            'cc_link' => $cc['source_link'],
            'free_dl' => $free_dl,
            'sale_dl' => $sale_dl
        );
    }
}