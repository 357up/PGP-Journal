PGP Journal
==============

A very simple journal website that allows you to create journal entries that are encrypted with your public PGP key before being stored in the database, for utmost privacy.

Once you create a new account you will have to click the "Edit user data" link to add your Public PGP key.

When you wish to view a saved journal entry you will have to paste your private key along with your passphrase before clicking "decrypt".

All PGP commands are executed in the browser using the [kbpgp.js](https://keybase.io/kbpgp) library from [keybase.io](https://keybase.io/)

The website code is based (heavily based) on the [php-login-advanced](https://github.com/panique/php-login-advanced) project.


## Requirements

- [Docker](https://docs.docker.com/get-docker/) and [docker-compose](https://docs.docker.com/compose/install/) or [Podman] (https://podman.io/getting-started/installation.html) and [podman-compose](https://github.com/containers/podman-compose) or another container engine (tested on Podman 2.0.6).
- this version uses mail sending, so you need to have an **SMTP mail sending account** somewhere OR you know how to get
 **linux's sendmail** etc. to run. As it's nearly impossible to send real mails with PHP's mail() function (due to anti-spam blocking of nearly every major mail provider in the world) you should really use SMTP mail sending.

## Installation

* 1. in `.env`, set unique MySQL credentials (*DB_* variables).
* 2. in `.env`, change *COOKIE_DOMAIN* to your domain name (and don't forget to put the dot in front of the domain!)
* 3. in `.env`, change *COOKIE_SECRET_KEY* to a random string. this will make your cookies more secure
* 4. as this version uses email sending, you'll need to provide an SMTP account in the `.env` (*EMAIL_* variables). Using a real SMTP provider (like [SMTP2GO](http://www.smtp2go.com/?s=devmetal) etc.) is highly recommended.
* 5. optionaly change *EMAIL_VERIFICATION_SUBJECT*, *EMAIL_VERIFICATION_CONTENT*, *EMAIL_PASSWORDRESET_SUBJECT* and *EMAIL_PASSWORDRESET_CONTENT* environment variables.
* 6. if you are using a reverse proxies, configure treir IPs as *TRUSTED_PROXIES* environment variable (coma separeted list of IPs)
* 7. run docker-compose up -d or podman-compose up -d (depending on your container engine).

## Troubleshooting & useful stuff

Please use a real SMTP provider for sending mail. Using something like gmail.com or even trying to send emails via mail() will bring you into a lot of problems (unless you really really know what you are doing). Sending mails is a huge topic. But if you still want to use Gmail: Gmail is very popular as an SMTP mail sending service and would work for smaller projects, but sometimes gmail.com will not send emails anymore, usually because of:

1. "SMTP Connect error": PHPMailer says "smtp login failed", but login is correct: Gmail.com thinks you are a spammer. You'll need to "unlock" your application for gmail.com by logging into your Gmail account via your browser, go to http://www.google.com/accounts/DisplayUnlockCaptcha and then, within the next 10minutes, send an email via your app. Gmail will then white-list your app server.
Have a look here for a full explanation: https://support.google.com/mail/answer/14257?p=client_login&rd=1

2. "SMTP data quota exceeded": Gmail blocks you because you have sent more than 500 mails per day (?) or because your users have provided too much fake email addresses. The only way to get around this is renting professional SMTP mail sending, prices are okay, 10.000 mails for $5.

Run `docker/podman logs -f journal` to inspect PHP error log and Apache access log.


Contributing
------------

Feel free to fork and send [pull requests](http://help.github.com/fork-a-repo/).  Contributions welcome.


License
-------

Licensed under [MIT](http://opensource.org/licenses/mit-license.php). You can use this script for free for any private or commercial projects.
