<div class="content">
    <h2 style="color:#3399FF"><?php echo $title;?></h2>
    <div class="line" style="background-color:#CCCCCC"></div>
    <?php
    if($_GET['id']=='productions' && !$_GET['item']){
        include 'modules/list_item.php';
    }elseif($_GET['id']=='productions' && $_GET['item']){
        include 'modules/item.php';
    }elseif($_GET['id']=='select'){
        include 'modules/select.php';
    }elseif($_GET['id']=='actions'){
        include 'modules/actions.php';
    }else{
        echo $body->content();
    }
    ?>
</div>