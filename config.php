<?php
  error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
  ini_set('display_errors', 'on');

  /** DIR_BASE va retine locatia pe disk unde este stocata aplicatia web */
  define('DIR_BASE', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

  /** Datele de conectare la baza de date */
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'db_conferinta');
  define('DB_USER', 'root');
  define('DB_PASS', '');
?>