<?php
/*
 * OpenSimulator Functions
 * Version: 0.0.1
 * Author: Philippe Lemaire (djphil)
 * License: CC-BY-NC-SA 2.0 BE
 * Guarantee: None, any, no, zero
 */
 
function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

function delete_im($db, $tbname, $id, $uuid)
{
    try {
        $sql = $db->prepare("
            DELETE FROM ".$tbname."
            WHERE ID = :ID
            AND PrincipalID = :PrincipalID
        ");
        $sql->bindValue(':ID', $id, PDO::PARAM_INT);
        $sql->bindValue(':PrincipalID', $uuid, PDO::PARAM_STR);
        $sql->execute();
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

function delete_all_im($db, $tbname, $uuid)
{
    try {
        $sql = $db->prepare("
            DELETE FROM ".$tbname."
            WHERE PrincipalID = :PrincipalID
        ");
        $sql->bindValue(':PrincipalID', $uuid, PDO::PARAM_STR);
        $sql->execute();
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
