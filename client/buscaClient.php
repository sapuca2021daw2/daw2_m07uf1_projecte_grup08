<?php
session_start();

if (isset($_SESSION['admin'])||isset($_SESSION['client'])) {

  include("../Client.php");

  $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuaris.txt";
  $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
  while (!feof($fitxer)) {
    $ob = explode(",", fgets($fitxer));
    if ($_SESSION['client'] == $ob[1]) {
      $cl = new Client($ob[0], $ob[1], $ob[2], $ob[3], $ob[4],$ob[5], $ob[6], $ob[7], $ob[8]);
      break;
    }
  }
  fclose($fitxer);
}
