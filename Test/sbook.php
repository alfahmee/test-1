<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php

            $bookName = "";
            $bookNameerr = "";
            $loginfail = "";

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Search") {

                if(empty($_POST['bName'])) {                    
                    $bookNameerr = "Please Fill up the Book Name!";
                }

               

                else {
                    $bookName = $_POST['bName'];
                   

                    $log_file = fopen("bbook.txt", "r");                    
                    $data = fread($log_file, filesize("bbook.txt"));                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                   




                        
                     {
                         session_start();
                          $_SESSION['user'] = $bookName;
                          header("Location: vbook.php");
                        }
                    }
                    $loginfail = "Book is not availebale.";
                }
            
        ?>
        
        <h1>Welcome to Digital E-Book</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Search Book</b></legend>
            
                <label for="bookName">Book Id:</label>
                <input type="text" name="bName" id="bookName">
                <?php echo $bookNameerr; ?>

                
                <br>

               

               
                
                </fieldset>

                <?php echo $loginfail; ?>

                <br>
                
            <input type="submit" value="Search" name="button"> 
        </form>

        <br>

       

       

        
    </body>
       

        
    </body>