Todoer
======

Task list manager(PHP, MySQL, MVC)

Check wiki for screenshots!

If you want to install it locally you can follow these steps:

1: Clone Todoer repo<br>
2: Install dependencies with composer<br>
3: Check config.php in app files for setup<br>
4: Install database and tables from db_install folder which is in Todoer repository<br>
   
      From db_install directory:
         
         mysql -u root -p  < create-database.sql
         mysql -u root -p  < create-user-table.sql
         mysql -u root -p  < create-list-table.sql
         mysql -u root -p  < create-task-table.sql
      
5: Check .htaccess file for url rewriting and server specific setup
