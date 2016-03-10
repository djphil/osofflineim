<?php if (isset($_SESSION['valid'])): ?>
    <h1><?php echo $osofflineim; ?>
        <span class="pull-right">
            <form action="" method="post">
                <input class=hidden name="owner" value="<?php echo $_SESSION['useruuid']; ?>">
                <button class="btn btn-danger" type="submit" name="deleteIM" value="<?php echo $_SESSION['useruuid']; ?>">
                <i class="glyphicon glyphicon-trash"></i> Delete</button>
            </form>
        </span>
    </h1>
<?php endif; ?>

<!-- Fash Message -->
<?php if(isset($_SESSION['flash'])): ?>
    <?php foreach($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?php echo $type; ?> alert-anim">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $message; ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<!-- Login Form -->
<?php if (!isset($_SESSION['valid'])): ?>
<form class="form-signin" role="form" action="?login" method="post" >
<h2 class="form-signin-heading">Please login</h2>
    <label for="username" class="sr-only">User name</label>
    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>        
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">
        <i class="glyphicon glyphicon-log-in"></i> Log-in
    </button>
</form>
<?php endif; ?>


<?php 
if (isset($_POST['deleteIM']))
{
    if (!empty($_POST['deleteIM']))
    {
        $sql = $db->prepare("
            DELETE FROM ".$tbname."
            WHERE uuid = '".$_SESSION['useruuid']."'
        ");
        $sql->execute();

        echo '<div class="alert alert-success alert-anim">';
        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        echo '<i class="glyphicon glyphicon-ok"></i> ';
        echo 'All Oflline IM from '.$_SESSION['username'].' deleted successfully ...';
        echo '</div>';
    }
}

if (isset($_SESSION['valid'])) 
{
    $counter = 0;

    // DISPLAY OFFLINE IM
    $sql = $db->prepare("
        SELECT *
        FROM ".$tbname."
        WHERE uuid = '".$_SESSION['useruuid']."'
    ");

    $sql->execute();
    $rows = $sql->rowCount();

    if ($rows <> 0)
    {
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>From avatar</th>';
        echo '<th>Message</th>';
        echo '<th>Date</th>';
        echo '<th>Time</th>';
        echo '<th class="text-right">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $from           = $row['uuid'];
            $message        = $row['message'];
            $xmlstring      = simplexml_load_string($message);
            $xmlstring      = (array)$xmlstring;
            $fromAgentID    = "";
            $fromAgentName  = "";
            $toAgentID      = "";

            foreach ($xmlstring as $key => $value)
            {
                if ($key == "fromAgentID") $fromAgentID = $value;
                if ($key == "fromAgentName") $fromAgentName = $value;
                if ($key == "toAgentID") $toAgentID = $value;

                if ($toAgentID == $_SESSION['useruuid']) 
                {
                    if ($key == "message") $message = $value;

                    if ($key == "timestamp")
                    {
                        $date = date('m/d/Y', $value);
                        $time = date('H:i:s a', $value);

                        echo '<tr>';
                        echo '<td><span class="badge">'.++$counter.'</span></td>';
                        echo '<td>'.$fromAgentName.'</td>';
                        echo '<td>'.$message.'</td>';
                        echo '<td>'.$date.'</td>';
                        echo '<td>'.$time.'</td>';
                        echo '<td class="text-right">';
                        echo '<form action="" method="post">';
                        echo '<input class=hidden name="owner" value="'.$_SESSION['useruuid'].'">';
                        echo '<button class="btn btn-danger btn-xs" type="submit" name="deleteIM" value="'.$fromAgentID.'">';
                        echo '<i class="glyphicon glyphicon-trash"></i> Delete</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
            }
        }

        echo '</tbody>';
        echo '</table>';
    }

    // NO OFFLINE IM
    else if ($rows == 0)
    {
        echo '<p>You have actually <span class="badge">'.$rows.'</span> Offline IM ...</p>';
    }
    unset($sql);
}
?>
