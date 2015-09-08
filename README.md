PGP Journal
==============

A very simple journal website that allows you to create journal entries that are encrypted with your public PGP key before being stored in the database, for utmost privacy. 

Once you create a new account you will have to click the "Edit user data" link to add your Public PGP key.

When you wish to view a saved journal entry you will have to paste your private key along with your passphrase before clicking "decrypt". 

All PGP commands are executed in the browser using the [kbpgp.js](https://keybase.io/kbpgp) library from [keybase.io](https://keybase.io/)

The website code is based (heavily based) on the [php-login-advanced](https://github.com/panique/php-login-advanced) project.


## Requirements

- PHP 5.3.7+
- MySQL 5 database (please use a modern version of MySQL (5.5, 5.6, 5.7) as very old versions have a exotic bug that
[makes PDO injections possible](http://stackoverflow.com/q/134099/1114320).
- activated PHP's GD graphic functions (the tutorial shows how)
- enabled OpenSSL module (the tutorial shows how)
- this version uses mail sending, so you need to have an **SMTP mail sending account** somewhere OR you know how to get
 **linux's sendmail** etc. to run. As it's nearly impossible to send real mails with PHP's mail() function (due to
 anti-spam blocking of nearly every major mail provider in the world) you should really use SMTP mail sending.

## Installation (quick setup)

* 1. create database *login* and table *users* via the SQL statements in the `_installation` folder.
* 2. in `config/config.php`, change mySQL user and password (*DB_USER* and *DB_PASS*).
* 3. in `config/config.php`, change *COOKIE_DOMAIN* to your domain name (and don't forget to put the dot in front of the domain!)
* 4. in `config/config.php`, change *COOKIE_SECRET_KEY* to a random string. this will make your cookies more secure
* 5. change the URL part of EMAIL_PASSWORDRESET_URL and EMAIL_VERIFICATION_URL in `config/config.php` to your URL! You need to provide the URL of your project here to link to your project from within
verification/password reset mails.
* 6. as this version uses email sending, you'll need to a) provide an SMTP account in the config OR b) install a mail server tool on your server.
Using a real SMTP provider (like [SMTP2GO](http://www.smtp2go.com/?s=devmetal) etc.) is highly recommended. Sending emails manually via mail() is something for hardcore admins.
Usually mails sent via mail() will never reach the receiver. Please also don't try weird Gmail setups, this can fail to a lot of reasons.
Get professional and send mails like mail should be sent. It's extremely cheap and works.

- To enable OpenSSL, do `sudo apt-get install openssl` (and restart the apache via `sudo service apache2 restart`)
- To enable PHP's GD graphic functions, do `sudo apt-get install php5-gd` (and restart the apache via `sudo service apache2 restart`)

## Installation (very detailed setup)

A very detailed guideline on how to install the script
[here in this blog post](http://www.dev-metal.com/install-php-login-nets-2-advanced-login-script-ubuntu/).

## Troubleshooting & useful stuff

Please use a real SMTP provider for sending mail. Using something like gmail.com or even trying to send mails via
mail() will bring you into a lot of problems (unless you really really know what you are doing). Sending mails is a
huge topic. But if you still want to use Gmail: Gmail is very popular as an SMTP mail sending service and would
work for smaller projects, but sometimes gmail.com will not send mails anymore, usually because of:

1. "SMTP Connect error": PHPMailer says "smtp login failed", but login is correct: Gmail.com thinks you are a spammer. You'll need to
"unlock" your application for gmail.com by logging into your gmail account via your browser, go to http://www.google.com/accounts/DisplayUnlockCaptcha
and then, within the next 10minutes, send an email via your app. Gmail will then white-list your app server.
Have a look here for full explanaition: https://support.google.com/mail/answer/14257?p=client_login&rd=1

2. "SMTP data quota exceeded": gmail blocks you because you have sent more than 500 mails per day (?) or because your users have provided
 too much fake email addresses. The only way to get around this is renting professional SMTP mail sending, prices are okay, 10.000 mails for $5.

## Security notice

This script comes with a handy .htaccess in the views folder that denies direct access to the files within the folder
(so that people cannot render the views directly). However, these .htaccess files only work if you have set
`AllowOverride` to `All` in your apache vhost configs. There are lots of tutorials on the web on how to do this.


Contributing
------------

Feel free to fork and send [pull requests](http://help.github.com/fork-a-repo/).  Contributions welcome.


License
-------

Licensed under [MIT](http://opensource.org/licenses/mit-license.php). You can use this script for free for any private or commercial projects.