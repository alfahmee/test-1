 <!DOCTYPE html>
 <html>
 <head>
     <title></title>
 </head>
 <body>
     <?php  
 $mydata=file_get_contents("Cart.txt");
        $data=json_decode($mydata);
        $s= count($data);        

        for($i = 0; $i< $s; $i++) {

             echo "<fieldset>


                <legend><b>Book:</b></legend>";

             echo "Book Id : ".$data[$i]->bid."<br>";
             echo "Book Title : ".$data[$i]->bookName."<br>";
             echo "Book Price : ".$data[$i]->bprice."<br>";
             echo "</fieldset>";


        }


  ?>

  <?php
            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "BuyBook") {
                $q=$ubid=$ubprice=$ubquantiy=$ubtitle="";
            	

                $bookid=$_POST['bid'];
                //echo $bookid;

                $mydata=file_get_contents("Book.txt");
                    $data=json_decode($mydata);
                    $s= count($data);


                    for($i = 0; $i< $s; $i++) {


                    if($data[$i]->bid == $_POST['bid']) 
			            {

			            	if($data[$i]->bquantity<=0)
			            	{
			            		echo "book Not availabe";
			            	}
			            	else{

			            		$ubid=$data[$i]->bid;
			            		$ubprice=$data[$i]->bprice;
			            		$ubquantiy=$data[$i]->bquantity;
			            		$ubtitle=$data[$i]->bookName;


			            	$q=$data[$i]->bquantity-1;
			               $data = file_get_contents('Book.txt');

						
						$json_arr = json_decode($data, true);

						foreach ($json_arr as $key => $value) {
						    if ($value['bid'] == $bookid) {


						        $json_arr[$key]['bquantity'] = $q;
						    }
						}

						
						if(file_put_contents('Book.txt', json_encode($json_arr,JSON_PRETTY_PRINT))){
							echo "success";
							$formdata=array(
		   	       					            'bookName'=> $ubtitle,
		   	       					            'bid'=> $ubid,
		   	       					    		'bprice'=> $ubprice,
		   	       					    		'bquantity'=> $q,
		   	       					           );

		   	                                    $existingdata=file_get_contents('BookHistory.txt');
		   	       								$tempJSONdata=json_decode($existingdata);
		   	       								$tempJSONdata[]=$formdata;
		   	       
		   	       								$jsondata=json_encode($tempJSONdata,JSON_PRETTY_PRINT);
		   	       
		   	       								file_put_contents("BookHistory.txt","$jsondata");
		   	       								header('Location: Payment.php');


						}

						else
						{

							echo "not success";

						}
						}
			                
			            }
			        }
                    }

        ?>

        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">




            <input type="text" name="bid" placeholder="Enter book Id ">
            <input type="submit" value="BuyBook" name= "button">
            
        </form>
         <h5>Back to the <a href="profile.php">profile</a></h5>  

 
 </body>
 </html>
      