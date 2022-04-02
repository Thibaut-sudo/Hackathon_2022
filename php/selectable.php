<?php
require '../inc/db_link_other.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/css.css" rel="stylesheet">
    <title>Deloitte</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.png">
    <link href='../css/css.css' rel='stylesheet' />
    <script src='../lib/main.min.js'></script>
    <script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      initialDate: '2022-03-31',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(arg) {
        var title = prompt('Event Title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }
        calendar.unselect()
      },
      eventClick: function(arg) {
        if (confirm('Are you sure you want to delete this event?')) {
          arg.event.remove()
        }
      },
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events


        <?php

        global $db;
        $q = $db->prepare("SELECT * FROM MEETING_SLOT m JOIN CANDIDATE c on c.id_candidate = m.fk_candidate JOIN USERS u on u.id_users = m.fk_users JOIN JOB_OFFER j on j.id_job_offer = m.fk_job_offer");
        $q->execute();
        $result1  = $q->rowCount();
        if($result1 >= 1) {?>
        events: [
       <?php while($result = $q->fetch()) {

            if($result1>=1){
        ?>

            {
                title: '<?php echo $result['title'] ?>',
                start: '<?php echo $result['start_date'] ?>',
                end: '<?php echo $result['end_date'] ?>'
            } <?php if($result1>1){?>,<?php }?>






      <?php
            }
       }?>
        ]
<?php
        }
        ?>
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>
</head>
<header>
    <a class="logo" href="index.php"><img src="../img/Deloitte-logo-750x375.png" alt="Accueil"></a>

    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="nav bar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbars02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="mainPage.php">All offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="myOffers.php">My offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="selectable.php">My planning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " aria-current="page" href="FormulaireAddDispo.php">My disponibility</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>

  <div id='calendar'></div>

</body>
</html>
