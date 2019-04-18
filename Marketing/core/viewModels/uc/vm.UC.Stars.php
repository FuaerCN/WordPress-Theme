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
 * Class UCStarsVM
 */
class UCStarsVM extends BaseVM {

    /**
     * @var int 分页号
     */
    private $_page = 1;


    /**
     * @var int 作者ID
     */
    private $_authorId;

    protected function __construct() {
        $this->_cacheUpdateFrequency = 'daily';
        $this->_cacheInterval = 3600*24; // 缓存保留一天
    }

    /**
     * 获取实例
     *
     * @since   2.0.0
     * @param   int    $page   分页号
     * @param   int    $author_id   作者ID
     * @return  static
     */
    public static function getInstance($page = 1, $author_id = 0) {
        $instance = new static(); // 因为不同分页不同作者共用该模型，不采用单例模式
        $instance->_cacheKey = 'tt_cache_' . $instance->_cacheUpdateFrequency . '_vm_' . __CLASS__ . '_author' . $author_id . '_page' . $page;
        $instance->_page = max(1, $page);
        $instance->_authorId = $author_id;
        $instance->configInstance();
        return $instance;
    }

    protected function getRealData() {
        $posts_per_page = get_option('posts_per_page', 10);
        $star_post_ids = tt_get_user_star_post_ids($this->_authorId);
        $offset = ($this->_page - 1) * $posts_per_page;
        $current_post_ids = array_slice($star_post_ids, $offset, $posts_per_page);
        if(count($current_post_ids) == 0) {
            return (object)array(
                'pagination' => null,
                'uc_star_posts' => array()
            );
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged' => 1,
            //'showposts' => count($current_post_ids),
            'post__in' => $current_post_ids,
            'has_password' => false,
            'ignore_sticky_posts' => true,
            'orderby' => 'date', // modified - 如果按最新编辑时间排序
            'order' => 'DESC'
        );

        $query = new WP_Query($args);
        //$GLOBALS['wp_query'] = $query; // 取代主循环(query_posts只返回posts，为了获取其他有用数据，使用WP_Query)

        $uc_star_posts = array();
        $pagination = array(
            'max_num_pages' => ceil(count($star_post_ids) / $posts_per_page),
            'current_page' => $this->_page,
            'base' => str_replace('999999999', '%#%', get_pagenum_link(999999999))
        );

        while ($query->have_posts()) : $query->the_post();
            $uc_star_post = array();
            global $post;
            $uc_star_post['ID'] = $post->ID;
            $uc_star_post['title'] = get_the_title($post);
            $uc_star_post['permalink'] = get_permalink($post);
            $uc_star_post['comment_count'] = $post->comment_count;
            $uc_star_post['excerpt'] = get_the_excerpt($post);
            $uc_star_post['category'] = get_the_category_list(' ', '', $post->ID);
            $uc_star_post['author'] = get_the_author();
            $uc_star_post['author_url'] = home_url('/@' . $uc_star_post['author']); //TODO the link
            $uc_star_post['time'] = get_post_time('F j, Y', false, $post, false); //get_post_time( string $d = 'U', bool $gmt = false, int|WP_Post $post = null, bool $translate = false )
            $uc_star_post['datetime'] = get_the_time(DATE_W3C, $post);
            $uc_star_post['thumb'] = tt_get_thumb($post, 'medium');
            $uc_star_post['format'] = get_post_format($post) ? : 'standard';

            $uc_star_posts[] = $uc_star_post;
        endwhile;

        wp_reset_postdata();

        return (object)array(
            'pagination' => $pagination,
            'uc_star_posts' => $uc_star_posts
        );
    }
}