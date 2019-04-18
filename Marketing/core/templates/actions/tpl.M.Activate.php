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

wp_no_robots();

// 激活注册
if (!isset($_GET['key'])) :
    wp_die(__('Can not activate your registration, the link your visit is incorrect.', 'tt'), __('Invalid Activation Link', 'tt'), array('response' => 404));
else :
    $key = sanitize_text_field($_GET['key']);
    // $api = rest_url('/v1/users');
    // $response = wp_remote_post($api, array('key' => $key)); // 对自身GET POST会timeout
    // $body = wp_remote_retrieve_body($response);
    // $data_obj = is_string($body) ? json_decode($body) : (object)array();
    $result = tt_activate_registration_from_link($key);
    $data_obj = is_array($result) ? (object)$result : (object)array();
    if(is_wp_error($result) || !$data_obj || !isset($data_obj->success) || intval($data_obj->success) != 1) {
        wp_die(__('Can not activate your registration, please try again the registration steps.', 'tt'), __('Activate Registration Failed', 'tt'), array('response' => 200));
    }

// 引入头部
tt_get_header('simple');
?>
<body class="is-loadingApp action-page activate">
<?php load_template(THEME_MOD . '/mod.LogoHeader.php'); ?>
<div id="content" class="wrapper container no-aside">
    <div class="main inner-wrap">

    </div>
</div>
<?php

// 引入页脚
tt_get_footer('simple');
?>
    <script>
        jQuery(function () {
            App.PopMsgbox.success({
                title: "<?php _e('Activate Successfully', 'tt'); ?>",
                text: "<?php _e('You will be redirected to the signin page in 3s', 'tt'); ?>",
                showConfirmButton: false
            });
            setTimeout(function () {
                window.location.href = "<?php echo tt_url_for('signin'); ?>";
            }, 3000);
        });
    </script>
<?php
endif;