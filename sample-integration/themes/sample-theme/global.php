<!DOCTYPE html>
<html>
<head>

    <title><?php echo $title ?></title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keyword" content="<?php echo $keywords; ?>">

    <!-- LOTUSCMS - LOAD PAGE LEVEL CSS -->
    <!-- package styles -->
    <?php foreach ($package_css_files as $cssfile) { ?>
        <link href="<?php echo $cssfile ?>?ver=<?php echo config_item('script_version'); ?>" rel="stylesheet" type="text/css" />
    <?php } ?>
        
    <?php foreach ($css_files as $css) { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $css ?>?ver=<?php echo config_item('script_version'); ?>">
    <?php } ?>

    <?php if (config_item('release') == 'production') { ?>
    <!-- LOTUSCMS - LOAD UP SCRIPTS THAT YOU WANT ON PRODUCTION ONLY.  SUCH AS GOOGLE ANALYTICS -->
    <?php } ?>
</head>

<body class="<?php echo $page_class; ?>" data-baseurl="<?php echo base_url() ?>" data-currenturl="<?php echo current_url(); ?>">

    <?php if ($header) { ?>
        <?php echo $header ?>
    <?php } ?>
    
    <?php if ($page_title) { ?>
        <?php echo $page_title ?>
    <?php } ?>
    
    <?php if ($sidebar) { ?>
        <?php echo $sidebar ?>
    <?php } ?>

    <?php echo $content ?>

    <?php if ($footer) { ?>
        <?php echo $footer ?>
    <?php } ?>

    <!-- package scripts -->
    <?php foreach ($package_js_files as $jsfile) { ?>
        <script src="<?php echo $jsfile ?>?ver=<?php echo config_item('script_version'); ?>" type="text/javascript"></script>
    <?php } ?>
    
    <?php foreach ($js_files as $js) { ?>
        <script src="<?php echo $js ?>?ver=<?php echo config_item('script_version'); ?>" type="text/javascript"></script>
    <?php } ?>
</body>