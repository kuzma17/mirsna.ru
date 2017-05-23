<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 24.05.17
 * Time: 0:52
 */

if(!$_GET['id'] || $_GET['id']=='home'){
    echo '<link rel="stylesheet" type="text/css" href="css/slideshow.css" />
';}
if($_GET['item']){
    echo '<script type="text/JavaScript" src="js/cloud-zoom.js"></script>
<link rel="stylesheet" type="text/css" href="css/cloud-zoom.css" />
';}
?>