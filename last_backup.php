<?php
require('config.php');
require('head.php');
?>


  <style>
        @font-face {
          font-family: 'Open Sans';
          font-style: italic;
          font-weight: 800;
          src: local('Open Sans ExtraBold'), local('OpenSans-ExtraBold'), url('assets/fonts/OpenSans-ExtraBold.ttf');
        }
         html, body {
         overflow: auto;
         width: auto;
         font-size: 1rem;
         font-family: Verdana, Tahoma, "Trebuchet MS", "DejuVu Sans", "Bitstream Vera Sans", sans-serif;

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
         .teamtitle {
           font-weight: 600;
           font-size: .825em;
           background: rgb(12, 200, 50);
           border: 1px solid white;
           border-radius: 8px;

           padding: 5px;
           color: white;
         }
         tr.week-head{
           width: 100%;
         }
         .week-real-container {
            height: auto;
            overflow: auto;
         }
         .custom_font_opensans {
           font-family: 'Open Sans';
           letter-spacing: 1px;

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
    echo "<style>";
    $cssClass = "SELECT title, color FROM label;";
    $cssResult = $conn->query($cssClass);
    if ($cssResult->num_rows > 0) {
      while( $rowCss = $cssResult->fetch_assoc() ){
        echo "
        ." . $rowCss['title'] . " {
          background: " . $rowCss['color'] . ";
        }";
      }

    }

    echo "</style>";
  ?>

  <?php
  // display table
  $mytable = '
  <div class="container-fluid mt-4  main-container">
    <div class="d-flex p-3 text-white month-container week-real-container">';

  // show weeks tables
  $weeksQuery = "SELECT id, week_name FROM week";
  $weeksResult = $conn->query($weeksQuery);
  if ($weeksResult->num_rows > 0) {

    while( $weekrow = $weeksResult->fetch_assoc() ) {
      $selectedweekid = $weekrow['id'];
      echo "<!-- Week-" . $weekrow['week_name'] .  "-->";

  $mytable .= '
    <table class="table table-bordered week-container mr-3">
      <caption class="bg-info text-center text-white text-justify text-uppercase font-weight-bold custom_font_opensans">' . $weekrow['week_name'] .  '</caption>
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

  $sqlnoproblem = "SELECT id FROM team";
  $teamidResult = $conn->query($sqlnoproblem);
if ($teamidResult->num_rows > 0) {

  while($temarow = $teamidResult->fetch_assoc()) {
    $selectedteamid = $temarow['id'];

  $sql = "SELECT user.id, user.name, day.id AS 'day_id', day.title AS 'day_title', (SELECT team.title FROM team WHERE team.id = $selectedteamid) AS 'groupname',
  (SELECT label.title FROM label INNER JOIN team ON label.id = team.label_id WHERE team.id = $selectedteamid) AS 'teamclass' FROM user INNER JOIN day WHERE day.week_id = 1 AND user.team_id = $selectedteamid ORDER BY user.id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    $dayindex = 0;
    $lastGroup = '';
    $kmlhab2a = 0;
    while($row = $result->fetch_assoc()) {
      if ($dayindex % 6 == 0 && $lastGroup == '' || $lastGroup != $row['groupname']) {
        $lastGroup = $row['groupname'];
        $mytable .= '
        <!-- team start -->
        <!-- teamHeader Start -->
        <tr class="team-row ' . $row['teamclass'] .'">
          <td class="text-center team-header"><h6 class="teamtitle">' . $row["groupname"] . '</h6></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
          <td class="team-header"></td>
        </tr>
        <!-- teamhederend -->';

      }
      if ($kmlhab2a == 0 || $kmlhab2a != $row['id']) {
        $mytable .= '<tr class="member_week_row"><td class="member-container ' . $row['teamclass'] . '">' . $row['name'] . '</td>';
        $kmlhab2a = $row['id'];
      }
      $mytable .= '<td class="day-container bg-info "><div class="task-card"></div></td>';
      if ($kmlhab2a == 0 || $kmlhab2a != $row['id']) {
        $mytable .= '</tr>';
      }

      $dayindex += 1;
     }
    }

    /* END of Memeber query while */
}
  // team query while end
}
  // end of team query while

    $mytable .= '</table>';

  }
}
/* End of week query and while */

    $mytable .= '</div></div>';
    echo $mytable;
    $conn->close();
    die();
  ?>

</body>
</html>
