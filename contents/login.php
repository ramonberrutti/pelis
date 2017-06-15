
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-switcher">
            <span id="modal-login"> <?php echo $lang['LOGIN_LOGIN']; ?> </span>
            <span id="modal-register"> <?php echo $lang['LOGIN_REGISTER']; ?> </span>
        </div>
        <div class="modal-body modal-content2">
                <div class="modal-login-content">
                    <form method="POST" action="/" accept-charset="UTF-8" autocorrect="off" autocapitalize="off" spellcheck="off">
                        <span class="error-msg"></span>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            <input placeholder="<?php echo $lang['LOGIN_USER'] . ' ' . $lang['LOGIN_OR'] . ' ' . $lang['LOGIN_EMAIL'];  ?>" autocorrect="off" autocapitalize="off" spellcheck="off" name="username" type="text">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                            <input placeholder="<?php echo $lang['LOGIN_PASS']; ?>" autocorrect="off" autocapitalize="off" spellcheck="off" name="password" type="password" value="">
                        </div>
                        <button class="button-green" type="button"><span class="glyphicon glyphicon-log-in"></span> <?php echo $lang['LOGIN_LOGIN']; ?></button>
                    </form>
                    <p class="bottom-msg">
                        <a class="forgotpassword-nav-btn" href="javascript:void(0)"><?php echo $lang['LOGIN_FORGOT']; ?></a>
                    </p>
                </div>

                <div class="modal-register-content">
                    <form method="POST" action="/" accept-charset="UTF-8" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off">
                        <span class="error-msg"></span>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            <input placeholder="<?php echo $lang['LOGIN_FNAME']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="firstname" type="text">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            <input placeholder="<?php echo $lang['LOGIN_LNAME']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="lastname" type="text">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            <input placeholder="<?php echo $lang['LOGIN_USER']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="username" type="text">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <input placeholder="<?php echo $lang['LOGIN_EMAIL']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="email" type="email">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                            <input placeholder="<?php echo $lang['LOGIN_PASS']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="password" type="password" value="">
                        </div>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                            <input placeholder="<?php echo $lang['LOGIN_CONFIRM_PASS']; ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="password_confirmation" type="password" value="">
                        </div>
                        <button class="button-green" type="button"><span class="glyphicon glyphicon-user"></span> <?php echo $lang['LOGIN_REGISTER']; ?></button>
                    </form>
                </div>

                <div class="modal-forgotpass-content">
                    <form method="POST" action="/" accept-charset="UTF-8" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off">
                        <span class="error-msg"></span>
                        <p class="info-msg"> <?php echo $lang['LOGIN_FORGOTED']; ?> </p>
                        <div class="inner-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <input placeholder="E-Mail" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" name="email" type="email">
                        </div>
                        <button class="button-green" type="button">Reset Password</button>
                    </form>
                    <p class="bottom-msg">
                        <a class="login-nav-btn" href="javascript:void(0)">Back to login</a>
                    </p>
                </div>

               <div class="modal-activate-account-content">
                    <p class="info-msg">
                        <b>GRACIAS POR REGISTRARSE!</b>
                        <br>
                        BLA BLA BLA.
                        <br><br>
                        Text Text Text <b>Black Black Text jaja</b>.
                    </p>
                </div>

                <div class="modal-loading-content">
                    <img src="images/ajax-spinner.gif" alt="ajax spinner loading">
                    <p class="info-msg"> Loading, please wait </p>
                </div>


      </div>
    </div>
  </div>
</div>