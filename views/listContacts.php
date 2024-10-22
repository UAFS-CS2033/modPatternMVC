<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS 2033 | List Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
 
  
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light" style="margin-bottom: 20px">
    <a class="navbar-brand" href="contactController.php?action=list">
        <img src="images/lion.png" width="12%" height="12%" class="d-inline-block align-middle" alt="">
        CS 2033 Web Systems
    </a>
    </nav>
    <div class="container">
        <div class="col">
            <form action="contactController.php?action=delete" method="post">
            <a class="btn btn-primary" href="contactController.php?action=add" role="button">Add Contact</a>
            <input type="submit" name="submit" value="Delete Contact" class="btn btn-primary">
            <table class="table table-bordered table-striped">
                <thead><tr><th></th><th>Contact ID</th><th>Contact Name</th><th>Email</th><th>Address</th><th></th></tr></thead>
                <tbody>
                    <?php
                        for($index=0;$index<count($contacts);$index++){
                            echo "<tr><td><input type=\"radio\" name=\"contactID\" value=\"".$contacts[$index]->contactID."\"></td><td>"
                                    .$contacts[$index]->contactID."</td><td>"
                                    .$contacts[$index]->username."</td><td>"
                                    .$contacts[$index]->email."</td><td>"
                                    .$contacts[$index]->address1."</td><td>"
                                    ."<a href=\"contactController.php?action=delete&contactID=".$contacts[$index]->contactID."\">Delete</a></td></tr>\n";
                        }
                    ?>
                </tbody>        
            </table>  
            </form>     
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>