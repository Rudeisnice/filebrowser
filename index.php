<?php
include "html.php";
include "functions.php";
include "variables.php";
if(isset($_GET["path"])) {
  $dir = "root/".$_GET["path"]."/";
}
$files = scandir($dir);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="container">
      <div id="directories">
        <?php
          alldirs();
        ?>
      </div>
      <div id="files">
        <?php
        chdir($dir);
        if(isset($_GET["path"])) {
          returnarrow($_GET["path"]);
        }
        foreach ($files as $f) {
          isdirectory($f,$dir);
        }
        foreach ($files as $f) {
          myfiles($f,$images,$dir);
        }
        ?>
      </div>
    </div>
  </body>
</html>
