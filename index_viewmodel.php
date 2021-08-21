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

         /* Cards here */
         .task_card{
           border: none;
           background: brown;
           position: relative;
         }
         .task_card_body {
           padding: 4px;
           width: 95%;
           margin-left: auto;
           height: 100%;
           background: white;
           margin-top: 0;
           border: none;
         }
         .card-body.task_card_body h6 {
           font-size: 13px;
           color: white;
         }
         .card-body.task_card_body p {
           font-size: 11px;
           color: black;
         }

         .card-body .card_label {
           background: brown;
         }

         .card_toolbar {
           position: absolute;
           top: 0px;
           right: -30px;
           border: 1px solid gray;
           text-align: center;
           text-align: center;
           width: 30px;
           z-index: 111;
           border-bottom: 1px solid gray;
           height: 100%;
         }

         .task_card .card_toolbar .toolbtn {
             width: 100%;
             background: white;
             color: black;
             border: none;
             border-bottom: 1px solid gray;
             height: 50%;
             display: block;
             cursor: pointer;
             padding-top: 5px;
         }

         .task_card .card_toolbar .toolbtn {
           color: #e59314;
           background: white;
         }

         .task_card .card_toolbar .toolbtn:hover {
           background: #e59314;
           color: white;
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
      $mytable .= '
        <td class="day-container bg-info ">
           <div class="tasks-card-container">
             <!-- Cards Container -->

             <!-- new Card -->';

             $carduniqueid = 'card-' . uniqid();
      $mytable .= '
             <div class="card task_card" id="'. $carduniqueid .'">
               <div class="card-body task_card_body">
                 <h6 class="card-title card_label text-white p-1">Card title</h6>
                 <p class="card-text text-right">00:00 - 01:30</p>
              </div>
              <div class="card_toolbar" style="display:none;">
                  <i class="toolbtn tool_edit fa fa-edit" data-card-color="#FFFFFF" data-card-bg="#a52a2a" data-card-title="Card title" data-card-start="2021-08-11T03:00" data-card-end="2021-08-11T04:30" data-toggle="modal" data-target="#card_editmodel" class="fa fa-edit" fa fa-edit"></i></span>
                  <i class="toolbtn fa fa-trash"></i>
              </div>
            </div>
           </div>
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
          <h4 class="modal-title">Modal <span id="model_title_head"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="d-flex justify-content-start align-content-center">
              <div class="col-2"><label>Task: </label></div>
              <div class="col-8"><input id="model_edit_title" class="form-control"></div>
            </div>
            <div class="mt-2 d-flex justify-content-start align-content-center">
              <div class="col-2">Start</div>
              <div class="col-8"><input id="model_edit_start" type="datetime-local" class="form-control"></div>
            </div>

             <div class="mt-2 d-flex justify-content-start align-content-center">
              <div class="col-2">End</div>
              <div class="col-8"><input id="model_edit_end" type="datetime-local" class="form-control"></div>
            </div>


             <div class="mt-2 d-flex justify-content-start align-content-center">
               <div class="form-group col-3">
                 <label for="email">Text:</label>
                 <input id="text_color_input" type="color" value="#FFFFFF" class="form-control" >
               </div>
               <div class="form-group col-4">
                 <label for="email">Background:</label>
                 <input id="backgroundcolor_input" type="color" value="#495057" class="form-control">
               </div>




               <div class="form-group col-5">
                 <div class="card task_card" id="model_preview_main" style="background: #495057;">
                   <div class="card-body task_card_body">
                     <h6 class="card-title card_label p-1" id="model_preview_title" style="background: #495057; color:#FFFFFF;">Card title</h6>
                     <p class="card-text text-right">00:00 - 01:30</p>
                  </div>
                </div>
               </div>


            </div>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Save Changes</button>

        </div>

      </div>
    </div>
  </div>


  <script>
   window.addEventListener('DOMContentLoaded', (event) => {

    /* Global Vars */
    const allCards = document.querySelectorAll(".task_card");

    /* Card Preview Vars */
    const modelColorInput = document.querySelector("#text_color_input");
    const modelBackgroundInput = document.querySelector("#backgroundcolor_input");
    const modelPreviewMain = document.querySelector("#model_preview_main");
    const modelPreviewTitle = document.querySelector("#model_preview_title");

    const modelTitleHead = document.querySelector("#model_title_head");
    const modelEditTitle = document.querySelector("#model_edit_title");
    const modelEditStart = document.querySelector("#model_edit_start");
    const modelEditEnd = document.querySelector("#model_edit_end");


    /* Helper functions */

/*
    const showCardToolBar = (event)=> {
      const cardHtmlId = event.target.getAttribute("data-card-id");
      const cardElm = document.querySelector(`#${cardHtmlId}`);
      if (cardElm) {
        const targetToolBar = cardElm.querySelector(".card_toolbar");
        if (targetToolBar) {
          targetToolBar.style.display = "block";
        }
      }
      return false;
    }
*/
    const showCardToolBar = (event)=> {
      const cardToolBar = event.target.querySelector(".card_toolbar");
        if (cardToolBar) {
          cardToolBar.style.display = "block";
        }
      return false;
    }


    const hideToolBar = (event)=> {
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


    /* app script */

    /* Card Preview Section */
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
    /* Card Preview Section End */


    /* Edit Card Model */

    /* Show edit details */
    const allEditBtns = document.querySelectorAll(".tool_edit");

    const showCardDetails = (event)=> {
      const cardBackground = event.target.getAttribute("data-card-bg");
      const cardColor = event.target.getAttribute("data-card-color");
      const cardStart = event.target.getAttribute("data-card-start");
      const cardEnd = event.target.getAttribute("data-card-end");
      const cardTitle = event.target.getAttribute("data-card-title");
      /* Colors */
      modelPreviewTitle.style.color = cardColor;
      modelPreviewMain.style.background = cardBackground;
      modelPreviewTitle.style.background = cardBackground;

      modelBackgroundInput.value = cardBackground;
      modelColorInput.value =  cardColor;

      /* Data Text */
      modelTitleHead.innerText = cardTitle;
      modelEditTitle.value = cardTitle;
      modelEditStart.value = cardStart;
      modelEditEnd.value = cardEnd;

    };
    allEditBtns.forEach( (editBtn)=> {
      editBtn.addEventListener( "click", showCardDetails );

    });

    /* Show edit details end */


});
  </script>

</body>
</html>
