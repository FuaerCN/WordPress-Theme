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
 * Class search
 */
class search extends WP_Widget {
    function __construct() {
        parent::__construct(false, __('TT-搜索工具', 'tt'), array( 'description' => __('Marketing专用搜索小工具', 'tt') ,'classname' => 'widget_search wow bounceInRight'));
    }

        function widget($args, $instance) {
        // parent::widget($args, $instance); // TODO: Change the autogenerated stub
        // extract($args);
        wp_reset_postdata();
        
        ?>
        <?php echo $args['before_widget']; ?>
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
        <div style="text-align:center">
        <label class="screen-reader-text" for="s">搜索：</label>
        <input type="text" name="s" placeholder="输入内容搜索一下吧" style="width:60%;height:30px;">
        <button type="submit" class="btn btn-success" id="searchsubmit" value="搜索" style="position:relative;width: 60px;height:30px;margin-left:10px;padding: 0!important;vertical-align: baseline!important;">搜索</button>
        </div></form>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        ?>
        <p>提示：此工具无需配置，直接使用</p>
        <?php
    }
}

/* 注册小工具 */
if ( ! function_exists( 'tt_register_widget_search' ) ) {
    function tt_register_widget_search() {
        register_widget( 'search' );
    }
}
add_action( 'widgets_init', 'tt_register_widget_search' );