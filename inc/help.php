<section>
<article>
<h1><?php echo $osofflineim; ?> <span class="pull-right">Help</span></h1>
This is a Offline IM Web Interface for Open Simulator
</article>

<article>
    <h2>Features</h2>
    Offline IM V1 Compatible<br />
    Read Oflline IM<br />
    Delete Oflline IM<br />
</article>

<article>
    <h2>Requierment</h2>
    Mysql, Php5, Apache<br />
</article>

<article>
    <h2>Download</h2>
    <a class="btn btn-default btn-success btn-xs" href="https://github.com/djphil/osofflineim" target="_blank">
    <i class="glyphicon glyphicon-save"></i> GithHub</a> Source Code
</article>

<article>
    <h2>Install</h2>
    <h3>OpenSim.ini</h3>
    <pre>
    [Messaging]
    InstantMessageModule = InstantMessageModule
    ; MessageTransferModule = MessageTransferModule
    OfflineMessageModule = OfflineMessageModule
    OfflineMessageURL = "${Const|BaseURL}/osofflineim/inc/offline.php"
    MuteListModule = MuteListModule
    MuteListURL = "${Const|BaseURL}/osofflineim/inc/mute.php"
    ForwardOfflineGroupMessages = true
    </pre>

    <h3>Optional</h3>
    If you get: "File does not exist: /var/www/osofflineim/RetrieveMessages/"<br />
    or "System: User is not logged in. Message saved"<br />
    or "Message not saved"
    <ol>
        <li>enable the mod_rewrite.so module in apache</li>
        <li>Create a .htaccess in osofflineim/inc</li>
    </ol>
    <h3>.htaccess</h3>
    <pre>
    RewriteEngine On
    RewriteCond %{REQUEST_URI}  "!^/index.php$"
    RewriteRule "^(.*)$" "index.php" [L]
    </pre>
</article>

<article>
    <h2>License</h2>
    GNU/GPL General Public License v3.0<br />
</article>

<article>
    <h2>Credit</h2>
    Philippe Lemaire (djphil)
</article>

<article>
    <h2>Donation</h2>
    <?php include_once("inc/paypal.php"); ?>
</article>

</section>
