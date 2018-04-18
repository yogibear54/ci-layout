# New Codeigniter Installation (v. 3.1.8):
1.	Copy “application” and “themes” directory to your root.  Allow the filesystem to overwrite the files.
2.	Open application/config/database.php and add in your database connection information here.
3.	Open bash, and in the site root type the following to perform a migration:
“php index.php migrate/now”
4.	Visit the URL for your current site installation

Adding to an existing Codeigniter installation:
1.	Copy the following files over to your current CI install:
- themes/*
- application/config/ion_auth.php
- application/config/layout.php
- application/controllers/Auth.php
- application/controllers/Migrate.php
- application/core/Base_Controller.php
- application/core/MY_Controller.php
- application/helpers/MY_path_helper.php
- application/language/english/auth_lang.php
- application/language/english/error_lang.php
- application/language/english/ion_auth_lang.php
- application/language/english/site_lang.php
- application/libraries/Bcrypt.php
- application/libraries/Ion_auth.php
- application/libraries/Layout.php
- application/migrations/001_install_ion_auth.php
- application/models/Ion_auth_model.php
- application/views/auth/*

2.	Files to update:
- application/config/autoload.php
    i.	Make sure the following libraries are loaded: 'session', 'ion_auth', 'layout', 'database' i.e. $autoload['libraries'] = array('session', 'ion_auth', 'layout', 'database');
    ii.	Make sure the following configs are loaded: ‘layout’ i.e. $autoload['config'] = array('layout');
    iii.	Make sure the following language files are loaded: ‘ion_auth’ i.e. $autoload['language'] = array('ion_auth');
- application/config/migration.php
    i.	Make sure migration is enabled i.e. $config['migration_enabled'] = TRUE;
    ii.	Make sure migration type is sequential i.e. $config['migration_type'] = 'sequential';
    iii.	Depending on your current application, increment the migration version by 1.  i.e. $config['migration_version'] = 3;
    iv.	(only need to do if migration version is greater than 1), if migration version is greater than one, rename file application/migrations/001_install_ion_auth.php to the next migration number i.e. 003_install_ion_auth.php
    v.	Run the migration, open bash shell, and in the site root type the following to perform a migration:  “php index.php migrate/now”

3.	Sample controller file:  application/controllers/Welcome.php
- Extend by MY_Controller
- Added a _remap method 
- In controller method, can load the layout object
- In the view, load data array to the template for display

# User Guide
## Adding Local Javasript File
Javascript files are loaded from the [root]/js folder.  To improve readability and organization, I suggest that you should create a folder with the controller name, and name the js file with the method. 
•	$this->layout->addJS(‘welcome/index.js’);

## Adding External Javascript File
You can load an external javascript file using the follow line of code:
•	$this->layout->addExternalJS(‘https://www.fontawesome.com/test_file.js’);

## Adding Local CSS File
CSS files are loaded from the [root]/css folder.  To improve readability and organization, I suggest that you should create a folder with the controller name, and name the js file with the method.
•	$this->layout->addCSS(‘welcome/index.css’);

## Adding Packages
Packages are js libraries that are contained as a single package with both js and css files.  Packages are generally stored and loaded in [root]/package folder.
We have 3 methods for loading packages:
•	Add Package:  This loads both the js and css file in one method – i.e. $this->layout->addPackage(‘bootstrap/dist/js/bootstrap.js’, ’bootstrap/dist/css/bootstrap.css’);

- Add JS Package: This just loads the js file i.e. $this->layout->addJSPackage(‘bootstrap/dist/js/bootstrap.js’);

- Add CSS Package: This just loads the css file i.e. $this->layout->addCSSPackage(‘bootstrap/dist/css/bootstrap.css’);

## Additional Methods
See more methods in application/libraries/layout.php









 
