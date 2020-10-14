<!DOCTYPE html>
<html>

  <head>
    <title>
      ADMIN PAGE
    </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>

  <body>
    <div class="header">
      <a href="inde"

    <h2>
      Create Tables
    </h2>

    <?php
      if(array_key_exists('db',$_POST)){
        add_db();
      }
      else if(array_key_exists('tables',$_POST)){
        add_tables();
      }

      function add_db() {
        $servername = "localhost";
        $user = "root";
        $pword = "root";

        $conn = new mysqli($servername,$user,$password);

        if($conn->connect_error){
          die("Connection failed: ".$conn->connect_error);
        }
        echo "Connected successfully";

        $sql = 'CREATE Database primary';
        $retval = mysql_query($sql, $conn);

        if(! $retval){
          die('Could not create database: '.mysql_error())
        }

        echo "db created";
        mysql_close($conn);
      }

      function add_tables() {
        require('dbconn.php');
        $sql = "CREATE TABLE Users(
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          fname VARCHAR(30) NOT NULL,
          lname VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
        )";

        if($conn->query($sql) === TRUE){
          echo " Table success";
        } else {
          echo "Table error".$conn->error;
        }

        $conn->close();
      }
    ?>
    <form method="post">
        <input type="submit" name="db" value="Make Database" class="button"/>
        <input type="submit" name="tables" value="Make Tables" class="button"/>
    </form>
  </body>
</html>
