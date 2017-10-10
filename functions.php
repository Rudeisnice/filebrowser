<?php
  include "variables.php";
  include "html.php";

  function myfiles($f,$fnimages,$dir){
    $hdir = ".";
    $ext = NULL;
    $filename = NULL;
    if(is_dir($f)) {
      if(strpos($f,$hdir)>0){
        $filename = $f;
        $ext = "unknown";
      }
    }
    if(is_file($f)&&strpos($f,$hdir)!=0) {
      $filename = $f;
      foreach($fnimages as $img) {
        if(strpos($f,$img)>0) {
          $ext = "image";
          break;
        } else {
          $ext = "unknown";
        }
      }
    }
    if($ext == "unknown") {
      $ext = whatisext($filename);
    }
    if(isset($filename)&&isset($ext)){
      // echo $filename." ".$ext."<br>";
      fileimg($filename,$ext,$dir);
    }
  }
  function alldirs(){
    chdir("root/");
    $dir = scandir(".");
    foreach ($dir as $d) {
      $hdir = ".";
      if(strpos($d,$hdir)!==0) {
        if(is_dir($d)) {
          if(strpos($d,$hdir)==""){
            echo $d." dir<br>";
          }
        }
      }
    }
    chdir("../");
  }
  function isdirectory($f,$dir){
    $hdir = ".";
    if(strpos($f,$hdir)!==0) {
      if(is_dir($f)) {
        if(strpos($f,$hdir)==""){
          fileimg($f,"dir",$dir);
        }
      }
    }
  }
  function itsimage($name,$path) {
    echo "<img src=\"".$path.$name."\" width=\"200\" height=\"200\">";
  }
  function fileimg($name,$file,$dir) {
    $path = $dir;
    switch ($file) {
      case 'dir':
        # code...
        $path = "img/dir.png";
        break;
      case 'app':
        # code...
      case 'exe':
        # code...
        $path = "img/app.png";
        break;
      case 'image':
        # code...
        $path = $path.$name;
        break;
      case 'zip':
        # code...
        $path = "img/zip.png";
        break;

      default:
        # code...
        $path = "img/unknown.png";
        break;
    }
    setlink($name,$path,$dir,$file);
  }
  function whatisext($name) {
    $ext = strpos($name,".");
    $ext1 = substr($name, $ext+1);
    return $ext1;
  }
  function setlink($name,$path,$dir,$file){
    $dir = substr($dir,strpos($dir, "/")+1);
    $class = "class=\"box\"";
    $div = "<div $class>";

    if($file=="dir") {
      $a = "<a $class href=\"index.php?path=$dir$name\">";
    } else {
      $a = "<a $class href=\"root/$dir$name\">";
    }
    echo "$a<div class=\"bgimage\" style=\"background-image:url('$path');\"></div><p>$name</p></a>";
  }
  function returnarrow($path) {
    $path = explode("/",$path);
    if(count($path)==1) {
      $link = "";
    } else {
      unset($path[count($path)-1]);
      $path = implode($path,"/");
      $link = "?path=$path";
    }
    echo "<a class=\"box\" href=\"index.php$link\"><div class=\"bgimage return\"></div><p>Zurück</p></a>";
  }
?>
