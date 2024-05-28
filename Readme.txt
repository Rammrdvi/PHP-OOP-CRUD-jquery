Running the PHP OOP CRUD Script
Prerequisites

    XAMPP, WAMP, or LAMP server installed on your system.
    Basic understanding of PHP, MySQL, and CRUD operations.

Instructions

    Download and Extract the Files
        Download the zip file containing the PHP OOP CRUD script.
        Extract the contents of the zip file.

    Copy the Files to the Root Directory
        Locate the extracted folder named "phpoopcrud".
        Copy the entire "phpoopcrud" folder.

    Paste into Root Directory
        Navigate to your server's root directory:
            For XAMPP: xampp/htdocs
            For WAMP: wamp/www
            For LAMP: var/www/html
        Paste the "phpoopcrud" folder into the root directory.

    Database Setup
        Open your web browser and access PHPMyAdmin: http://localhost/phpmyadmin.
        Log in using your MySQL credentials.

    Create a Database
        Click on the "Databases" tab in PHPMyAdmin.
        Enter "oopscrud" as the database name and click "Create".

    Import SQL File
        Inside the extracted folder, locate the "SQL file" folder.
        Find the "oopscrud.sql" file.
        Back in PHPMyAdmin, select the "oopscrud" database from the left sidebar.
        Click on the "Import" tab.
        Choose the "oopscrud.sql" file and click "Go" to import the database structure and data.

    Run the Script
        Open your web browser.
        Enter the following URL in the address bar: http://localhost/phpoopcrud.
        You should see the frontend of the PHP OOP CRUD application.

Conclusion

You have successfully set up the PHP OOP CRUD script on your local server. You can now explore the CRUD operations by adding, editing, viewing, and deleting records in the database.