  <?php
  require_once("connect.php");
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

    <body>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Speaking Helper</a>
        </div>
    </nav>
    <div id="page" class="container">
        <h1 class="header center blue-text">GET STARTED</h1>
        <h5 class="header light">Simply enter the names and sentences, then click "Submit".</h5>
        <div class="row">
            <form class="col s12" action="./post_material.php" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="class" name="class" class="materialize-textarea"></textarea>
                        <label for="class">Class:</label>
                        <span class="helper-text">Enter the names line by line.</span>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="sentences" name="sentences" class="materialize-textarea"></textarea>
                        <label for="sentences">Sentences:</label>
                        <span class="helper-text">Enter the sentences line by line.</span>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>


      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
        