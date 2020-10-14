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
        <a class="active" href="home.php">Home</a>
        <a href="destinations.php">Destinations</a>
        <a href="admin.php">Admin</a>
        <a class="loginbtn" href="contact.php">My Account</a>
        <a class="loginbtn" href="contact.php">Login</a>
      </div>
    </div>

    <div class="bar">

    </div>

    <div class="page_background">
      <br>
    </div>


    <div class="img_bkgrnd" >
      <br>

      <h2 style="color:#05044a;font-size:55px;font-family:Arial; padding: 0 0 0 10%;" > Book Your Next Trip Noww! </h2>


      <div class="content1">




        <form class="form-style-7" >
        <ul>
        <li>
          <label for="name">Origin</label>
            <input type="text" list="destinations" >

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

            <span>Enter your departure airport here</span>
        </li>
        <li>
          <label for="name">Destination</label>
            <input type="text" list="destinations" required >

            <span>Enter your destination airport here</span>
        </li>
        <li>
            <label for="date">Departure Date</label>
            <input type="date" name="date" required>
            <span>Enter your departure date</span>
        </li>
        <li>
            <label for="retdate">Departure Date</label>
            <input type="date" name="retdate" required>
            <span>Enter your return date</span>
        </li>
        <li style="width:100px;display:inline; float:left;">
            <label for="adults">Adults</label>
            <input type="number" name="adults" min="1" max="9" value="0" required>
            <span>Number of Adults</span>
        </li>
        <li style="width:100px; display:inline; float:right; margin-right:30%;">
            <label for="children">Children</label>
            <input type="number" name="children" min="0" max="9" value="0" required>
            <span>Number of Children</span>
        </li>
        <input type="submit" value="Search Fights" style="float:right;">

        </ul>

        </form>

      </div>

      <h2><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        Create Tables
      </h2>


  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>

  fff
  </body>
</html>
