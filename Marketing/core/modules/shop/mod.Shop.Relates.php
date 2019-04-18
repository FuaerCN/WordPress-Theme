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
<?php global $productdata; ?>
<section class="related-products">
    <h2><span><?php _e('Related Products', 'tt'); ?></span></h2>
    <ul class="products row">
        <?php $relates = $productdata->relates; ?>
        <?php foreach ($relates as $relate) { ?>
            <?php $relate_rating = $relate['rating']; ?>
            <li class="col-md-3 col-sm-4 col-xs-6 product">
                <a href="<?php echo $relate['permalink']; ?>" title="<?php echo $relate['title']; ?>">
                    <img class="lazy" src="<?php echo LAZY_PENDING_IMAGE; ?>" data-original="<?php echo $relate['thumb']; ?>" alt="<?php echo $relate['title']; ?>" title="<?php echo $relate['title']; ?>">
                    <h3><?php echo $relate['title']; ?></h3>
                    <div class="star-rating tico-star-o" title="<?php printf(__('Rated %0.1f out of 5', 'tt'), $relate_rating['value']); ?>">
                        <span class="tico-star" style="<?php echo sprintf('width:%d', $relate_rating['percent']) . '%;'; ?>">
                            <?php printf(__('<strong itemprop="ratingValue" class="rating">%0.1f</strong> out of <span itemprop="bestRating">5</span>based on <span itemprop="ratingCount" class="rating">%d</span> customer ratings', 'tt'), $relate_rating['value'], $relate_rating['count']); ?>
                        </span>
                    </div>
                    <div class="price">
                        <?php if(!($relate['price'] > 0)) { ?>
                            <span class="price price-free"><?php _e('FREE', 'tt'); ?></span>
                        <?php }elseif(!isset($relate['discount'][0]) || $relate['min_price'] >= $relate['price']){ ?>
                            <span class="price"><?php echo $relate['price_icon']; ?><?php echo $relate['price']; ?></span>
                        <?php }else{ ?>
                            <del><span class="price original-price"><?php echo $relate['price_icon']; ?><?php echo $relate['price']; ?></span></del>
                            <?php echo $relate['price_icon']; ?><ins><span class="price discount-price"><?php echo $relate['min_price']; ?></span></ins>
                        <?php } ?>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>