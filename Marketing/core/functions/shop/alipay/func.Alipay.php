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
 * 获取支付宝接口配置参数
 *
 * @since 2.0.0
 * @return array
 */
function tt_get_alipay_config() {
    $alipay_config = array();
    $alipay_config['partner'] = tt_get_option('tt_alipay_partner');;
    $alipay_config['key'] = tt_get_option('tt_alipay_key');;
    $alipay_config['sign_type'] = strtoupper('MD5');
    $alipay_config['input_charset'] = strtolower('utf-8');
    $alipay_config['cacert'] = THEME_FUNC . '/shop/alipay/cacert.pem'; //getcwd().'/cacert.pem';
    $alipay_config['transport'] = is_ssl() ? 'https' : 'http';

    return $alipay_config;
}
