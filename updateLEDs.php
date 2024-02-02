<?php
  require 'config.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track post values
    $id = $_POST['id'];
    $lednum = $_POST['lednum'];
    $ledstate = $_POST['ledstate'];
    //........................................ 
    
    //........................................ 
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
    // This table is used to store DHT11 sensor data updated by ESP32. 
    // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
    $sql = "UPDATE esp32_table_dht11_leds_update SET " . $lednum . " = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ledstate,$id));
    Database::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>