<?php get_header(); ?>
<?php $price=get_post_meta(get_the_ID(),'_price',true); $stock=get_post_meta(get_the_ID(),'_stock',true); ?>
<h1><?php the_title(); ?></h1>
<div class="product-single">
<div><?php the_post_thumbnail('large'); ?></div>
<div>
<p><strong>Price:</strong> $<?php echo $price; ?></p>
<p><strong>Stock:</strong> <?php echo $stock; ?></p>
<?php the_content(); ?>
</div>
</div>
<?php get_footer(); ?>