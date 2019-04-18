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

tt_get_header('simple');

$open_type = strtolower(get_query_var('oauth'));

?>
<body class="is-loadingApp oauth-page oauth-last">
    <?php load_template(THEME_MOD . '/mod.LogoHeader.php'); ?>
    <div id="content" class="wrapper container no-aside">
        <div class="main inner-wrap">
            <div class="form-account">
                <h2 class="form-account-heading"><?php _e('The Last Step, Complete Basic Account Info', 'tt'); ?></h2>
                <input type="hidden" id="oauthType" value="<?php echo $open_type; ?>">
                <label for="inputUsername" class="sr-only"><?php _e('Email', 'tt'); ?></label>
                <input type="text" id="inputUsername" class="form-control" placeholder="<?php _e('Email', 'tt'); ?>" required="required">
                <label for="inputPassword" class="sr-only"><?php _e('Repeat Password', 'tt'); ?></label>
                <input type="password" id="inputPassword" class="form-control" placeholder="<?php _e('Password', 'tt'); ?>" required="required">
                <button class="btn btn-lg btn-primary btn-block" id="bind-account" type="submit"><?php _e('Bind', 'tt'); ?></button>
            </div>
        </div>
    </div>

<?php

tt_get_footer('simple');