<?php
$_SESSION['flash']['success'] = "You are disconnected successfully ".$_SESSION["username"]." ...";
unset($_SESSION["valid"]);
unset($_SESSION["username"]);
unset($_SESSION['useruuid']);
echo '<script>document.location.href="?login"</script>';
?>