<?php
/*
Template Name: Front Page Template
*/
?>

<?php get_header(); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

<div class="banner">
    <img src="../wp-content/uploads/l.jpg" alt="">
    <form class="search-box">
        <input type="text" placeholder="Search...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass icon-find"></i></button>
    </form>
</div>

<div class="category-text"><h1>Category</h1></div>
<div class="category-row">

<?php
$categories = get_terms([
    'taxonomy' => 'product_category',
    'hide_empty' => false,
]);

$category_images = [
    0 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/clean-1.avif',
    1 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/clock.jpeg',
    2 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/grill.webp',
    3 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/heater.png',
    4 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/knfie.jpeg',
    5 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/laundry.webp',
    6 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/papaper.avif',
    7 => 'http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/toools.png',
];

if (!empty($categories) && !is_wp_error($categories)) :
    foreach ($categories as $index => $category) :
        $image_url = $category_images[$index] ?? '';
?>
<div class="category-item">
    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
    <span><?php echo esc_html($category->name); ?></span>
</div>
<?php
    endforeach;
endif;
?>
</div>

<!-- Featured Products -->
<h1 class="feture-product">Featured Products</h1>
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
        <button class="buy">Buy <i class="fa-solid fa-cart-arrow-down"></i></button>
        <button class="cart">Add <i class="fa-solid fa-basket-shopping"></i></button>
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

<div class="more-product">More products</div>

<!-- Latest Products -->
<h1 class="last-product">Latest Products</h1>
<div class="product-grid">
<?php
$featured_ids = get_posts([
    'post_type' => 'product',
    'posts_per_page' => -1,
    'meta_key' => '_featured',
    'meta_value' => '1',
    'fields' => 'ids'
]);

$latest_products = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => $featured_ids
]);

if ($latest_products->have_posts()) :
    while ($latest_products->have_posts()) : $latest_products->the_post();
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
        <button class="buy">Buy <i class="fa-solid fa-cart-arrow-down"></i></button>
        <button class="cart">Add <i class="fa-solid fa-basket-shopping"></i></button>
    </div>
</div>
<?php
    endwhile;
    wp_reset_postdata();
else:
    echo '<p>No latest products found.</p>';
endif;
?>
</div>

<div class="more-product">More products</div>

<!-- Best Offer -->
<h1 class="best-offer">Best Offer</h1>
<div class="best-offer-box">
<div class="best-offer-discount">
    <img src="http://K_Mori_Mart_website.test/wp-content/uploads/2025/12/discount-mb.jpg" alt="">
</div>

<?php
$products = get_posts([
    'post_type' => 'product',
    'posts_per_page' => 4,
    'orderby' => 'rand',
]);

if($products):
    foreach($products as $index => $p):
        $price = get_post_meta($p->ID, '_price', true);
        $stock = (int) get_post_meta($p->ID, '_stock', true);
        $img = get_the_post_thumbnail_url($p->ID, 'medium');
        $title = $p->post_title;
?>
<div class="best-offer-card">
    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
    <h3><?php echo esc_html($title); ?></h3>
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
        <button class="buy">Buy <i class="fa-solid fa-cart-arrow-down"></i></button>
        <button class="cart">Add <i class="fa-solid fa-basket-shopping"></i></button>
    </div>
</div>
<?php
    endforeach;
    wp_reset_postdata();
endif;
?>
</div>

<?php get_footer(); ?>
