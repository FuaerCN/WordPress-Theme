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
 * Class MgMembersVM
 */
class MgMembersVM extends BaseVM {
    /**
     * @var int  分页
     */
    protected $_page = 1;

    protected function __construct() {
        $this->_cacheUpdateFrequency = 'daily';
        $this->_cacheInterval = 3600*24; // 缓存保留一天
    }

    /**
     * 获取实例
     *
     * @since   2.0.0
     * @param   $page
     * @return  static
     */
    public static function getInstance($page = 1) {
        $instance = new static();
        $instance->_cacheKey = 'tt_cache_' . $instance->_cacheUpdateFrequency . '_vm_' . __CLASS__ . '_page' . $page;
        $instance->_page = $page;
        $instance->_enableCache = false; //不使用缓存
        $instance->configInstance();
        return $instance;
    }

    protected function getRealData() {
        $limit = 20; // 每页20条
        $members = tt_get_vip_members(-1, $limit, ($this->_page - 1) * $limit);
        $count = $members ? count($members) : 0;
        $total_count = tt_count_vip_members(-1);
        $max_pages = ceil($total_count / $limit);
        $pagination_base = tt_url_for('manage_members') . '/page/%#%';

        return (object)array(
            'count' => $count,
            'members' => $members,
            'total' => $total_count,
            'max_pages' => $max_pages,
            'pagination_base' => $pagination_base,
            'prev_page' => str_replace('%#%', max(1, $this->_page - 1), $pagination_base),
            'next_page' => str_replace('%#%', min($max_pages, $this->_page + 1), $pagination_base)
        );
    }
}