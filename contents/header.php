
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="<?php echo $pathToIndex; ?>"><img class="invertcolor" src="<?php echo $pathToIndex; ?>/images/logo.png" alt="Movies"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         
         <div class="nav navbar-right">
            <form class="navbar-form navbar-left hidden-xs" method="GET" action="search" accept-charset="UTF-8" id="quick-search" name="quick-search">
                    <div class="form-group" id="quick-search-container">
                        <input id="quick-search-input" name="term" autocomplete="off" type="search" value="<?php echo $lang['SEARCH_QUICK']; ?>">
                        <div class="ajax-spinner" style="background-position: -16px 0px;"></div>
                    </div>
            </form>

            <ul class="nav navbar-nav hidden-sm hidden-md hidden-lg hidden-xl">
                <li><a href="/"><?php echo $lang['SEARCH']; ?></a></li>
            </ul>

            <ul class="nav navbar-nav">
                <li><a href="<?php echo $pathToIndex; ?>"><?php echo $lang['PAGE_HOME']; ?></a></li>
                <li><a href="<?php echo $pathToIndex; ?>"><?php echo $lang['PAGE_BROWSE_MOVIES']; ?></a></li>
            </ul>

            <ul class="nav navbar-nav nav-username">
                <?php if( $userClass != null )
                { ?>
                <li><a class="user-nav-btn" href="/pelis/user/<?php echo $userClass->getUsername(); ?>"><span class="glyphicon glyphicon-user"> <?php echo $userClass->getUsername(); ?></a></li>
                <?php if( $userClass->isAdmin() )
                { ?>
                <li><a class="logout-nav-btn" href="/pelis/admin"><span title="admin" class="glyphicon glyphicon-cog"></a></li>
                <?php } ?>
                <li><a class="logout-nav-btn" href="/pelis/logout"><span title="<?php echo $lang['LOGIN_OUT']; ?>" class="glyphicon glyphicon-off"></a></li>
                <?php
                }
                else 
                { ?>
                <li><a class="login-nav-btn" href="javascript:void(0)"><span class="glyphicon glyphicon-log-in"> <?php echo $lang['LOGIN_LOGIN']; ?></a></li>
                <li><a class="register-nav-btn" href="javascript:void(0)"><span class="glyphicon glyphicon-user"> <?php echo $lang['LOGIN_REGISTER']; ?></a></li>
                <?php } ?>
            </ul>

        </div>
        </div><!--/.nav-collapse -->
      </div>
      </nav>

