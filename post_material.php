  <?php
  require_once('connect.php');
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <?php
        $postclass = $_POST['class'];
        $postsentences = $_POST['sentences'];
        $seperator = "\r\n";
        if(strpos($postclass, $seperator) === false || strpos($postsentences, $seperator) === false)
        {
            die("Cümleleri satır satır ayırmayı deneyin.");
        }
        $class = explode($seperator, $postclass);
        $sentences = explode($seperator, $postsentences);
        foreach($class as $name)
        {
            if(!strlen($name))
            {
                die("Boş cümle bırakmamayı deneyin.");
            }
        }
        $insertID = 0;
        $success = false;
        $query = "SELECT MAX(classID) AS insertID FROM students";
        if($stmt = $mysqli->prepare($query))
        {
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $insertID = $row['insertID'] + 1;
            }
            $stmt->close();
        }
        $IP = $_SERVER['REMOTE_ADDR'];
        $query = "INSERT INTO students (classID, name, IP, time) VALUES (?, ?, ?, UNIX_TIMESTAMP())";
        foreach($class as $name)
        {
            if($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("iss", $insertID, $name, $IP);
                
                if($stmt->execute())
                {
                    $success = true;
                }
            }
            $stmt->close();
        }
        $query = "SELECT MAX(classID) AS insertID FROM sentences";
        if($stmt = $mysqli->prepare($query))
        {
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $insertID = $row['insertID'] + 1;
            }
            $stmt->close();
        }
        $query = "INSERT INTO sentences (classID, sentence, IP, time) VALUES (?, ?, ?, UNIX_TIMESTAMP())";
        foreach($sentences as $sentence)
        {
            if($stmt = $mysqli->prepare($query))
            {
                $stmt->bind_param("iss", $insertID, $sentence, $IP);

                if($stmt->execute())
                {
                    $success = true;
                }
            }
        }
    ?>
    <body>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Speaking Activity Maker</a>
        </div>
    </nav>
    <div id="page" class="container">
        <h1 class="header center blue-text">DONE!</h1>
        <h5 class="header light">Your activity is ready.</h5>
        <div class="row">
            <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                <span class="card-title">Speaking Activity</span>
                <p>Your speaking activity is ready. Simply copy this link and go. 
                System will automatically choose random people to let them talk to each other.</p>
                </div>
                <div class="card-action">
                <span id="link" hidden>http://localhost/materialv2/app.php?classid=<?php echo $insertID; ?></span>
                <a href="#" onclick="copyToClipboard('#link')">Copy</a>
                </div>
            </div>
            </div>
        </div>
    </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
      <script>
        function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        }
    </script>
    </body>
  </html>
        