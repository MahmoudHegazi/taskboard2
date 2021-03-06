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
   
   .eighity-width {
      width: 80px;
   }
  </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Admin Control Panel</h1>      
    <p>On this page you can control the task panel, add months, add teams, team members (users), edit users, assign roles (only user with admin/editor role can view this page</p>
  </div>
</div>
<div class="container mb-2">
  <div class="d-inline-flex">  
  <h2 class="ml-2">Teams</h2>
  <button class="ml-2 btn btn-primary" data-toggle="modal" data-target="#addTeam">Add New</button>
  </div>
</div>
<div class="container">
<p class="ml-3">Note By removing a team, you accept the removal of all members of that team from the system</p>
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
          <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Developers</td>
        <td><span class="color_viewer" style="background:black;"></span> black</td>
        <td>3</td>
        <td>
           <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Mangers</td>
        <td><span class="color_viewer" style="background:green;"></span> custom_green</td>
        <td>2</td>
        <td>
           <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editTeam">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        
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
        <td>developers</td>
        <td>
          <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>samir</td>
        <td>viewer</td>
        <td>Social Media support</td>
        <td>Marketing</td>
        <td>
          <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Jone Doe</td>
        <td>admin</td>
        <td>market manger</td>
        <td>Mangers</td>
        <td>
          <button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMemeber">Edit</button>
          <button class="btn btn-danger eighity-width">Remove</button>
        
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
<div class="container">
<p>Note By removing a Month, you accept the removal of all Weeks and tasks of that Months from the system</p>
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
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>
      
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><button class="btn btn-success eighity-width" data-toggle="modal" data-target="#editMonth">Edit</button></td>
        <td><button class="btn btn-danger eighity-width">Remove</button></td>
      </tr>
    </tbody>
  </table>
</div>
<div class="container mt-5">
<h2>Automate Add Full Year</h2>
<form class="form-inline">
  <label for="automate_year_input" class="mr-sm-2">Enter Year:</label>
  <input type="number" class="form-control mb-2 mr-sm-2" placeholder="Year" min="2002" max="99999" id="automate_year_input" required>
  <button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>
</div>
<!-- models -->
 
      <!-- Edit Team Model -->
  <div class="modal" id="editTeam">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Team Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
         <form>
           <div class="form-group">
            <label for="edit_team_title">Team Title:</label>
            <input type="text" id="edit_team_title" class="form-control" placeholder="Enter Team Title" required>
          </div>
  
  <div class="form-group">
    <label for="edit_team_color">Color:</label>
    <input type="text" class="form-control" title="Keep the color names unique otherwise the system will change the color name automatically" placeholder="Label Color name" id="edit_team_colorname">
    <input type="color" class="form-control" id="edit_team_color">
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
  </div>
  <!-- end model -->
  
  
 
  
     <!-- Edit User Model -->
  <div class="modal" id="editMemeber">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form>
           <div class="form-group">
            <label for="edit_user_name" title="name to be displayed on task board required">Name:</label>
            <input type="text" class="form-control" placeholder="Enter Member Display Name" id="edit_user_name" required>
          </div>
            <div class="form-group">
            <label for="edit_user_joindate" title="when this user joined the company optional">Joined Date:</label>
            <input type="date" id="edit_user_joindate" class="form-control">
          </div>         
          <div class="form-group">
            <label for="edit_user_role">Role:</label>
            <select class="form-control" id="edit_user_role" required>
              <option disabled label="select user role"></option>
              <option value="viewer" selected>Viewer</option>
              <option value="editor">Editor</option>
              <option value="admin">Admin</option>            
            </select>
          </div>
          
          
          <div class="form-group">
            <label for="edit_user_position" >Position:</label>
            <input type="text" id="edit_user_position" class="form-control" placeholder="Enter User Position">
          </div>
            <div class="form-group">
            <label for="edit_user_username">Username:</label>
            <input type="text" id="edit_user_username" class="form-control" placeholder="Enter user login" required>
          </div>
           <div class="form-group">
            <label for="edit_user_pass">Password:</label>
            <input type="password" class="form-control" id="edit_user_pass" placeholder="Enter User password" required>
          </div>
             <div class="form-group">
            <label for="edit_user_id" title="Note: It is not possible to add a user without a team. Add a team first">team:</label>
            <select id="edit_user_id" class="form-control" required>
               <option disabled label="Select Team"></option>
            </select>
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
  </div>
  <!-- end model -->
  
  
  
        <!-- Edit Month Model -->
  <div class="modal" id="editMonth">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Month Name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form>
  <div class="form-group">
  
    <label for="edit_month_name">Month Name:</label>
    <select id="edit_month_name" name="edit_month_name" class="form-control">
    <option disabled label="Select Month Name"></option>
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
    <label for="edit_month_name">Month Date:</label>
    <input type="date" id="edit_month_name" class="form-control">
  </div>
  <div class="form-group">
    <label for="edit_month_name">Year:</label>
    <input type="number" value="2021" min="2002" name="edit_month_name" id="edit_month_name" class="form-control" required>
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
            <label for="add_team_title">Team Title:</label>
            <input type="text" name="add_team_title" class="form-control" placeholder="Enter Team Title" id="add_team_title" required>
          </div>
  
  <div class="form-group">
    <label for="add_team_colorname">Color:</label>
    <input name="add_team_colorname" type="text" title="Keep the color names unique otherwise the system will change the color name automatically" class="form-control" placeholder="Label Color Title" id="add_team_colorname">
    <input type="color" class="form-control" name="add_team_color" id="add_team_color">
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
  </div>
  <!-- end model -->
  
    <!-- Add New User Model -->
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
            <label for="add_user_name"  title="name to be displayed on task board required">Name:</label>
            <input type="text" name="add_user_name"  class="form-control" placeholder="Enter Member Display Name" id="add_user_name" required>
          </div>
            <div class="form-group">
            <label for="add_user_joindate" title="when this user joined the company optional">Joined Date:</label>
            <input type="date" name="add_user_joindate" id="add_user_joindate" class="form-control">
          </div>         
          <div class="form-group">
            <label for="add_user_role">Role:</label>
            <select class="form-control"  name="add_user_role" id="add_user_role" required>
              <option disabled label="select user role"></option>
              <option value="viewer" selected>Viewer</option>
              <option value="editor">Editor</option>
              <option value="admin">Admin</option>            
            </select>
          </div>
          
          
          <div class="form-group">
            <label for="add_user_position" >Position:</label>
            <input type="text" name="add_user_position" id="add_user_position" class="form-control" placeholder="Enter User Position">
          </div>
            <div class="form-group">
            <label for="add_user_username">Username:</label>
            <input type="text" name="add_user_username" id="add_user_username" class="form-control" placeholder="Enter user login" required>
          </div>
           <div class="form-group">
            <label for="add_user_pass">Password:</label>
            <input type="password"  name="add_user_pass" class="form-control" id="add_user_pass" placeholder="Enter User password" required>
          </div>
             <div class="form-group">
            <label for="add_user_team" title="note you can not add user without team exist Add team first">team:</label>
            <select id="add_user_team"  name="add_user_team" class="form-control" required>
              <option disabled label="Select Team"></option>
            
            </select>
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
  </div>
  <!-- end model -->
  
    <!-- Add Month Model -->
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
  
    <label for="add_month_name">Month Name:</label>
    <select id="add_month_name" name="add_month_name" class="form-control">
    <option disabled label="Select Month Name"></option>
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
    <input type="number" value="2021" min="2002" name="add_month_year" id="add_month_year" class="form-control" required>
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
  </div>
  <!-- end model -->
  
  

<script>
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
