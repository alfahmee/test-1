<!DOCTYPE html>
<html>
    <head>
        <title>View Book</title>
    </head>
    <body>

    
    <?php









    



 
        session_start();
        $userid = $_SESSION['book'];

        $log_file = fopen("book.txt", "r");
        
        $data = fread($log_file, filesize("book.txt"));

        $data_filter = explode("\n", $data);
        
        for($i = 0; $i< count($data_filter)-1; $i++) {
            
            $json_decode = json_decode($data_filter[$i], true);
            

            if($json_decode['bookName'] == $userid) 
            {
                $bookName = $json_decode['bookName'];
                $bid = $json_decode['bid'];
                $bauthor = $json_decode['bauthor'];
                 $bpublisher = $json_decode['bpublisher'];
                $bedition = $json_decode['bedition'];
                $bprice = $json_decode['bprice'];
                $image = $json_decode['image'];
            }
        }
        fclose($log_file);

        ?>

        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Logout") {
                unset($_SESSION['user']); 
                header('Location: login.php');
                }



                if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Add to Cart") {
              
                header('Location: addtocart.php');


                 
                }
        ?>
        
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <input type="submit" value="Add to Cart" name= "button">
            <
        </form>
        </form>

            <fieldset>
                <legend><b>Book info:</b></legend>

                <?php echo '<img src="image/'.$image.'" alt="Image" width="100" height="130">' ?>

                <br>
            
                <label for="firstname">First Name:</label>
                <?php echo $bookName; ?>

                <br>

                <label for="lastname"> LastName:</label>
                <?php echo $bid; ?>

                <br>

                <label for="gender">Gender:  </label>
                <?php echo $bauthor; ?>

                <br>

                <label for="phone"> Phone Number:</label>
                <?php echo $bpublisher; ?>

                <br>

                 <label for="location">Location:  </label>
                <?php echo $bprice; ?>

                <br>

                
            </fieldset>

             <h5>Go to <a href="searchbook.php">Search Book</a></h5>
        
    </body>
</html>
