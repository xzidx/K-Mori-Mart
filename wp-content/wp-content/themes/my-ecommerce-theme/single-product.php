<?php get_header(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="feture-product">
    <h1>Product details</h1>
</div>

<div class="product-details-box">

    <div class="product-details-img">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
        <?php endif; ?>
    </div>

    <div class="product-details-info">

        <!-- Product Title -->
        <h1><?php the_title(); ?></h1>

        <!-- Product Category -->
        <span>
            <?php
            $terms = get_the_terms(get_the_ID(), 'category');
            if ($terms && !is_wp_error($terms)) {
                echo esc_html($terms[0]->name);
            }
            ?>
            <div class="from"><span>From:</span> Cambodia</div>
        </span>
           
        <!-- Stock Status -->
        <h6>
            <?php 
            $stock = (int) get_post_meta(get_the_ID(), '_stock', true);
            echo ($stock > 0) ? 'Available (' . $stock . ')' : 'Out of stock'; 
            ?>
        </h6>

        <!-- Description -->
        <span>Description</span>
        <?php the_content(); ?>

        <!-- Price + Quantity -->
        <div class="price-row-deatils">
            <div class="price">
                $<?php echo esc_html(get_post_meta(get_the_ID(), '_price', true)); ?>
            </div>

            <div class="qty-details">
                <button class="remove">-</button>
                <input type="text" value="1">
                <button class="add">+</button>
            </div>
        </div>

        <!-- Buttons -->
        <div class="action-buttons-product">
            <button class="buy-product" <?php echo ($stock <= 0) ? 'disabled' : ''; ?>>
                Buy <i class="fa-solid fa-cart-arrow-down"></i>
            </button>
            <br><br>
            <button class="cart-product" <?php echo ($stock <= 0) ? 'disabled' : ''; ?>>
                Add <i class="fa-solid fa-basket-shopping"></i>
            </button>
        </div>

        <!-- Delivery Info -->
        <h2>
            <i class="fa-solid fa-truck deli-icon"></i>
            Estimated delivery 5–7 days
        </h2>

        <!-- Support -->
        <h3>Let us know about your query!</h3>

    </div>
</div>

<div class="feture-product">
    <h1>You may also like</h1>
</div>

<div class="product-grid">
<?php
$featured_products = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 6,
    'meta_query' => [['key' => '_featured','value' => '1']]
]);

if ($featured_products->have_posts()) :
    while ($featured_products->have_posts()) : $featured_products->the_post();
        $price = get_post_meta(get_the_ID(), '_price', true);
        $stock = (int) get_post_meta(get_the_ID(), '_stock', true);
?>
<div class="product">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
    <h3><?php the_title(); ?></h3>
    <div class="country">From: Cambodia</div>
    <div class="status <?php echo ($stock>0)?'available':'not-available'; ?>">
        <?php echo ($stock>0) ? 'Available ('.$stock.')' : 'Out of stock'; ?>
    </div>
    <div class="price-row">
        <div class="price">$<?php echo esc_html($price); ?></div>
        <div class="qty">
            <button>-</button>
            <input type="text" value="1">
            <button>+</button>
        </div>
    </div>
    <div class="action-buttons">
        <button class="buy" <?php echo ($stock <= 0) ? 'disabled' : ''; ?>>Buy <i class="fa-solid fa-cart-arrow-down"></i></button>
        <button class="cart" <?php echo ($stock <= 0) ? 'disabled' : ''; ?>>Add <i class="fa-solid fa-basket-shopping"></i></button>
    </div>
</div>
<?php
    endwhile;
    wp_reset_postdata();
else:
    echo '<p>No featured products.</p>';
endif;
?>
</div>

<?php get_footer(); ?>
