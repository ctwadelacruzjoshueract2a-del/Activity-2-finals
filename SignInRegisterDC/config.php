<?php

  $conn = mysqli_connect("localhost", "root", "", "NicolasACT");

  function h($str){
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
  }

  session_start();
?>