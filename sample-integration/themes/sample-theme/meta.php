<?php if (!empty($meta_description)) { ?>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta property="og:description" content="<?php echo $meta_description; ?>" />
<?php } ?>

<?php if (!empty($meta_keyword)) { ?>
    <meta name="keyword" content="<?php echo $meta_keyword; ?>">
<?php } ?>

<link rel="canonical" href="<?php echo current_url(); ?>" />
    
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />

<?php if (!empty($meta_title)) { ?>
    <meta property="og:title" content="<?php echo $meta_title; ?>" />
<?php } ?>

<meta property="og:url" content="<?php echo current_url(); ?>" />
<meta property="og:site_name" content="<?php echo config_item('site_name'); ?>" />
<meta property="article:publisher" content="http://www.facebook.com/carolcharlotteblair" />

<?php if (!empty($meta_images)) { ?>
    <?php if (is_array($meta_images)) { ?>
        <?php foreach ($meta_images as $image) { ?>
            <meta property="og:image" content="<?php echo get_post_image_url($image['filename'], 'regular-hd-'); ?>" />
        <?php } ?>
    <?php } else { ?>
        <meta property="og:image" content="<?php echo get_post_image_url($meta_images, 'regular-hd-'); ?>" />
    <?php } ?>
<?php } ?>
