<?php
require('config.php');


?>
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
         html, body {
         overflow: auto;
         width: auto;

         }
         div.main-container {
         width: fit-content;
         }
         div.month-container {
         width: 100%;
         }
         td.day-container {
           min-width: 170px;
           width: 170px;
           max-width: 182px;

         }
         td.member-container{
           min-width: 170px;
           width: 170px;
           max-width: 182px;
           color: white;
           font-weight: 500;
         }
         div.task-card {
           background: rgb(242, 242, 222);
           color: black;
           min-height: 60px;
         }
         td.team-header {
           border:none;
           color: white;
         }
         tr.week-head{
           width: 100%;
         }


         .lightgreen {
           background: #64d891;
         }
         .purple {
           background: #ff0066;
         }
      </style>
</head>
<body>

  <?php
  $sql = "SELECT  user.id, user.name, day.id AS 'day_id', day.title AS 'day_title', (SELECT team.title FROM team WHERE team.id = 2) AS 'groupname' FROM user INNER JOIN day WHERE user.team_id = 2 AND day.week_id = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row

    # display table
    $mytable = '
    <div class="container-fluid mt-4  main-container">
      <table class="table table-bordered week-container">
        <thead>
          <tr class="week-head">
            <th class="text-center">Teams</th>
            <th class="text-center">Sunday</th>
            <th class="text-center">Monday</th>
            <th class="text-center">Tuesday</th>
            <th class="text-center">Wednesday</th>
            <th class="text-center">Thursday</th>
            <th class="text-center">Friday</th>
            <th class="text-center">Saturday</th>
          </tr>
       </thead>
      <tbody>';
    $dayindex = 0;
    $lastGroup = '';
    $kmlhab2a = 0;
    while($row = $result->fetch_assoc()) {
      if ($dayindex % 7 == 0 && $lastGroup == '' || $lastGroup != $row['groupname']) {
        $lastGroup = $row['groupname'];
        $mytable .= '
        <!-- team start -->
        <!-- teamHeader Start -->
        <tr class="team-row">
          <td class="text-center team-header lightgreen"><h5>' . $row["groupname"] . '</h5></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
          <td class="team-header lightgreen"></td>
        </tr>
        <!-- teamhederend -->';

      }
      if ($kmlhab2a == 0 || $kmlhab2a != $row['id']) {
        $mytable .= '<tr class="member_week_row"><td class="member-container lightgreen">' . $row['name'] . '</td>';
        $kmlhab2a = $row['id'];
      }
      $mytable .= '<td class="day-container bg-info "><div class="task-card"></div></td>';
      if ($kmlhab2a == 0 || $kmlhab2a != $row['id']) {
        $mytable .= '</tr>';
      }

      $dayindex += 1;
     }
    } else {
      echo "0 results";
    }
    echo $mytable;
    $conn->close();
    die();
  ?>

<div class="container-fluid mt-4  main-container">
  <table class="table table-bordered week-container">
    <thead>
      <tr class="week-head">
        <th class="text-center">Teams</th>
        <th class="text-center">Sunday</th>
        <th class="text-center">Monday</th>
        <th class="text-center">Tuesday</th>
        <th class="text-center">Wednesday</th>
        <th class="text-center">Thursday</th>
        <th class="text-center">Friday</th>
        <th class="text-center">Saturday</th>
      </tr>
    </thead>
    <tbody>

      <!-- team start -->
      <tr class="team-row">
        <td class="text-center team-header lightgreen"><h5>Team1</h5></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
        <td class="team-header lightgreen"></td>
      </tr>


      <tr>
        <td class="member-container lightgreen">
          Member 1
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container lightgreen">
          Member 2
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container lightgreen">
          Member 3
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container lightgreen">
          Member 4
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>

      <!-- Team End -->

     <!-- team start -->
      <tr class="team-row">
        <td class="text-center team-header purple"><h5>Teem2</h5></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
        <td class="team-header purple"></td>
      </tr>


      <tr>
        <td class="member-container purple">
          Member 1
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container purple">
          Member 2
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container purple">
          Member 3
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>


      <tr>
        <td class="member-container purple">
          Member 4
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-warning ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-primary ">
          <div class="task-card">

          </div>
        </td>
        <td class="day-container bg-info ">
          <div class="task-card">

          </div>
        </td>
      </tr>

      <!-- Team End -->
    </tbody>
  </table>
</div>

</body>
</html>
