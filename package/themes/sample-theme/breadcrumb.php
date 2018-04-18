<?php 
if (!empty($breadcrumbs)) { 
    $num_items = count($breadcrumbs); //used to find last item in array
    $i = 0;
?>
<ol class="breadcrumb">
    <?php foreach($breadcrumbs as $breadcrumb) { ?>
        <?php if (++$i === $num_items) { ?>
            <li class="active"><?php echo $breadcrumb['title']; ?></li>
        <?php } else { ?>
            <li>
                <?php if (empty($breadcrumb['url'])) { ?>
                    <?php echo $breadcrumb['title']; ?>
                <?php } else { ?>
                    <a href="<?php echo $breadcrumb['url']; ?>"><?php echo $breadcrumb['title']; ?></a>
                <?php } ?>
            </li>
        <?php } ?>
    <?php } ?>
</ol>
<?php 
} 
?>