<?php 
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

     include 'class/lead_handel_for_add.php';
     $leadHandel = new LeadFromHandel();
     $leadHandel->Process($_POST);

     //var_dump($leadHandel);

     $nameErr = $leadHandel->nameErr;
     $emailErr = $leadHandel->emailErr;
     $phoneErr = $leadHandel->phoneErr;
     $submitted = $leadHandel->submitted;
     $result = $leadHandel->result;
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="assist/for-css/navbar.css" rel="stylesheet">
    <link href="assist/for-css/add_lead.css" rel="stylesheet">
</head>
<body>
     <?php include 'includes/navbar.php'  ?>
   

    <section class="hero-section">
           <div class="hero-section-container-1">
                
             <div> 


               <div class="hero-section-heading">
               <h4>Leads Information : </h4>
               <h4>Your OutPut :</h4>
               </div>
                <div class="hero-section-input-output">
                    <div class="container">
                        <form method="post" action="add_lead.php">

                       <label> Name :</label> <br> <input id="namefield" type="text" name="name" enable onclick="enableField(this)">
                        <span class="error">* <?php echo $nameErr;?>  </span><br>

                        <label>Email:</label> <br> <input id="emailfield" type="text" name="email" enable onclick="enabledField(this)">
                         <span class="error">* <?php echo $emailErr; ?> </span><br>

                        <label>Phone:</label> <br> <input id="phonefield" type="text" name="phone" enable onclick="enabledField(this)">
                        <span class="error">*<?php echo $phoneErr; ?> </span><br><br>

                         <input class="submitfield" type="submit" name="submit">
                          
                       
                        </form>

                    </div>
                    <div class="hero-section-output">
                    <?php
                       if($nameErr==="" && $emailErr==="" && $phoneErr==""){

                           if($submitted){
                            echo '<p style="color: green; font-weight: bold; font-size: 18px; text-align: center;">' . $result . '</p>';
                           }
                           else{
                             $result = "";
                             echo $result;
                           }
                       }
                    ?>
                    </div>
                </div>
             </div>

           </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
          
        
    </script>
</body>
</html>
