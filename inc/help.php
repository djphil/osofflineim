<section>

<article>
    <h1>Help<i class="glyphicon glyphicon-education pull-right"></i></h1>
    Welcome to the <?php echo $title." v".$version; ?><br />
    This is a Offline IM V2 Web Interface for OpenSimulator

</article>

<article>
    <h2>Features</h2>
    Read/Delete Oflline IM
</article>

<article>
    <h2>Requierment</h2>
    Mysql, Php5, Apache<br />
    Offline IM V2
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
    OfflineMessageModule = "Offline Message Module V2"
    StorageProvider = OpenSim.Data.MySQL.dll
    MuteListModule = MuteListModule
    MuteListURL = "${Const|BaseURL}/osofflineim/inc/mute.php"
    ForwardOfflineGroupMessages = true
    </pre>

    <h3>Super Admin</h3>
    Super Admin can reorder all offline IM id <a href="?reorder">here</a>
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
    <p><?php include_once("inc/paypal.php"); ?></p>
</article>

</section>
