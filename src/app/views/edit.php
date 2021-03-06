<?php include('_header.php'); ?>

<!-- clean separation of HTML and PHP -->
<h2><?php echo htmlspecialchars($_SESSION['user_name']); ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="<?php echo APP_CONTEXT . "/edit"; ?>" name="user_edit_form_name">
    <label for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo htmlspecialchars($_SESSION['user_name']); ?>)
    <input type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
</form><hr/>

<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="<?php echo APP_CONTEXT . "/edit"; ?>" name="user_edit_form_email">
    <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
    <input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo htmlspecialchars($_SESSION['user_email']); ?>)
    <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
</form><hr/>

<form method="post" action="<?php echo APP_CONTEXT . "/edit"; ?>" name="user_edit_form_pgp">
    <label for="user_pgp">Enter your PUBLIC PGP key<br></label>
    <textarea rows="4" cols="50" id="user_pgp"  name="user_pgp" required></textarea>
    <input type="submit" name="user_edit_submit_pgp" value="Change PGP" />
</form><hr/>

<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
<form method="post" action="<?php echo APP_CONTEXT . "/edit"; ?>" name="user_edit_form_password">
    <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
    <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

    <input type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
</form><hr/>

<!-- backlink -->
<a href="<?php echo APP_CONTEXT . "/"; ?>"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
