Todoer
======

Task list manager(PHP, MySQL, MVC)

If you want to install it locally you can follow these steps:

1: Clone Todoer repo<br>
2: Install dependencies with composer<br>
3: Install database and tables from db_install folder which is in Todoer repository<br>
   
         From db_install directory:
         <ul>
            <li>mysql -u root -p  < create-database.sql</li>
            <li>mysql -u root -p  < create-user-table.sql</li>
            <li>mysql -u root -p  < create-list-table.sql</li>
            <li>mysql -u root -p  < create-task-table.sql</li>
         </ul>
   
4: Check config.php in app files for setup<br>
5: Check .htaccess file for url rewriting and server specific setup
