<?php
  
  include 'class/for_search.php';
  $retrieveValue = new SearchValue();
  $retrieveValue->Process($_POST);
  $leads = $retrieveValue->getleads();
  $nameErr = $retrieveValue->getnameErr();
  $name = $retrieveValue->getName();
 // var_dump($leads);

?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <link href="assist/for-css/search_lead.css" rel="stylesheet">
    </head>

    <body>
      <?php include 'includes/navbar.php';  ?>

      <section class="hero-section">
        <div class="hero-section-layer-1">
               <h4>SEARCH LEAD</h4>
                 <div class="hero-section-lead-search">
                    <form action="" method="POST">
                     <label style="margin-bottom: 5px;">Search Lead By Name :</label><br>
                     <input type="text"  name="name"required><br>
                     <span class="error"><?php echo $nameErr;?></span><br>
                     <input type="submit" name="submit">
                    </form>
                </div>

                <?php if(isset($leads) && count($leads)>0):?>
                     <div class="table-responsive mt-4">
                     <h2 class="mb-4">Matching Leads</h2>
                     <table class="table table-bordered table-striped">
                      <thead class="table-dark"></thead>

                          <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                          </tr>
                         
                          <tbody>
                            <?php foreach($leads as $lead): ?>

                              <tr>
                                <td><?php echo htmlspecialchars($lead["id"]) ?> </td>
                                 <td><?php echo htmlspecialchars($lead["name"]) ?> </td>
                                 <td><?php echo htmlspecialchars($lead["email"]) ?> </td>
                                 <td><?php echo htmlspecialchars($lead["phone"]) ?> </td>
                              </tr>

                            <?php endforeach; ?>
                          </tbody>

                     </table>

                     </div>
                         
                 <?php elseif(!isset($leads)): ?>
                      <p class="mt-4 text-danger">No leads found with the name <?php echo htmlspecialchars($name) ?> </p>
                  <?php endif ?>
        </div>

      </section>
    </body>
</html>