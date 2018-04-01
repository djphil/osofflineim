<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {die('Access denied ...');} ?>
<?php if (isset($_SESSION['valid'])): ?>
    <h1>Home<i class="glyphicon glyphicon-home pull-right"></i></h1>
<?php endif; ?>

<?php
// DELETE OFFLINE IM
if (isset($_POST['deleteIM']) && !empty($_POST['deleteIM']))
{
    if (!empty($_POST['id']) && !empty($_POST['useruuid']))
    {
        $id = $_POST['id'];
        $useruuid = $_POST['useruuid'];
        delete_im($db, $tbname, $id, $useruuid);
        $_SESSION['flash']['success'] = 'Oflline IM from '.$useruuid.' deleted successfully ...';
    }
}

// DELETE ALL OFFLINE IM
if (isset($_POST['deleteAllIM']) && !empty($_POST['deleteAllIM']))
{
    if (!empty($_POST['useruuid']))
    {
        $useruuid = $_POST['useruuid'];
        delete_all_im($db, $tbname, $useruuid);
        $_SESSION['flash']['success'] = 'All Oflline IM from '.$useruuid.' deleted successfully ...';
    }
}
?>

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
// DISPLAY OFFLINE IM
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) 
{
    try {
        $sql = $db->prepare("
            SELECT *
            FROM ".$tbname."
            WHERE PrincipalID = ?
        ");
        $sql->bindValue(1, $_SESSION['useruuid'], PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $counter = 0;

            echo '<div class="table-responsive">';
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
                $id             = $row['ID'];
                $from           = $row['PrincipalID'];
                $message        = $row['Message'];
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
                            echo '<input class=hidden name="id" value="'.$id.'">';
                            echo '<input class=hidden name="useruuid" value="'.$_SESSION['useruuid'].'">';
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
            echo '</div>';

            echo '<form action="" method="post">';
            echo '<input class=hidden name="useruuid" value="'.$_SESSION['useruuid'].'">';
            echo '<button class="btn btn-danger" type="submit" name="deleteAllIM" value="'.$_SESSION['useruuid'].'">';
            echo '<i class="glyphicon glyphicon-trash"></i> Delete All my Offline IM</button>';
            echo '</form>';
        }

        // NO OFFLINE IM
        else
        {
            echo '<p>You have actually <span class="badge">0</span> Offline IM '.$_SESSION['username'].' ...</p>';
        }

        $sql->closeCursor();
        $db = NULL;
    }

    catch(PDOException $e) {
        $message = '
            <pre>
                Unable to query database ...
                Error code: '.$e->getCode().'
                Error file: '.$e->getFile().'
                Error line: '.$e->getLine().'
                Error data: '.$e->getMessage().'
            </pre>
        ';
        die($message);
    }
}
?>
