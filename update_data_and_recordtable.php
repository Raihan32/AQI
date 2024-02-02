<?php
  require 'config.php';
  
 
  if (!empty($_POST)) {

    $id = $_POST['id'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $ppm = $_POST['ppm'];
    $status_read_sensor = $_POST['status_read_sensor'];
    $led_01 = $_POST['led_01'];
    $led_02 = $_POST['led_02'];
    date_default_timezone_set("Asia/Jakarta"); // Look here for your timezone : https://www.php.net/manual/en/timezones.php
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE esp32_table_dht11_leds_update SET temperature = ?, humidity = ?, ppm = ?, status_read_sensor = ?, time = ?, date = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($temperature,$humidity,$ppm,$status_read_sensor,$tm,$dt,$id));
    Database::disconnect();
    $id_key;
    $board = $_POST['id'];
    $found_empty = false;
    
    $pdo = Database::connect();
    
    while ($found_empty == false) {
      $id_key = generate_string_id(10);
      $sql = 'SELECT * FROM esp32_table_dht11_leds_record WHERE id="' . $id_key . '"';
      $q = $pdo->prepare($sql);
      $q->execute();
      
      if (!$data = $q->fetch()) {
        $found_empty = true;
      }
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO esp32_table_dht11_leds_record (id,board,temperature,humidity,ppm,status_read_sensor,LED_01,LED_02,time,date) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_key,$board,$temperature,$humidity,$ppm,$status_read_sensor,$led_01,$led_02,$tm,$dt));
    
    Database::disconnect();
  }
  function generate_string_id($strength = 16) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }
?>