<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
   .color_viewer {
     min-width: 15px;
     min-height: 15px;
     max-height: 15px;
     max-width: 15px;
     width: 15px;
     height: 15px;
     display: inline-block;
     margin-left: 5px;
   }
   
   .months-table {
  display: table-caption;
  height: 500px;
  overflow-y: scroll;
   }
  </style>
</head>
<body>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Task Board Admin</h1>      
    <p>On this page you can control the task panel, add months, add teams, team members (users), edit users, assign roles (only user with admin/manager role can view this page</p>
  </div>
</div>


<div class="container mb-2">
  <div class="d-inline-flex">  
  <h2>Teams</h2>
  <button class="ml-2 btn btn-primary" data-toggle="modal" data-target="#addTeam">Add New</button>
  </div>
</div>
<div class="container">    
  <table class="table table-dark table-hover mb-5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Color Label</th>
        <th>Total Memebers</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Marketing</td>
        <td><span class="color_viewer" style="background:orange;"></span> orange </td>
        <td>2</td>
        <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger" data-toggle="tooltip" title="Note By removing a team, you accept the removal of all members of that team from the system">Remove</button>
        
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Ninjas</td>
        <td><span class="color_viewer" style="background:black;"></span> black</td>
        <td>3</td>
        <td>
           <button class="btn btn-success" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger" data-toggle="tooltip" title="Note By removing a team, you accept the removal of all members of that team from the system">Remove</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Mangers</td>
        <td><span class="color_viewer" style="background:green;"></span> custom_green</td>
        <td>2</td>
        <td>
           <button class="btn btn-success" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger" data-toggle="tooltip" title="Note By removing a team, you accept the removal of all members of that team from the system">Remove</button>
        
        </td>
      </tr>
      
    </tbody>
  </table>
</div>

<div class="container mb-2">
  <div class="d-inline-flex">  
  <h2>Memebers</h2>
  <button class="ml-2 btn btn-primary" data-toggle="modal" data-target="#addMemeber">Add New</button>
  </div>
</div>

<div class="container">
  <table class="table table-dark table-hover mb-5">
    <thead>
      <tr>
        <th>ID</th>
        <th>name</th>
        <th>System role</th>
        <th>position</th>
        <th>team Title</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Mahmoud</td>
        <td>Editor</td>
        <td>Developer</td>
        <td>Ninjas</td>
        <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger">Remove</button>
        
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>samir</td>
        <td>viewer</td>
        <td>Social Media support</td>
        <td>Marketing</td>
        <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger" data->Remove</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Jone Doe</td>
        <td>admin</td>
        <td>market manger</td>
        <td>Mangers</td>
        <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger" data->Remove</button>
        
        </td>
      </tr>
      
    </tbody>
  </table>
</div>

<div class="container mb-2">
  <div class="d-inline-flex">  
  <h2>Months</h2>
  <button class="ml-2 btn btn-primary" data-toggle="modal" data-target="#addMonth">Add New</button>
  </div>
</div>
<div class="container ">
  <table class="table table-dark table-hover months-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Year</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>
      
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button data-toggle="tooltip" title="Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system" class="btn btn-danger">Remove</button></td>
      </tr>
    </tbody>
  </table>
</div>



<!-- models -->

  <!-- Edit Team Model -->
  <div class="modal" id="editTeam">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Team Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Edit Team.
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- end model -->
  
  
  
   <!-- Edit Memeber Model -->
  <div class="modal" id="editMemeber">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Team Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Edit memeber..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- end model -->
  
  
    <!-- Add Team Model -->
  <div class="modal" id="addTeam">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Team</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
         <form>
           <div class="form-group">
            <label for="email">Title:</label>
            <input type="email" class="form-control" placeholder="Enter email" id="email" required>
          </div>
  
  <div class="form-group">
    <label for="pwd">Color:</label>
    <input type="text" class="form-control" placeholder="Enter Label Color" id="classname">
    <input type="color" class="form-control" id="classcolor">
  </div>
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-success">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end model -->
  
    <!-- Edit Team Model -->
  <div class="modal" id="addMemeber">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form>
           <div class="form-group">
            <label for="add_user_name" title="name to be displayed on task board required">Name:</label>
            <input type="text" class="form-control" placeholder="Enter Member Display Name" id="add_user_name" required>
          </div>
            <div class="form-group">
            <label for="add_user_joindate" title="when this user joined the company optional">Joined Date:</label>
            <input type="date" id="add_user_joindate" class="form-control">
          </div>         
          <div class="form-group">
            <label for="add_user_role">Role:</label>
            <select class="form-control" id="add_user_role" required>
              <option value="viewer" selected>Viewer</option>
              <option value="editor">Editor</option>
              <option value="admin">Admin</option>            
            </select>
          </div>
          
          
          <div class="form-group">
            <label for="add_user_position" >Position:</label>
            <input type="text" id="add_user_position" class="form-control" placeholder="Enter User Position">
          </div>
            <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" class="form-control" placeholder="Enter user login" required>
          </div>
           <div class="form-group">
            <label for="userpass">Password:</label>
            <input type="password" class="form-control" id="userpass" placeholder="Enter User password" required>
          </div>
             <div class="form-group">
            <label for="email" title="note you can not add user without team exist Add team first">team:</label>
            <select class="form-control" required>
            
            </select>
          </div>        
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-success">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
  <!-- end model -->
  
    <!-- Edit Team Model -->
  <div class="modal" id="addMonth">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Team Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form>
  <div class="form-group">
  

    <label for="email">Month Name:</label>
    <select class="form-control">
<option value="January" selected>January</option>
<option value="February">February</option>
<option value="March">March</option>
<option value="April">April</option>
<option value="May">May</option>
<option value="June">June</option>
<option value="July">July</option>
<option value="August">August</option>
<option value="September">September</option>
<option value="October">October</option>
<option value="November">November</option>
<option value="December">December</option>
    </select>
  </div>
  <div class="form-group">
    <label for="add_month_date">Month Date:</label>
    <input type="date" id="add_month_date" class="form-control">
  </div>
  <div class="form-group">
    <label for="add_month_year">Year:</label>
    <input type="number" value="2021" min="2002" id="add_month_year" class="form-control" required>
  </div>
  
   
  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>
  <!-- end model -->

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

  const addMonthDateInput = document.getElementById("add_month_date");
  const addMonthYearInput = document.getElementById("add_month_year");

const getYearFromDate = ()=> {
   if (addMonthDateInput.value == "") {
      addMonthYearInput.value = "2021";
      return false;
   }

  const date = new Date(addMonthDateInput.value);
  addMonthYearInput.value = date.getFullYear();
  
}

addMonthDateInput.addEventListener("change", getYearFromDate);

</script>

</body>
</html>
