    <nav class="<?php echo $CLASS_NAVBAR; ?>">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
                    <i class="fa fa-windows"></i> <strong>LOGO</strong>
                </a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="<?php echo $CLASS_NAV; ?>">
                    <li <?php if (isset($_GET['home'])) {echo 'class="active"';} ?>>
                        <a href="./?home"><i class="glyphicon glyphicon-home"></i> Home</a>
                   </li>
                    <li <?php if (isset($_GET['help'])) {echo 'class="active"';} ?>>
                        <a href="./?help"><i class="glyphicon glyphicon-education"></i> Help</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="?search" enctype="multipart/form-data" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="Search" placeholder="Search" >
                    <div class="input-group-btn">
                        <button class="btn btn-default" name="search" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
