<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {die('Access denied ...');} ?>
<?php
$_SESSION['flash']['success'] = "You are disconnected successfully ".$_SESSION["username"]." ...";
unset($_SESSION["valid"]);
unset($_SESSION["username"]);
unset($_SESSION['useruuid']);
echo '<script>document.location.href="?login"</script>';
?>