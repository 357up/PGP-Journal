<?php include('_header.php'); ?>

<?php
if( isset($_REQUEST['newEntry']) ) {
?>
	<script language="JavaScript">
        encrypted = false;
    </script>
	<div>
	    <a href="index.php">Cancel / Go Back</a> | <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
	</div>
	<br><br>
	<form method="post" action="index.php" name="newEntry_form" onsubmit="return Validator();">
    	<label for="title">Title</label>
    	<input id="title" type="text" name="title" autocomplete="off" required />
    	<label for="date">Date</label>
    	<input id="date" type="text" name="date" pattern="[0-9]{8,8}" value="<?php echo date("Ymd"); ?>" required />
    	<label for="entry">Post</label><br>
    	<textarea rows="20" cols="80" id="entry"  name="entry" autocomplete="off" required></textarea>
    	<br><br>
    	<label for="decryption_key">Decryption Key</label><br>
    	<textarea rows="4" cols="50" id="decryption_key"  name="decryption_key" autocomplete="off"></textarea><br>
    	<label for="password_field">Password</label>
    	<input id="password_field" type="text" name="password_field" autocomplete="off"/>
    	<input id="Decrypt" type="button" value="Decrypt" onclick="decryptData();" /><input id="Encrypt" type="button" value="Encrypt" onclick="encryptData();" />
    	<hr/>
    	<br>
    	<input type="submit" name="newEntry_form_submit" value="Save" />
	</form>
<?php
}else if( isset($_REQUEST['entry']) && isset($_REQUEST['id'])) {
	$title = "";
	$date = "";
	$RecordNo = $_REQUEST['id'];
	$entry = "";

    $db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    $query_user = $db_connection->prepare('select Title,Date,Entry from journal_entries where user_id = :user_id AND RecordNo = :recordno');
    $query_user->bindValue(':user_id',$_SESSION['user_id'], PDO::PARAM_STR);
    $query_user->bindValue(':recordno',$RecordNo, PDO::PARAM_INT);

    if ($query_user->execute()) {
        $result_row = $query_user->fetchObject();
        $title = $result_row->Title;
		$date = $result_row->Date;
		$entry = $result_row->Entry;
    }
?>
	<script language="JavaScript">
        encrypted = true;
    </script>
	<div>
	    <a href="index.php">Cancel / Go Back</a> | <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
	</div>
	<br><br>
	<form method="post" action="index.php" name="newEntry_form_update" onsubmit="return Validator();">
		<input type="hidden" name="recordno" value="<?php echo $RecordNo; ?>"/>
    	<label for="title">Title</label>
    	<input id="title" type="text" name="title" autocomplete="off" value="<?php echo $title; ?>" required />
    	<label for="date">Date</label>
    	<input id="date" type="text" name="date" pattern="[0-9]{8,8}" value="<?php echo $date; ?>" required />
    	<label for="entry">Post</label><br>
    	<textarea rows="20" cols="80" id="entry"  name="entry" autocomplete="off" required><?php echo $entry; ?></textarea>
    	<br><br>
    	<label for="decryption_key">Decryption Key</label><br>
    	<textarea rows="4" cols="50" id="decryption_key"  name="decryption_key" autocomplete="off"></textarea><br>
    	<label for="password_field">Password</label>
    	<input id="password_field" type="text" name="password_field" autocomplete="off"/>
    	<input id="Decrypt" type="button" value="Decrypt" onclick="decryptData();" /><input id="Encrypt" type="button" value="Encrypt" onclick="encryptData();" />
    	<hr/>
    	<br>
    	<input type="submit" name="newEntry_form_update_submit" value="Save" />
	</form>
<?php
}else{
?>
	<div>
	    <a href="index.php?newEntry">New Entry</a> | <a href="edit.php"><?php echo WORDING_EDIT_USER_DATA; ?></a> | <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
	</div>
	<br><br>
	<?php
	$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

	$query_user = $db_connection->prepare('select Title,Date,RecordNo from journal_entries where user_id = :user_id order by Date');
	$query_user->bindValue(':user_id',$_SESSION['user_id'], PDO::PARAM_STR);
	if ($query_user->execute()) {
		while ($row = $query_user->fetch(PDO::FETCH_ASSOC)) {
			echo "<strong><a href=index.php?entry&id=". $row["RecordNo"] ."><font size='3'>".$row["Title"]."</font></a></strong><br><i><font size='1'>".$row["Date"]."</font></i><br><br>";
		}
	}
}
?>
<?php include('_footer.php'); ?>
