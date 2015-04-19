# mailman
Mail Manager for MailGun

In order to successfully run the project, you need to go to the /application/config/ 
and rename config sample.php and database sample.php to config.php and database.php correspondingly.

On config.php you may want to pay special attention to:
$config['sess_save_path'] = './session/cache';
put an absolute path instead and make sure its writable to apache.

In database.php - make sure to provide hostname, username and password to your mysql/mariadb

Once the project is installed, you'll be guided to a setup page, to fill you details, and provide the 
MailGun Key which you can retrieve from your MailGun account settings.
