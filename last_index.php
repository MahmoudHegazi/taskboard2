<?php
require('config.php');
require('head.php');

$monthid = 1;
$htmlmessage = '';
if (isset($_GET['month'])&& !empty($_GET['month']) && is_int(intval(htmlspecialchars(stripslashes(trim($_GET['month'])))))){
  $selectedMonth = intval(htmlspecialchars(stripslashes(trim($_GET['month']))));
  /* check if month exist in case user enter month manual */
  $selectMonthString = "SELECT id FROM month WHERE id=$selectedMonth LIMIT 1";
  $selectMonthExec = $conn->query($selectMonthString);
  $selectMonthResult = $selectMonthExec->fetch_row();
  if ($selectMonthResult[0]) {
    $monthid = $selectMonthResult[0];
  } else {
    $selectLastMonthString = "SELECT id, month_date, month_name, year FROM month ORDER BY id DESC LIMIT 1";
    $selectMonthExec1 = $conn->query($selectLastMonthString);
    $selectMonthResult1 = $selectMonthExec1->fetch_row();
    if ($selectMonthResult1[0]) {
      /* We did not find the selected month return last month instead with message */
      $htmlmessage = '
      <div class="alert alert-danger alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Alert!</strong> We did not find the exact month, the app will display the last month in the system instead '
        . $selectMonthResult1[1] .', '. $selectMonthResult1[2] .' ('. $selectMonthResult1[3] .') .'. '</div></div>';
      $monthid = $selectMonthResult1[0];

    } else {
      /* 0 Months In the app show Inital message */
      echo '
      <div class="container">
        <div class="jumbotron">
          <h1 class="text-center mb-3">The Team Task Board</h1>
          <p class="text-center">Welcome to the Team task board we didn\'t find any months
          <span style="font-size:30px;">&#128549;</span>
          please if you are an admin <br />go to the admin page and enter a new month to be shown.</p>
        </div>
        <div class="container text-center">
          <img src="https://i.pinimg.com/originals/5d/35/e3/5d35e39988e3a183bdc3a9d2570d20a9.gif">
        </div>
      </div>
      <style>
        body {
          background-color: #f0f0f057;
        }
      </style>
      ';
      exit();
    }
  }

} else {
  /* no month in query check if month else only show inital message */
  $selectMonthString0 = "SELECT id FROM month WHERE id=$monthid";
  $selectMonthExec0 = $conn->query($selectMonthString0);
  $selectMonthResult0 = $selectMonthExec0->fetch_row();
  if (!$selectMonthResult0[0]) {
    /* user not selected month and no months exist */
    echo '
    <div class="container">
      <div class="jumbotron">
        <h1 class="text-center mb-3">The Team Task Board</h1>
        <p class="text-center">Welcome to the Team task board we didn\'t find any months
        <span style="font-size:30px;">&#128549;</span>
        please if you are an admin <br />go to the admin page and enter a new month to be shown.</p>
      </div>
      <div class="container text-center">
        <img src="https://i.pinimg.com/originals/5d/35/e3/5d35e39988e3a183bdc3a9d2570d20a9.gif">
      </div>
    </div>
    <style>
      body {
        background-color: #f0f0f057;
      }
    </style>
    ';
    exit();
  } else {
    $monthid = $monthid;
  }

}

?>



