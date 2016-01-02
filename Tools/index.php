<?php
require_once('installation/config.php');
include(ROOT_PATH.'inc/functions.php');

$page = 'home';
if(isset($_GET['page'])) { $page = $_GET['page']; }
include(ROOT_PATH . 'inc/header.php');
if($page == 'tool1'){ include(ROOT_PATH . 'pages/tool1.php'); }
if($page == 'tool2'){ include(ROOT_PATH . 'pages/tool2.php'); }
if($page == 'home'){ include(ROOT_PATH . 'pages/home.php'); }
?>

</body>
</html>