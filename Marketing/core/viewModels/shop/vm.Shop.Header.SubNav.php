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
 * Class ShopHeaderSubNavVM
 */
class ShopHeaderSubNavVM extends BaseVM {

    protected function __construct() {
        $this->_cacheUpdateFrequency = 'daily';
        $this->_cacheInterval = 3600*24; // 缓存保留一天
    }

    protected function getRealData() {
        $category_terms = get_categories(array(
            'taxonomy'  =>  'product_category'
        ));

        $categories = array();
        foreach ($category_terms as $category_term) {
            $category = array();
            $category['ID'] = $category_term->term_id;
            $category['slug'] = $category_term->slug;
            $category['name'] = $category_term->name;
            $category['description'] = $category_term->description;
            $category['parent'] = $category_term->parent;
            $category['count'] = $category_term->count;
            $category['permalink'] = get_term_link($category_term, 'product_category');

            $categories[] = $category;
        }

        $tag_terms = get_terms('product_tag', array(
            'hide_empty' => false,
            'orderby' => 'count',
            'order' => 'DESC'
        ));

        $tags = array();
        foreach ($tag_terms as $tag_term) {
            $tag = array();
            $tag['ID'] = $tag_term->term_id;
            $tag['slug'] = $tag_term->slug;
            $tag['name'] = $tag_term->name;
            $tag['description'] = $tag_term->description;
            $tag['parent'] = $tag_term->parent;
            $tag['count'] = $tag_term->count;
            $tag['permalink'] = get_term_link($tag_term, 'product_tag');

            $tags[] = $tag;
        }

        //TODO if wp 4.5 above
//        $tags = get_terms(array(
//            'taxonomy' => 'product_tag',
//            'hide_empty' => false,
//            'orderby' => 'count',
//            'order' => 'DESC'
//        ));

        $price_types = array(
            array(
                'type' => 'free',
                'name' => __('Free Products', 'tt'),
                'count' => tt_count_products_by_price_type('free'),
                'url' => add_query_arg(array('type' => 'free'), tt_url_for('shop_archive'))
            ),
            array(
                'type' => 'credit',
                'name' => __('Credit Paid Products', 'tt'),
                'count' => tt_count_products_by_price_type('credit'),
                'url' => add_query_arg(array('type' => 'credit'), tt_url_for('shop_archive'))
            ),
            array(
                'type' => 'cash',
                'name' => __('Cash Paid Products', 'tt'),
                'count' => tt_count_products_by_price_type('cash'),
                'url' => add_query_arg(array('type' => 'cash'), tt_url_for('shop_archive'))
            ),
        );

        return (object)array(
            'categories' => $categories,
            'tags' => $tags,
            'price_types' => $price_types
        );
    }
}