</head>
<body>

  <?php
    echo "
    <style>
    /* System CSS */
    ";
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

    $cardClass = "SELECT * FROM card_class";
    $cardClassResult = $conn->query($cardClass);
    if ($cardClassResult->num_rows > 0) {
      while( $cardRowCss = $cardClassResult->fetch_assoc() ){
        echo "

        ." . $cardRowCss['classname'] . " {
          background: " . $cardRowCss['background'] . ";
          color: " . $cardRowCss['color'] . "
          }
        ." . $cardRowCss['classname'] . '_background { background: ' . $cardRowCss['background'] . ";}

          ";
      }

    }
    echo "

    </style>

    ";

  ?>

  <style id="system_js_style">

  </style>
  <!-- errors or message -->
    <?php echo $htmlmessage; ?>
  <div class="container mt-3" id="ok_alert_container">

  </div>
  <?php
  function showUsersPlease() {
    global $conn;
    $usersQuery = "SELECT id, name FROM user";
    $usersResult = $conn->query($usersQuery);
    $usersHTML = "";
    if ($usersResult->num_rows > 0) {

      while( $useRow = $usersResult->fetch_assoc() ) {
        $usersHTML .= '<option value="'. $useRow['id'] .'" >'. $useRow['name'] .'</option>';
      }
    }
    return $usersHTML;
  }

  $theAllUsers = showUsersPlease();
  // display table

  $selectMonths = 'SELECT id, month_date, month_name, year FROM month ORDER BY id ASC;';
  $selectMonthsResult = $conn->query($selectMonths);
  $months_options = "";
  $totalMonths = $selectMonthsResult->num_rows;
  $isThereMonths = $totalMonths ? 'disabled' : '';
  if ($totalMonths > 0) {
      while( $monthRow = $selectMonthsResult->fetch_assoc() ) {
        $isChecked = ($monthid == $monthRow['id']) ? 'selected' : '';
        $months_options .= '<option value="'. $monthRow['id'] .'" '. $isChecked .'>'. $monthRow['month_name'] .', '. $monthRow['year'] .' ('. $monthRow['month_date'] .')</option>';
      }
  }
  ?>
  <div class="container" id="month_select_container">
      <form method="get" action="" class="form-inline">
        <div class="form-group">
          <!-- d-flex p-3 flex-nowrap align-items-baseline align-content-start -->
            <label for="select_month">Select Month</label>
            <select id="select_month" name="month" class="form-control ml-2">
              <option <?php echo $isThereMonths; ?> value="0" >Select A month</option>
              <?php echo $months_options; ?>
            </select>
            <button type="submit" class="btn btn-success ml-3">Display Month</button>
       </div>
    </form>
  </div>

  <?php

  /* Get days options */
  $days_inthis_month = "";


  //$sqlDays = "SELECT day.id, day.title,  FROM day INNER JOIN week WHERE week.month_id=$monthid ORDER BY day.id, week.id";
  //$sqlDaysCustomized = "SELECT *, (SELECT week_name FROM week WHERE month_id=$monthid AND id=$i LIMIT 1) AS weekname FROM day WHERE week_id = (SELECT id FROM week WHERE month_id = $monthid LIMIT 1) ORDER BY id";
  $sqlDaysCustomized = "SELECT day.id, day.title, week.week_name FROM day INNER JOIN week ON day.week_id = week.id WHERE week.month_id=$monthid ORDER BY day.id";
  $sqlDaysResult = $conn->query($sqlDaysCustomized);
  //SELECT * FROM day WHERE week_id = (SELECT id FROM week WHERE month_id = $i LIMIT 1)
  if ($sqlDaysResult->num_rows > 0) {
      while( $dayrow = $sqlDaysResult->fetch_assoc() ) {
        $days_inthis_month .= '<option value="'. $dayrow['id'] .'">'.$dayrow['title'].' ('. $dayrow['week_name'] .')</option>';
      }
  };


  /* Month Id here and very nice empty if no data */

  $mytable = '
  <div class="container-fluid mt-4  main-container" id="the_app_maincont">
    <div class="d-flex p-3 text-white month-container week-real-container flex-nowrap align-items-baseline align-content-start">';
  // show weeks tables
  $weeksQuery = "SELECT id, week_name FROM week WHERE month_id=$monthid";
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
  (SELECT label.title FROM label INNER JOIN team ON label.id = team.label_id WHERE team.id = $selectedteamid) AS 'teamclass' FROM user INNER JOIN day WHERE day.week_id = $selectedweekid AND user.team_id = $selectedteamid ORDER BY user.id ASC, day.id ASC ";
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

      /* Cards */

      $currentDayId = $row['day_id'];
      $currentUserId = $row['id'];
      //$card_sql = "SELECT * FROM card WHERE day_id = $currentDayId AND user_id = $currentUserId ORDER BY id ASC";
      $card_sql = "SELECT * FROM (SELECT id AS 'classid', `classname`, `background`, `color` FROM card_class) AS x INNER JOIN card ON x.classid = card.class_id WHERE card.day_id = $currentDayId AND card.user_id = $currentUserId ORDER BY card.id ASC";
      $card_result = $conn->query($card_sql);

      $container_id = 'container_' . $currentDayId . '_' . $currentUserId;
      $mytable .= '
        <td class="day-container bg-info " style="position: relative;" data-day="'. $currentDayId .'">
           <div class="tasks-card-container" id="' . $container_id . '">
             <!-- Cards Container -->

             <!-- new Card -->';

             if ($card_result->num_rows > 0) {


              //$carduniqueid = 'card-' . uniqid();
              while ($cardRow = $card_result->fetch_assoc()){
                /* GET hours minutes for display  */
                $start_date = strtotime($cardRow['start_date']);
                $start_date = date('H:m', $start_date);
                $end_date = strtotime($cardRow['end_date']);
                $end_date = date('H:m', $end_date);

                /* GET time formated in html datetime-local input value */
                $d_start=strtotime($cardRow['start_date']);
                $d_start_local = date("Y-m-d\Th:i", $d_start);
                $d_end=strtotime($cardRow['end_date']);
                $d_end_local = date("Y-m-d\Th:i", $d_end);
      $mytable .= '
             <div class="card task_card mt-2 '. $cardRow['classname'] . '_background' .'" id="card_id_'. $cardRow['id'] .'" data-card-dbid="' . $cardRow['id'] . '">
               <div class="card-body task_card_body">
                 <h6 class="card-title card_label '. $cardRow['classname'] .' p-1">' . $cardRow['title'] . '</h6>
                 <p class="card-text text-right">' . $start_date  . ' - ' . $end_date . '</p>
              </div>
              <div class="card_toolbar" style="display:none;">
                  <i class="toolbtn tool_edit fa fa-edit" data-card-dbid="' . $cardRow['id'] . '" data-card-color="' . $cardRow['color'] . '" data-card-bg="' . $cardRow['background'] . '" data-card-title="' . $cardRow['title'] . '" data-card-classname="' . $cardRow['classname'] . '" data-card-start="'. $d_start_local .'" data-card-end="' . $d_end_local . '"
                  data-class-id="'. $cardRow['classid'] .'" data-user-id="'. $cardRow['user_id'] .'"  data-day-id="'. $cardRow['day_id'] .'" data-card-elmid="card_id_'. $cardRow['id'] .'"
                  data-container-id="' . $container_id . '" data-toggle="modal" data-target="#card_editmodel"></i></span>

                  <i class="toolbtn fa fa-trash remove_card_btn" data-card-dbid="' . $cardRow['id'] . '" data-card-id="card_id_'. $cardRow['id'] .'"></i>
              </div>
            </div>';
           }
         }

        $mytable .= '</div><i data-card-parentid="'. $container_id .'" data-container-id="' . $container_id . '" data-day-id="' . $currentDayId  .'" data-user-id="' . $currentUserId . '" data-toggle="modal" data-target="#card_addmodel"  class="fa fa-plus add_new_card"  style="display:none;"></i>
        </td>';
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
  ?>

  <!-- Models -->

  <!-- Card Edit Modal -->
  <div class="modal" id="card_editmodel">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">(Edit) <span id="model_title_head"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <!-- error Edit message -->
          <div id="edit_message_container">

          </div>
            <div class="d-flex justify-content-start align-content-center align-items-center">
              <div class="col-2"><label>Task: </label></div>
              <div class="col-8"><input id="model_edit_title" class="form-control"></div>
            </div>
            <div class="mt-2 d-flex justify-content-start align-content-center align-items-center">
              <div class="col-2">Start</div>
              <div class="col-8"><input id="model_edit_start" type="datetime-local" class="form-control"></div>
            </div>

             <div class="mt-2 d-flex justify-content-start align-content-center align-items-center">
              <div class="col-2">End</div>
              <div class="col-8"><input id="model_edit_end" type="datetime-local" class="form-control"></div>
            </div>

            <div class="mt-2 d-flex justify-content-start align-content-center align-items-center">
             <div class="col-2">Owner</div>
             <div class="col-8">
               <select id="model_edit_owner" class="form-control">
                 <option disabled>Select User</option>
                 <?php echo $theAllUsers; ?>
               </select>
             </div>
           </div>

           <div class="mt-2 mb-2 d-flex justify-content-start align-items-center align-content-center">
            <div class="col-2">Day</div>
            <div class="col-5 d-flex">
              <select id="model_edit_day" class="form-control custom_select_aligned" title="The day can be changed to a day in the same month only">
                <option disabled>Select Day</option>
                <?php echo $days_inthis_month; ?>
              </select>
            </div>
            <span style="font-size:13px;">(in the same month only)</span>
          </div>

             <div class="mt-2 d-flex justify-content-start align-content-center align-items-center">
               <div class="form-group col-3">
                 <label for="email">Text:</label>
                 <input id="text_color_input" type="color" value="#FFFFFF" class="form-control" >
               </div>
               <div class="form-group col-4">
                 <label for="email">Background:</label>
                 <input id="backgroundcolor_input" type="color" value="#495057" class="form-control">
               </div>




               <div class="form-group col-5">
                 <div class="card task_card_preview" id="model_preview_main">
                   <div class="card-body task_card_body">
                     <h6 class="card-title card_label p-1" id="model_preview_title">Card title</h6>
                     <p class="card-text text-right">00:00 - 01:30</p>
                  </div>
                </div>
               </div>


            </div>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="submit_edtbtn_model">Save Changes</button>

        </div>

      </div>
    </div>
  </div>



  <!-- Card Add Modal -->
  <div class="modal" id="card_addmodel">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Card</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <!-- error message -->
          <div id="add_message_container">

          </div>
            <div class="d-flex justify-content-start align-content-center">
              <div class="col-2"><label>Task: </label></div>
              <div class="col-8"><input id="model_add_title" class="form-control" required></div>
            </div>
            <div class="mt-2 d-flex justify-content-start align-content-center">
              <div class="col-2">Start</div>
              <div class="col-8"><input id="model_add_start" type="datetime-local" class="form-control" required></div>
            </div>

             <div class="mt-2 d-flex justify-content-start align-content-center">
              <div class="col-2">End</div>
              <div class="col-8"><input id="model_add_end" type="datetime-local" class="form-control" required></div>
            </div>


             <div class="mt-2 d-flex justify-content-start align-content-center">
               <div class="form-group col-3">
                 <label for="email">Text:</label>
                 <input id="textcolor_add_input" type="color" value="#FFFFFF" class="form-control" >
               </div>
               <div class="form-group col-4">
                 <label for="email">Background:</label>
                 <input id="backgroundcolor_add_input" type="color" value="#495057" class="form-control">
               </div>




               <div class="form-group col-5">
                 <div class="card task_card_preview" id="model_preview_main_add" style="background: #495057;">
                   <div class="card-body task_card_body">
                     <h6 class="card-title card_label p-1" id="model_preview_title_add" style="background: #495057; color:#FFFFFF;">Card title</h6>
                     <p class="card-text text-right">00:00 - 01:30</p>
                  </div>
                </div>
               </div>


            </div>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="add_new_cardbtn">Save Changes</button>

        </div>

      </div>
    </div>

  </div>


  <script>


   window.addEventListener('DOMContentLoaded', (event) => {

    /* Global Vars */
    const allCards = document.querySelectorAll(".task_card");
    const allTasksContainers = document.querySelectorAll(".day-container");

    /* Card Preview Vars */
    const modelColorInput = document.querySelector("#text_color_input");
    const modelBackgroundInput = document.querySelector("#backgroundcolor_input");
    const modelPreviewMain = document.querySelector("#model_preview_main");
    const modelPreviewTitle = document.querySelector("#model_preview_title");

    const modelTitleHead = document.querySelector("#model_title_head");
    const modelEditTitle = document.querySelector("#model_edit_title");
    const modelEditStart = document.querySelector("#model_edit_start");
    const modelEditEnd = document.querySelector("#model_edit_end");

    /* Card Add Vars */
    const modelColorInputAdd = document.querySelector("#textcolor_add_input");
    const modelBackgroundInputAdd = document.querySelector("#backgroundcolor_add_input");
    const modelPreviewMainAdd = document.querySelector("#model_preview_main_add");
    const modelPreviewTitleAdd = document.querySelector("#model_preview_title_add");

    const modelAddTitle = document.querySelector("#model_add_title");
    const modelAddStart = document.querySelector("#model_add_start");
    const modelAddEnd = document.querySelector("#model_add_end");


    /* Card Edit Vars */
    const submitEditBtnModel = document.querySelector("#submit_edtbtn_model");




    const alertSystemMainCont = document.querySelector("#ok_alert_container");
    const alertSystemAddCont = document.querySelector("#add_message_container");
    const alertSystemEditCont = document.querySelector("#edit_message_container");

    let addTimeOut;
    let appTimeOut;
    let editTimeOut;
    /* Helper functions */

    /* Add errors */
    const showAddError = (msg, type="alert-danger")=> {
      const newAlertMessage = `
      <div class="alert ${type} alert-dismissible fade show" id="show_add_error_cont" style="display:none;background:darksalmon;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <span id="show_add_error_msg">This alert box could indicate a dangerous or potentially negative action.</span>
      </div>
      `;
      alertSystemAddCont.innerHTML = newAlertMessage;
      const showAddErrorContainer = document.querySelector("#show_add_error_cont");
      const showAddErrorMsg = document.querySelector("#show_add_error_msg");
      clearTimeout(addTimeOut);
      showAddErrorMsg.innerText  = msg;
      showAddErrorContainer.style.display = "block";
      setTimeout(()=> {
        showAddErrorContainer.style.background = "";
      }, 150);
      addTimeOut = setTimeout(()=> {
        showAddErrorMsg.innerText = "";
        showAddErrorContainer.style.display = "none";
      }, 6000);
      return true;
    };


    /* edit errors */
    const showEditError = (msg, type="alert-danger", noti="darksalmon")=> {

      const newAlertMessage = `
      <div class="alert ${type} alert-dismissible fade show" id="show_edit_error_cont" style="display:none;background:${noti};">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <span id="show_edit_error_msg">This alert box could indicate a dangerous or potentially negative action.</span>
      </div>
      `;
      alertSystemEditCont.innerHTML = newAlertMessage;
      const showEditErrorContainer = document.querySelector("#show_edit_error_cont");
      const showEditErrorMsg = document.querySelector("#show_edit_error_msg");
      clearTimeout(editTimeOut);
      showEditErrorMsg.innerText  = msg;
      showEditErrorContainer.style.display = "block";
      setTimeout(()=> {
        showEditErrorContainer.style.background = "";
      }, 150);
      editTimeOut = setTimeout(()=> {
        showEditErrorMsg.innerText = "";
        showEditErrorContainer.style.display = "none";
      }, 6000);
      return true;
    };


    const showAppMessage = (msg, type="danger", ml="0")=> {
      const newOneInsteadOfdeleted = `
      <div class="alert fade alert-${type} show" id="normal_app_messasge_container" style="display:none;background:darksalmon;position:relative;left:${ml}px">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span id="normal_app_message"></span>
      </div>`;

       alertSystemMainCont.innerHTML = newOneInsteadOfdeleted;
       const normalAppMessasgeContainer = document.querySelector("#normal_app_messasge_container");
       const normalAppMessage = document.querySelector("#normal_app_message");
       setTimeout(()=> {
         normalAppMessasgeContainer.style.background = "";
       }, 150);
       clearTimeout(appTimeOut);
       normalAppMessage.innerText  = msg;
       normalAppMessasgeContainer.style.display = "block";
       appTimeOut = setTimeout(()=> {
         normalAppMessage.innerText = "";
         normalAppMessasgeContainer.style.display = "none";
       }, 6000);
    }

    const postCardData = async(url = '', data = {}) => {
      const response = await fetch(url, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json',
        },
        // Body data type must match "Content-Type" header
        body: JSON.stringify(data),
      });
      try {
        const newData = await response.json();
        console.log(newData);
        return newData;
      } catch (error) {
        console.log("error", error);
      }
    };

    const dateToDatetimeLocal = (d) => {

    const localDateTime= [d.getFullYear(),
              (d.getMonth()+1).AddZero(),
             d.getDate().AddZero()].join('-') +'T' +
            [d.getHours().AddZero(),
             d.getMinutes().AddZero()].join(':');

       return localDateTime;
    }

    function showCardToolBar (event) {
      const cardToolBar = event.target.querySelector(".card_toolbar");
        if (cardToolBar) {
          cardToolBar.style.display = "block";
        }
      return false;
    }


    function hideToolBar (event) {
      const targetToolBar = event.target.querySelector(".card_toolbar");

      if (targetToolBar) {
          targetToolBar.style.display = "none";
      }
      return false;
    }

    allCards.forEach( (card)=>{
      card.addEventListener("mouseenter", showCardToolBar);
      card.addEventListener("mouseleave", hideToolBar);
    });



    const showCardAddBtn = (event)=> {

      const cardToolBar = event.target.querySelector(".add_new_card");
        if (cardToolBar) {
          cardToolBar.style.display = "block";
        }
      return false;
    }


    const hideAddBtn = (event)=> {
      const targetToolBar = event.target.querySelector(".add_new_card");

      if (targetToolBar) {
          targetToolBar.style.display = "none";
      }
      return false;
    }

    const pauseAddNow = ()=> {
      const allAdds = document.querySelectorAll(".add_new_card");
      allAdds.forEach((item) => {
        if (window.getComputedStyle(item, null).display && window.getComputedStyle(item, null).display == "block"){
                item.style.display = "none";
         }
      });
    };

    const pauseToolBarNow = ()=> {
      const allAdds = document.querySelectorAll(".card_toolbar");
      allAdds.forEach((item) => {
        if (window.getComputedStyle(item, null).display && window.getComputedStyle(item, null).display == "block"){
                item.style.display = "none";
         }
      });
    };


    allTasksContainers.forEach( (card)=>{
      card.addEventListener("mouseenter", showCardAddBtn);
      card.addEventListener("mouseleave", hideAddBtn);
    });

    /* End helpers */

    /* Extend */
    /* to add zero to less than 10, */

    Number.prototype.AddZero= function(b,c){
      var  l= (String(b|| 10).length - String(this).length)+1;
      return l> 0? new Array(l).join(c|| '0')+this : this;
    }

    /* end extend */

    /* app script */

    /* Card Preview Section Edit */
    const showColorPreview = (event)=> {
      modelPreviewTitle.style.color = event.target.value;
      return true;
    }

    const showBackgroundPreview = (event)=> {
      modelPreviewMain.style.background = event.target.value;
      modelPreviewTitle.style.background = event.target.value;
      return true;
    }

    modelColorInput.addEventListener( "input", showColorPreview );
    modelBackgroundInput.addEventListener( "input", showBackgroundPreview );
    /* Card Preview Section Edit End */


    /* Card Preview Section Add */
    const showColorPreviewAdd = (event)=> {
      modelPreviewTitleAdd.style.color = event.target.value;
      return true;
    }

    const showBackgroundPreviewAdd = (event)=> {
      modelPreviewMainAdd.style.background = event.target.value;
      modelPreviewTitleAdd.style.background = event.target.value;
      return true;
    }

    modelColorInputAdd.addEventListener( "input", showColorPreviewAdd );
    modelBackgroundInputAdd.addEventListener( "input", showBackgroundPreviewAdd );
    /* Card Preview Section Add End */


    /* Edit Card Model */

    /* Show edit details */
    let oldAddClass = "";
    let oldAddClassBackground = "";
    const allEditBtns = document.querySelectorAll(".tool_edit");

    const showCardDetails = (event)=> {
      const cardBackground = event.target.getAttribute("data-card-bg");
      const cardColor = event.target.getAttribute("data-card-color");

      const cardStart = event.target.getAttribute("data-card-start");
      const cardEnd = event.target.getAttribute("data-card-end");
      const cardTitle = event.target.getAttribute("data-card-title");
      const cardClassname = event.target.getAttribute("data-card-classname");
      const cardClassId = event.target.getAttribute("data-class-id");
      const cardUserId = event.target.getAttribute("data-user-id");
      const cardDayId = event.target.getAttribute("data-day-id");
      const cardElmId = event.target.getAttribute("data-card-elmid");
      const cardDbId = event.target.getAttribute("data-card-dbid");
      const cardParentId = event.target.getAttribute("data-container-id");

      /* save alot of sql queries */
      const selectUserInput = document.querySelector("#model_edit_owner");
      if (selectUserInput.options.length > 1){
        const usersOptions = Array.from(selectUserInput.options);
        usersOptions.forEach( (uo)=>{
          if (uo.selected){
            uo.removeAttribute("selected");
          }
        });
        for (let l=0; l<usersOptions.length; l++){
          if (usersOptions[l].value == cardUserId){
            usersOptions[l].setAttribute("selected","true");
            break;
          }
        }
      }

      const selectDayInput = document.querySelector("#model_edit_day");
      if (selectDayInput.options.length > 1){

        const daysOptions = Array.from(selectDayInput.options);
        daysOptions.forEach( (op)=>{
          if (op.selected){
            op.removeAttribute("selected");
          }
        });
        for (let d=0; d<daysOptions.length; d++){
          if (daysOptions[d].value == cardDayId){
            daysOptions[d].setAttribute("selected","true");
            break;
          }
        }
      }


      /* Colors */
      if (!modelPreviewTitle.classList.contains(cardClassname)){
        if (modelPreviewTitle.classList.contains(oldAddClass)){
          modelPreviewTitle.classList.remove(oldAddClass);
        }
        oldAddClass = cardClassname;
        modelPreviewTitle.classList.add(cardClassname);
      }
      if (!modelPreviewMain.classList.contains(`${cardClassname}_background`)){
        if (modelPreviewMain.classList.contains(oldAddClassBackground)){
          modelPreviewMain.classList.remove(oldAddClassBackground);
        }
        oldAddClassBackground = `${cardClassname}_background`;
        modelPreviewMain.classList.add(`${cardClassname}_background`);
      }

      modelPreviewTitle.innerText = cardTitle;
      modelBackgroundInput.value = cardBackground;
      modelColorInput.value =  cardColor;

      /* Data Text */
      modelTitleHead.innerText = cardTitle;
      modelEditTitle.value = cardTitle;
      modelEditStart.value = cardStart;
      modelEditEnd.value = cardEnd;
      submitEditBtnModel.setAttribute("data-class-id", cardClassId);
      submitEditBtnModel.setAttribute("data-card-elmid", cardElmId);
      submitEditBtnModel.setAttribute("data-card-dbid", cardDbId);
      submitEditBtnModel.setAttribute("data-container-id", cardParentId);

    };
    allEditBtns.forEach( (editBtn)=> {
      editBtn.addEventListener( "click", showCardDetails );

    });



    /* Show edit details end */

    /* Add New Card */

    const addNewCardBtn = document.querySelector("#add_new_cardbtn");


    const associateNewCardMeta = (event)=> {
      const checkIfContainer = document.querySelector("#show_add_error_cont");
      if (checkIfContainer){
        checkIfContainer.remove();
      }
      const cardDayId = event.target.getAttribute("data-day-id");
      const cardUserId = event.target.getAttribute("data-user-id");
      const cardContainerId = event.target.getAttribute("data-container-id");
      const cardParenId = event.target.getAttribute("data-card-parentid");



      addNewCardBtn.setAttribute("data-day-id", cardDayId);
      addNewCardBtn.setAttribute("data-user-id", cardUserId);
      addNewCardBtn.setAttribute("data-container-id", cardContainerId);
      addNewCardBtn.setAttribute("data-card-parentid", cardParenId);
    }
    const allAddCardBtns = document.querySelectorAll(".add_new_card");
    allAddCardBtns.forEach( (addBtn)=> {
      addBtn.addEventListener( "click" , associateNewCardMeta);
    });


    /* Function to add new card */

    const createCardTemplate = (data, container_id, parent_id)=> {

      const startDate = new Date(data.start);
      const endDate = new Date(data.end);

      const startTime = startDate.getHours().AddZero() + ":" + startDate.getMinutes().AddZero();
      const endTime = endDate.getHours().AddZero() + ":" + endDate.getMinutes().AddZero();

      const fullStartTime = dateToDatetimeLocal(startDate);
      const fullEndTime = dateToDatetimeLocal(endDate);

      /* append temproary class until php work (refresh) */
      const temp_style = document.querySelector("#system_js_style");
      temp_style.innerHTML += `
         .${data.classname} { background: ${data.background}; color: ${data.color};
       }
       .${data.classname}_background { background: ${data.background};}

       `;

      const cardTempalte = `<div class="card task_card mt-2 ${data.classname}_background" id="card_id_${data.id}" data-card-dbid="${data.id}">
        <div class="card-body task_card_body">
          <h6 class="card-title card_label ${data.classname} p-1">${data.title}</h6>
          <p class="card-text text-right">${startTime} - ${endTime}</p>
       </div>
       <div class="card_toolbar" style="display:none;">
           <i  class="toolbtn tool_edit fa fa-edit" data-container-id="${parent_id}" data-card-dbid="${data.id}" data-card-elmid="card_id_${data.id}" data-card-classname="${data.classname}" data-card-title="${data.title}"
           data-card-color="${data.color}" data-card-bg="${data.background}" data-card-start="${fullStartTime}" data-card-end="${fullEndTime}" data-class-id="${data.class_id}" data-user-id="${data.user_id}"  data-day-id="${data.day_id}" data-toggle="modal" data-target="#card_editmodel"></i></span>
           <i  class="toolbtn fa fa-trash remove_card_btn" data-card-dbid="${data.id}" data-card-id="card_id_${data.id}"></i>
       </div>
     </div>`;
     return cardTempalte;

   };
    const addNewCardRequest = async (event)=> {

      if (modelAddTitle.value.trim() == "") {
        showAddError("Title Is required");
        return false;
      }

       if (modelAddStart.value.trim() == "") {
        showAddError("Start Date Is required");
        return false;
      }

       if (modelAddEnd.value.trim() == ""){
        showAddError("End Date Is required");
        return false;
      }

       if (modelColorInputAdd.type != "color" || modelBackgroundInputAdd.type != "color") {
        showAddError("Changing the color input type is not allowed here");
        return false;
      }

      if (modelAddStart.type != "datetime-local" || modelAddEnd.type != "datetime-local") {
       showAddError("Changing the date type is not allowed here");
       return false;
     }

     const selectedUserId = Number(addNewCardBtn.getAttribute("data-user-id"));
     const selectedDayId = Number(addNewCardBtn.getAttribute("data-day-id"));
     const cardContainerId = addNewCardBtn.getAttribute("data-container-id");
     const cardParentId = addNewCardBtn.getAttribute("data-card-parentid");

     const selectedCardContainer = document.querySelector(`#${cardContainerId}`);


     if (isNaN(selectedUserId) || isNaN(selectedDayId) || selectedUserId == 0 || selectedDayId == 0) {
       showAddError("The user Could not be added Make sure not use Inspect");
       return false;
     }

      const addCardData = {
        title: modelAddTitle.value,
        start: modelAddStart.value,
        end: modelAddEnd.value,
        color: modelColorInputAdd.value,
        background: modelBackgroundInputAdd.value,
        userid: selectedUserId,
        selectedDayId: selectedDayId,
      }
      const addCardRe = await postCardData("includes/add_cards_requests.php", addCardData);
      if (addCardRe.code == 200){
        let newCard = createCardTemplate(addCardRe.data, cardContainerId, cardParentId);
        // here not error
        selectedCardContainer.innerHTML += newCard;

        /* Re apply the events on the new card no way to add direct to single element */

        /* SHow tool bar event */
        const allCards1 = document.querySelectorAll(".task_card");
        allCards1.forEach( (card)=> {
          card.addEventListener("mouseenter", showCardToolBar);
          card.addEventListener("mouseleave", hideToolBar);
        });

        /* remove card event */
        const allCardsRemoveBtns1 = document.querySelectorAll(".remove_card_btn");
        allCardsRemoveBtns1.forEach( (removeBtn)=>{
          removeBtn.addEventListener("click", removeCardRequest);
        });

        /* show card edit values event */
        const allEditBtns1 = document.querySelectorAll(".tool_edit");
        allEditBtns1.forEach( (editBtn)=> {
          editBtn.addEventListener( "click", showCardDetails );

        });

        //tmpEditBtn.addEventListener( "click", showCardDetails );
        showAddError(addCardRe.message, "alert-success");
        return true;
      } else {
        showAddError(addCardRe.message);
        return false;
      }
      return false;
      //showAddError("hi");
    };

    /* UX function */
    const updateEndDate = (event)=> {
      modelAddEnd.value = event.target.value;
    };
    modelAddStart.addEventListener( "change", updateEndDate );
    addNewCardBtn.addEventListener( "click", addNewCardRequest );
    //postCardData modelColorInputAdd modelBackgroundInputAdd modelAddTitle modelAddStart modelAddEnd
    /* End add cards */

    /* Remove card */

    const removeCardRequest = async (event)=> {
      const selectedCardId = Number(event.target.getAttribute("data-card-dbid"));
      const selectedCardContainerId = event.target.getAttribute("data-card-id");
      const selectedCardContainer = document.querySelector(`#${selectedCardContainerId}`);
      if (!selectedCardContainer){
        showAppMessage("the card could not be deleted please restart the app, if not work contact support", "danger");
      }


      /* Prevent unnessery request or abused request using JS something like prepere */
      if (isNaN(selectedCardId) || selectedCardId == 0) {
        showAppMessage("Card could not be deleted if you did not use inspect or updated code contact support");
        return false;
      }

      const deleteCardData = {type: 'delete_card', card_id: selectedCardId};
      const deleteCardRequest = await postCardData("includes/remove_card.php", deleteCardData);
      const mainElmCont = document.querySelector("#the_app_maincont");
      if (deleteCardRequest.code == 200){
        selectedCardContainer.remove();
        const currentMargin = mainElmCont.getBoundingClientRect().width - mainElmCont.getBoundingClientRect().right;
        showAppMessage(deleteCardRequest.message, "success", currentMargin);
        return true;
      } else {
        showAppMessage(deleteCardRequest.message);
        return false
      }
      return false;
    };
    const allCardsRemoveBtns = document.querySelectorAll(".remove_card_btn");
    allCardsRemoveBtns.forEach( (removeBtn)=>{
      removeBtn.addEventListener("click", removeCardRequest);
    });
    /* End remove */

    /* edit cards */

    const updateCardDate = (data, card_id, current_parent)=> {


      const cardToUpdate = document.querySelector(`#${card_id}`);
      const cardEditBtn = cardToUpdate.querySelector("i.tool_edit");

      const cardTitle = cardToUpdate.querySelector("h6.card-title");
      const cardTimes = cardToUpdate.querySelector("p.card-text");

      const startDate = new Date(data.start);
      const endDate = new Date(data.end);

      const startTime = startDate.getHours().AddZero() + ":" + startDate.getMinutes().AddZero();
      const endTime = endDate.getHours().AddZero() + ":" + endDate.getMinutes().AddZero();

      const fullStartTime = dateToDatetimeLocal(startDate);
      const fullEndTime = dateToDatetimeLocal(endDate);
      cardTimes.innerText = `${startTime} - ${endTime}`;
      cardEditBtn.setAttribute("data-card-start", fullStartTime);
      cardEditBtn.setAttribute("data-card-end", fullEndTime);


      cardTitle.innerText = data.title;
      cardEditBtn.setAttribute("data-card-title", data.title);

      /* class work */
      const temp_style1 = document.querySelector("#system_js_style");
      temp_style1.innerHTML += `
         .${data.classname} { background: ${data.background}; color: ${data.color};
       }
       .${data.classname}_background { background: ${data.background};}
       `;


      if (cardTitle.classList.contains(data.previous_class)){
        cardTitle.classList.remove(data.previous_class);
      }
      if (cardToUpdate.classList.contains(`${data.previous_class}_background`)){
        cardToUpdate.classList.remove(`${data.previous_class}_background`);
      }
      if (!cardTitle.classList.contains(data.classname)){
        cardTitle.classList.add(data.classname);
      }
      if (!cardToUpdate.classList.contains(`${data.classname}_background`)){
        cardToUpdate.classList.add(`${data.classname}_background`);
      }
      cardEditBtn.setAttribute("data-card-classname", data.classname);
      cardEditBtn.setAttribute("data-card-color", data.color);
      cardEditBtn.setAttribute("data-card-bg", data.background);

      /* Move card */
      cardEditBtn.setAttribute("data-user-id", data.user_id);
      cardEditBtn.setAttribute("data-day-id", data.day_id);

      const newParentIdCheck = `container_${data.day_id}_${data.user_id}`;
      const theNewParent = document.querySelector(`#${newParentIdCheck}`);
      /* If parent changed in case another userid or another day append card to the right container */
      if (current_parent != newParentIdCheck){
        if (theNewParent){
          theNewParent.appendChild(cardToUpdate);
        } else {
          /* this case must not happend but if happend restart to solve what can be done  wait while card changed done */
          window.location.reload();
        }
      }


      console.log(data, cardToUpdate, data.previous_class);
    }

    const sendEditRequest = async (event)=> {
      const editInputTitle = document.querySelector("#model_edit_title");
      const editInputStart = document.querySelector("#model_edit_start");
      const editInputEnd = document.querySelector("#model_edit_end");
      const editInputColor = document.querySelector("#text_color_input");
      const editInputBackground = document.querySelector("#backgroundcolor_input");
      const editInputDayId = Number(document.querySelector("#model_edit_day").value);
      const editInputUserId = Number(document.querySelector("#model_edit_owner").value);


      const editClassid = event.target.getAttribute("data-class-id");
      const editCardDbId = Number(event.target.getAttribute("data-card-dbid"));

      const cardHTMLid = event.target.getAttribute("data-card-elmid");
      const selectedCardElm = document.querySelector(`#${cardHTMLid}`);

      const cardPrentId = event.target.getAttribute("data-container-id");
      const cardPrentElm = document.querySelector(`#${cardPrentId}`);



      /* Validation JS */
      if (!selectedCardElm){
        showEditError("This card could not be found due to an unexpected error The page will refresh after 7 seconds");
        setTimeout(()=>{window.location.reload()}, 7000);
        return false;
      }

      if (!cardPrentElm){
        showEditError("This card Day container could not be found due to an unexpected error The page will refresh after 7 seconds");
        setTimeout(()=>{window.location.reload()}, 7000);
        return false;
      }

      if (editInputTitle.value.trim() == ""){
        showEditError("!Title Can not be empty");
        return false;
      }
      /* Anti-Abuse Validation */
      if (editInputStart.value.trim() == "" || editInputStart.type != "datetime-local"){
        showEditError("!invalid start date...'.'!");
        setTimeout(()=>{window.location.reload()}, 5000);
        return false;
      }
      if (editInputEnd.value.trim() == "" || editInputEnd.type != "datetime-local"){
        showEditError("!invalid End date...'.'!");
        setTimeout(()=>{window.location.reload()}, 5000);
        return false;
      }
      if (editInputColor.value.trim() == "" || editInputColor.type != "color"){
        showEditError("!invalid Color input do not use inpsect...'.'!");
        setTimeout(()=>{window.location.reload()}, 5000);
        return false;
      }
      if (editInputBackground.value.trim() == "" || editInputBackground.type != "color"){
        showEditError("!invalid background inspect is not allowed...'.'!");
        setTimeout(()=>{window.location.reload()}, 5000);
        return false;
      }

      if (isNaN(editInputDayId) || isNaN(editInputUserId) || isNaN(editCardDbId) || editInputDayId == 0 || editInputUserId == 0 || editCardDbId == 0) {
        showEditError("The card Could not be updated make sure user not deleted and you did not use inspect Try again after 7 seconds");
        setTimeout(()=>{window.location.reload()}, 7000);
        return false;
      }


      /* Valid Request data */
      const cardEditData = {
        id: editCardDbId,
        title: editInputTitle.value,
        start: editInputStart.value,
        end: editInputEnd.value,
        color: editInputColor.value,
        background: editInputBackground.value,
        class_id: editClassid,
        userid: editInputUserId,
        selectedDayId: editInputDayId,
      };
      const editResponse = await postCardData("includes/edit_cards_requests.php", cardEditData);

      if (editResponse.code == 200){
        updateCardDate(editResponse.data ,cardHTMLid, cardPrentId);
        showEditError(editResponse.message, "alert-success", "lightgreen");
      } else {
        showEditError(editResponse.message);
      }

    };
    submitEditBtnModel.addEventListener("click", sendEditRequest);

    /* end edit */

    /* Move the select month with scroll */
    let previousScrollLeft = 0;
    document.body.addEventListener("scroll", (event)=> {

      if (event.target.scrollLeft != previousScrollLeft) {
         document.querySelector("#month_select_container").style.left = event.target.scrollLeft + "px";
         previousScrollLeft = event.target.scrollLeft;
         return true;
      } else {
        return false;
      }

    });




    /* Drag and Drop */
    const allTaskContainers = Array.from(document.querySelectorAll(".tasks-card-container"));
    const allCardsElements = Array.from(document.querySelectorAll(".task_card"));

    let theDragedHeight = 0;
    let oldContainerHeight = 0;
    let contPadding = 0;
    let contBorder = 0;

    let currenDragHeight = 0;

    /* keep everything dynamic if styles changes */
    let standardedTasksContainer = document.querySelector(".tasks-card-container");
    if ( standardedTasksContainer && Number(window.getComputedStyle(standardedTasksContainer, null).getPropertyValue('padding').split("px")[0]) > contPadding){
      contPadding = Number(window.getComputedStyle(standardedTasksContainer, null).getPropertyValue('padding').split("px")[0]);
    }
    if ( standardedTasksContainer && contBorder < (Number(window.getComputedStyle(standardedTasksContainer, null).getPropertyValue('border').split("px")[0]) * 2) ){
      contPadding = (Number(window.getComputedStyle(standardedTasksContainer, null).getPropertyValue('border').split("px")[0]) * 2);
    }


    /* DRAG AND DROP Functions */

  function dragEnter(event) {
    if (event.target.classList.contains("tasks-card-container")){
      event.target.style.border = "2px dotted lavenderblush";
    }
  }

    function dragLeave(event) {
      event.target.style.border = "none";
      if (event.target.classList.contains("tasks-card-container")){
        event.target.style.border = "none";
        pauseToolBarNow();
      }
    }

    function dragEnd(event) {
      event.target.style.border = "none";
      if (event.target.classList.contains("tasks-card-container")){
        event.target.style.border = "none";
      }
    }

    function allowDrop(event) {
      if (event.target.classList.contains("tasks-card-container") ||
      event.target.classList.contains("task_card") ||
      event.target.classList.contains("card-text") ||
      event.target.classList.contains("card-title") ||
      event.target.classList.contains("card-body")

      ){
      event.preventDefault();
      return true;
      }
    }

    function dragStart(event) {
      if (event.target && event.target.classList && event.target.classList.contains("task_card")){
        pauseAddNow();
        pauseToolBarNow();
        event.dataTransfer.setData("text", event.target.id);
        currenDragHeight = event.target.offsetHeight;
        return true;
      }
      return false;
    }

    function drop(event) {
      if (event.target.classList.contains("tasks-card-container")){
        event.preventDefault();
        const data = event.dataTransfer.getData("text");
        const theDraged = document.getElementById(data);
        if (theDraged){
          event.target.appendChild(theDraged);
          event.target.style.border = "none";
          return true;
        }
      } else {
        let index = 0;
        let theNowPrent = event.target;
        while (index < 10) {
          theNowPrent = theNowPrent.parentElement;
          if (theNowPrent.classList.contains("tasks-card-container")){
            event.preventDefault();
            const data = event.dataTransfer.getData("text");
            const theDraged = document.getElementById(data);
            if (theDraged){
              theNowPrent.style.border = "none";
              theNowPrent.appendChild(theDraged);
              break;
              return true;
            }
            event.target.style.border = "none";
            break;
          }
          index++;
        }
      }
      event.target.style.border = "none";
      return false;
    }


    allTaskContainers.forEach( (taskCont)=> {
      taskCont.addEventListener("dragover", allowDrop);
      taskCont.addEventListener("dragenter", dragEnter);
      taskCont.addEventListener("dragleave", dragLeave);
      taskCont.addEventListener("drop", drop);
      taskCont.addEventListener("dragend", dragEnd);
    });

    allCardsElements.forEach( (taskCard)=> {
      taskCard.setAttribute("draggable", true);
      taskCard.addEventListener("dragstart", dragStart);

    });




});
  </script>

</body>
</html>
