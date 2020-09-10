<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Journal</title>
    <style type="text/css">
        /* just for the demo */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }
        label {
            position: relative;
            vertical-align: middle;
            bottom: 1px;
        }
        input[type=text],
        input[type=password],
        input[type=submit],
        input[type=email] {
            display: block;
            margin-bottom: 15px;
        }
        input[type=checkbox] {
            margin-bottom: 15px;
        }
    </style>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.8.1.js'></script>
    <script src="kbpgp-2.1.0-min.js"></script>
    <script language="JavaScript">
        <!-- // ignore if non-JS browser
        var encrypted = false;
        var key = "";
        <?php
        $db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        $query_user = $db_connection->prepare('select user_pgp from users where user_id = :user_id');
        $query_user->bindValue(':user_id',$_SESSION['user_id'], PDO::PARAM_STR);
        if ($query_user->execute()) {
            $result_row = $query_user->fetchObject();
            echo "key = `". $result_row->user_pgp . "`;";
        }
        ?>

        function Validator()
        {
            if(encrypted){
                return true;
            }else{
                alert("Encrypt post before saving.");
                return false;
            }
        }
        function encryptData()
        {
            if(encrypted){
                alert("Post is already encrypted.");
            }else{
                var theEntry = document.getElementById("entry");
                var userKey = null;
                kbpgp.KeyManager.import_from_armored_pgp({
                  armored: key
                }, function(err, user) {
                  if (!err) {
                    userKey = user;
                  }else{
                    alert(err);
                  }
                });

                var params = {
                  msg:         theEntry.value,
                  encrypt_for: userKey
                };

                kbpgp.box(params, function(err, result_string, result_buffer) {
                    if (!err) {
                        theEntry.value = result_string;
                        encrypted = true;
                    }else{
                        alert(err);
                    }
                });
            }
        }
        function decryptData()
        {
            if(!encrypted){
                alert("Post is already decrypted.");
            }else{
                if( document.getElementById("decryption_key").value=="" ){
                    alert("Enter a decryption key.");
                }else if ( document.getElementById("password_field").value=="" ){
                    alert("Enter a Passphrase.");
                }else if ( document.getElementById("entry").value==""){
                    alert("No message to decrypt.");
                }else{
                    var user_pgp_key    = document.getElementById("decryption_key").value;
                    var user_passphrase = document.getElementById("password_field").value;

                    kbpgp.KeyManager.import_from_armored_pgp({
                        armored: key
                    }, function(err, imported) {
                        if (!err) {
                            imported.merge_pgp_private({
                                armored: user_pgp_key
                            }, function(err) {
                                if (!err) {
                                    if (imported.is_pgp_locked()) {
                                        imported.unlock_pgp({
                                            passphrase: user_passphrase
                                        }, function(err) {
                                            if (!err) {
                                                var ring = new kbpgp.keyring.KeyRing;
                                                var kms = [imported];
                                                for (var i in kms) {
                                                    ring.add_key_manager(kms[i]);
                                                }
                                                kbpgp.unbox({keyfetch: ring, armored: document.getElementById("entry").value }, function(err, literals) {
                                                    if (err != null) {
                                                        alert(err);
                                                    } else {
                                                        document.getElementById("entry").value = literals[0].toString();
                                                        encrypted = false;
                                                    }
                                                });
                                            }else{
                                                alert(err);
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    });
                }
            }
        }
        // -->
    </script>
</head>
<body>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>
