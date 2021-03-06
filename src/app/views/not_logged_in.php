<?php include('_header.php'); ?>

<form method="post" action="<?php echo APP_CONTEXT . "/"; ?>" name="loginform">
    <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" required />
    <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
    <input id="user_password" type="password" name="user_password" autocomplete="off" required />
    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" checked />
    <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
    <input type="submit" name="login" value="<?php echo WORDING_LOGIN; ?>" />
</form>

<a href="<?php echo APP_CONTEXT . "/register"; ?>"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
<a href="<?php echo APP_CONTEXT . "/password_reset"; ?>"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>

<?php include('_footer.php'); ?>
