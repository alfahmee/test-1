<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php

            $username = "";
            $usernameerr = "";
            $loginfail = "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Search") {

                if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the Username!";
                }

               

                else {
                    $username = $_POST['uname'];
                   

                    $log_file = fopen("Login.txt", "r");                    
                    $data = fread($log_file, filesize("Login.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username ) 
                     {
                         session_start();
                          $_SESSION['user'] = $username;
                          header("Location: vbook.php");
                        }
                    }
                    $loginfail = "Book is not availebale.";
                }
            }
        ?>
        
        <h1>Welcome to Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Search Book</b></legend>
            
                <label for="username">Book Id:</label>
                <input type="text" name="uname" id="username">
                <?php echo $usernameerr; ?>

                 <?php echo $username; ?>


                <br>

               

               
                
                </fieldset>

                <?php echo $loginfail; ?>

                <br>
                
            <input type="submit" value="Search" name="button"> 
        </form>

        <br>

       

       

        
    </body>
</html>