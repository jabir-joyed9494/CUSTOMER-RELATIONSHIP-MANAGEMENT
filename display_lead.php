<?php

  error_reporting(E_ALL);
   ini_set('display_errors', 1);
   include 'class/update.php';
   include 'class/for-display.php';
   
   $displaylead = new DISPLAY();
   $displaylead->Process();
   $leads = $displaylead->getLeads();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $updateLead = new UPDATE();
     $updateLead->Process($_POST);

     $displaylead = new DISPLAY();
   $displaylead->Process();
   $leads = $displaylead->getLeads();
}

if(isset($_GET['confirm_delete'])){
    $delete_id = $_GET['confirm_delete'];
    var_dump($delete_id);
    $crm = new CRM();
    $crm->deleteLead($delete_id);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assist/for-css/display_lead.css" rel="stylesheet">
    </head>

    <body>
          <?php include 'includes/navbar.php'; ?>
            
          <section class="hero-section">
            <div class="hero-section-layer-1">
                <?php if(isset($leads) && count($leads)>0): ?>
                <div class="table-responsive mt-4">
                    <h2 class="mb-4">Leads List</h2>
                    <table class="table table-bordered border-dark table-striped">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($leads as $lead): ?>
                                 <tr class="text-center">
                                    <td><?php echo htmlspecialchars($lead["id"]); ?> </td>
                                    <td><?php echo htmlspecialchars($lead["name"])?> </td>
                                    <td><?php echo htmlspecialchars($lead["email"]) ?> </td>
                                    <td><?php echo htmlspecialchars($lead["phone"]) ?> </td>

                                    <td>
                                       <button class="btn btn-warning btn-sm update-btn" data-id = "<?php echo $lead["id"] ?>"
                                       data-name = "<?php echo $lead["name"] ?>" data-email = "<?php echo $lead["email"] ?>"
                                       data-phone = <?php echo $lead["phone"] ?> data-bs-toggle="modal"
                                       data-bs-target = "#updateModal" >Edit</button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id = <?php echo $lead['id']; ?>
                                         data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                    </td>
                                 </tr>
                                <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

                <?php elseif((!isset($leads))): ?>
                    <p class="mt-4 text-danger">No Leads Found!</p>

                <?php endif ?>
            </div>

          </section>

          <!-- UPDATE POP-UP -->

          <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Lead</h5>
                    </div>
                    <form method="POST">
                           <div class="modal-body">
                             <div class="mb-3">
                                <input type="hidden" name="id" id="updateId">
                               
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateName" name="name">

                                <label for="email" class="from-label">Email</label>
                                <input type="text" class="form-control" id="updateEmail" name="email">

                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="updatePhone" name="phone">

                             </div>
                           </div>
                           <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="update_Lead">Submit</button>
                           </div>
                    </form>
                </div>
            </div>
            
          </div>

          <!-- Delete Modal -->
          
          <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                               <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        </div>

                        <div class="modal-body">
                             Are you sure you want to delete this leads!
                        </div>

                        <div class="modal-footer">
                           <button class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                           <a id="confirmDeleteBtn" href="#" class="btn btn-danger">YES</a>
                        </div>

                    </div>

                </div>
          </div>

          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
           
         <script>
            document.querySelectorAll(".update-btn").forEach(button=>{
                 button.addEventListener('click',function(){
                    document.getElementById('updateId').value = this.getAttribute('data-id');
                    document.getElementById('updateName').value =  this.getAttribute('data-name');
                    document.getElementById('updateEmail').value = this.getAttribute('data-email');
                    document.getElementById('updatePhone').value = this.getAttribute('data-phone');
                 })
            })

            document.querySelectorAll(".delete-btn").forEach(button=>{
                       button.addEventListener('click',function(){
                      let deleteId = this.getAttribute('data-id'); 
                      document.getElementById('confirmDeleteBtn').href = "display_lead.php?confirm_delete=" + deleteId;      
                       })          
            })
         </script>

    </body>
</html>