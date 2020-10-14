<!DOCTYPE html>
<html>

  <head>
    <title>
      ADMIN PAGE
    </title>
    <link rel="stylesheet" type="text/css" href="formstyles.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>

  <body>

    <div class="header">
      <a href="home.php" class="logo">MyFly</a>
      <div class="header-right">
        <a href="home.php">Home</a>
        <a href="destinations.php">Destinations</a>
        <a class="active" href="admin.php">Admin</a>
        <a class="loginbtn" href="contact.php">My Account</a>
        <a class="loginbtn" href="contact.php">Login</a>
      </div>
    </div>

    <div class="bar">

    </div>

    <div class="page_background" style="height:700px;">
      <br>
      <?php
        if(array_key_exists('db',$_POST)){
          add_db();
        }
        else if(array_key_exists('userstables',$_POST)){
          add_tables();
        }
        else if(array_key_exists('desttables',$_POST)){
          dest_tables();
        }
        else if(array_key_exists('adddest',$_POST)){
          add_dest();
        }
        else if(array_key_exists('dropdest',$_POST)){
          drop_dest();
        }
        else if(array_key_exists('routestable',$_POST)){
          routes_tables();
        }
        else if(array_key_exists('addroute',$_POST)){
          add_route();
        }

        function add_db() {
          $servername = "localhost";
          $user = "root";
          $pword = "root";

          $conn = new mysqli($servername,$user,$pword);

          if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
          }
          echo "Connected successfully";

          $sql = "CREATE DATABASE Myflyone";
          if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
          } else {
            echo "Error creating database: " . $conn->error;
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
            email VARCHAR(50) NOT NULL
          )";

          if($conn->query($sql) === TRUE){
            echo " Table success";
          } else {
            echo "Table error".$conn->error;
          }

          $conn->close();
        }

        function dest_tables() {
          require('dbconn.php');
          $sql = "CREATE TABLE Destinations(
            destid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL
          )";

          if($conn->query($sql) === TRUE){
            echo " Table success";
          } else {
            echo "Table error".$conn->error;
          }

          $conn->close();
        }

        function add_dest() {
          require('dbconn.php');
          $sql = "INSERT INTO Destinations (name)
          VALUES ('".$_POST["destname"]."')";

          if($conn->query($sql) === TRUE){
            echo " Table success";
          } else {
            echo "Table error".$conn->error;
          }

          $conn->close();
        }

        function drop_dest() {
          require('dbconn.php');
          $sql = "TRUNCATE TABLE Destinations";

          if($conn->query($sql) === TRUE){
            echo " Table deleted success";
          } else {
            echo "Table deleted error".$conn->error;
          }

          $conn->close();
        }

        function routes_tables() {
          require('dbconn.php');
          $sql = "CREATE TABLE Routes(
            routeid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            origin VARCHAR(30) NOT NULL,
            originid INT(6) NOT NULL,
            dest VARCHAR(30) NOT NULL,
            destid INT(6) NOT NULL
          )";

          if($conn->query($sql) === TRUE){
            echo " Table success";
          } else {
            echo "Table error".$conn->error;
          }

          $conn->close();
        }

        function get_dest_id($destcheck) {
          require('dbconn.php');
          $getid =11;
          echo "id: " . $destcheck. " <br>";
          $sql = "SELECT destid FROM Destinations WHERE name='".$destcheck."' ";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $getid = $row["destid"];
            }
          } else {
            echo "0 results";
          }
          $conn->close();

          return $getid;

          //if ($result->num_rows > 0) {

            //while($row = $result->fetch_assoc()) {


            //}
          //}


        }


        function add_route() {

          $getoriginid = get_dest_id($_POST['routeoriginname']);
          $getdestid = get_dest_id($_POST['routedestname']);


          //echo "INSERT INTO Routes (origin,originid,dest,destid)
          //VALUES ( '".$_POST['routeoriginname']."' , ".$getoriginid.", '".$_POST['routedestname']."',".$getdestid.")";
          require('dbconn.php');

          $sql = "INSERT INTO Routes (origin,originid,dest,destid) VALUES ( '".$_POST['routeoriginname']."' , ".$getoriginid.", '".$_POST['routedestname']."',".$getdestid.")";

          if($conn->query($sql) === TRUE){
            echo " Adding success";
          } else {
            echo "Adding error".$conn->error;
          }

          $conn->close();
        }
      ?>




      <form class="form-style-7" method="post" >
      <ul>
        <center>
          <input type="submit" name="db" value="Make Myflyone Database" style="margin-right:50%; width:200px;" >
          <br><br><br><br>
          <input type="submit" name="userstables" value="Make Users Table"  style="margin-right:50%; width:200px;">
          <br><br>
          <input type="submit" name="desttables" value="Make Destinations Table"  style="margin-right:50%; width:200px;">
          <br><br>
          <input type="submit" name="routestable" value="Make routes table"  style="margin-right:50%; width:200px;">
          <br><br><br><br>
          <li>
            <label for="name">Destination Name</label>
              <input type="text" name="destname">


              <span>Enter the new destination</span>
          </li>
          <input type="submit" name="adddest" value="Add new destination"  style="margin-right:50%; width:200px;">
          <input type="submit" name="dropdest" value="Drop Destinations"  style="margin-right:50%; width:200px;">
          <br><br><br><br><br><br>
          <li>
            <label for="name">Origin Name</label>
              <input type="text" name="routeoriginname" list="destinations">

              <datalist id="destinations">
              <?php
              require('dbconn.php');
              $sql = "SELECT name FROM Destinations";

              $result = $conn->query($sql);

              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  echo "<option value='".$row['name']."' >";
                }
              }else{
                echo "<option value='No Destinations' >";
              }

              if($conn->query($sql) === TRUE){
                echo " Table deleted success";
              } else {
                echo "Table deleted error".$conn->error;
              }
              $conn->close();
              ?>
              </datalist>

              <span>Select the origin</span>
          </li>
          <li>
            <label for="name">Destination Name</label>
              <input type="text" name="routedestname" list="destinations">
              <datalist id="destinations">
              <?php
              require('dbconn.php');
              $sql = "SELECT name FROM Destinations";

              $result = $conn->query($sql);

              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  echo "<option value='".$row['name']."' >";
                }
              }else{
                echo "<option value='No Destinations' >";
              }

              if($conn->query($sql) === TRUE){
                echo " Table deleted success";
              } else {
                echo "Table deleted error".$conn->error;
              }
              $conn->close();
              ?>
              </datalist>

              <span>Select the destination</span>
          </li>
          <input type="submit" name="addroute" value="Add route"  style="margin-right:50%; width:200px;">
          <input type="submit" name="droproutes" value="Drop Routes"  style="margin-right:50%; width:200px;">


        </center>
      </ul>

      </form>







      <br><br>
    </div>
  </body>
</html>
