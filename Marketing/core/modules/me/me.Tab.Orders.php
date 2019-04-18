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
<?php global $tt_me_vars; $tt_user_id = $tt_me_vars['tt_user_id']; $tt_filter_type = get_query_var('me_grandchild_route'); $tt_page = $tt_me_vars['tt_paged']; ?>
<div class="col col-md-10 col-right orders">
    <?php $vm = MeOrdersVM::getInstance($tt_user_id, $tt_filter_type, $tt_page); ?>
    <?php if($vm->isCache && $vm->cacheTime) { ?>
        <!-- User orders cached <?php echo $vm->cacheTime; ?> -->
    <?php } ?>
    <?php $data = $vm->modelData; $orders = $data->orders; $count = $data->count; $total = $data->total; $max_pages = $data->max_pages; ?>
    <div class="me-tab-box orders-tab">
        <div class="tab-content me-orders">
            <!-- 订单列表 -->
            <section class="my-orders clearfix">
                <header><h2><?php _e('My Orders', 'tt'); ?></h2></header>
                <div class="info-group clearfix">
                    <div class="col-md-6 orders-info">
                        <span><?php printf(__('%d order records in total', 'tt'), $total); ?></span>
                    </div>
                    <div class="col-md-6 orders-filter">
                        <label><?php _e('Orders Type', 'tt'); ?></label>
                        <select class="form-control select select-primary" data-toggle="select" onchange="document.location.href=this.options[this.selectedIndex].value;">
                            <option value="<?php echo tt_url_for('my_all_orders'); ?>" <?php if(strtolower($tt_filter_type) == 'all') echo 'selected'; ?>><?php _e('ALL', 'tt'); ?></option>
                            <option value="<?php echo tt_url_for('my_cash_orders'); ?>" <?php if(strtolower($tt_filter_type) == 'cash') echo 'selected'; ?>><?php _e('CASH', 'tt'); ?></option>
                            <option value="<?php echo tt_url_for('my_credit_orders'); ?>" <?php if(strtolower($tt_filter_type) == 'credit') echo 'selected'; ?>><?php _e('CREDIT', 'tt'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="table table-striped table-framed table-centered">
                        <thead>
                        <tr>
                            <th class="th-oid"><?php _e('Order Id', 'tt'); ?></th>
                            <th class="th-title"><?php _e('Product Name', 'tt'); ?></th>
                            <th class="th-time"><?php _e('Order Create Time', 'tt'); ?></th>
                            <th class="th-sumprice"><?php _e('Order Total Price', 'tt'); ?></th>
                            <th class="th-status"><?php _e('Order Status', 'tt'); ?></th>
                            <th class="th-actions"><?php _e('Actions', 'tt'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order){ ?>
                            <tr id="oid-<?php echo $order->order_id; ?>">
                                <td><?php echo $order->order_id; ?></td>
                                <td><?php if($order->product_link){ ?><a href="<?php echo $order->product_link; ?>" target="_blank"><?php echo $order->product_name; ?></a><?php }else{echo $order->product_name;} ?></td>
                                <td><?php echo $order->order_time; ?></td>
                                <td><?php if($order->order_currency == 'credit'){ echo '<i class="tico tico-diamond"></i>' . intval($order->order_total_price); }else{ echo '<i class="tico tico-cny"></i>' . sprintf('%0.2f', $order->order_total_price); } ?></td>
                                <td><?php echo $order->parent_id > 0 ? 'N/A(子订单)' : tt_get_order_status_text($order->order_status); ?></td>
                                <td>
                                    <div class="order-actions">
                                        <a class="view-detail" href="<?php echo tt_url_for('my_order', $order->id); ?>" title="<?php _e('View the order detail', 'tt'); ?>" target="_blank"><?php _e('View Order', 'tt'); ?></a>
                                        <?php if(!in_array($order->order_status, [OrderStatus::PAYED_AND_WAIT_DELIVERY, OrderStatus::DELIVERED_AND_WAIT_CONFIRM, OrderStatus::TRADE_SUCCESS])) { ?>
                                            <?php if($order->order_status == OrderStatus::WAIT_PAYMENT && $order->parent_id < 1) { ?>
                                                <span class="text-explode">|</span>
                                                <a class="continue-pay" href="javascript:;" data-order-action="continue_pay" data-order-id="<?php echo $order->order_id; ?>" data-order-seq="<?php echo $order->id; ?>" title="<?php _e('Finish the payment', 'tt'); ?>"><?php _e('Continue Pay', 'tt'); ?></a>
                                            <?php } ?>
                                            <?php if($order->parent_id < 1) { ?>
                                                <span class="text-explode">|</span>
                                                <a class="delete-order" href="javascript:;" data-order-action="delete" data-order-id="<?php echo $order->order_id; ?>" data-order-seq="<?php echo $order->id; ?>" title="<?php _e('Delete the order', 'tt'); ?>"><?php _e('Delete', 'tt'); ?></a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if($max_pages > 1) { ?>
                    <div class="pagination-mini clearfix">
                        <?php if($tt_page == 1) { ?>
                            <div class="col-md-3 prev disabled"><a href="javascript:;"><?php _e('← 上一页', 'tt'); ?></a></div>
                        <?php }else{ ?>
                            <div class="col-md-3 prev"><a href="<?php echo $data->prev_page; ?>"><?php _e('← 上一页', 'tt'); ?></a></div>
                        <?php } ?>
                        <div class="col-md-6 page-nums">
                            <span class="current-page"><?php printf(__('Current Page %d', 'tt'), $tt_page); ?></span>
                            <span class="separator">/</span>
                            <span class="max-page"><?php printf(__('Total %d Pages', 'tt'), $max_pages); ?></span>
                        </div>
                        <?php if($tt_page != $data->max_pages) { ?>
                            <div class="col-md-3 next"><a href="<?php echo $data->next_page; ?>"><?php _e('下一页 →', 'tt'); ?></a></div>
                        <?php }else{ ?>
                            <div class="col-md-3 next disabled"><a href="javascript:;"><?php _e('下一页 →', 'tt'); ?></a></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </section>
        </div>
    </div>
</div>