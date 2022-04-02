<?php
include ('../inc/db_MEETING_SLOT.inc.php');

require '../inc/db_link_other.inc.php';


use Meeting_slot\Meeting_slotdb;

?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
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
</head>
<body>
<?php include('../inc/header.inc.php'); ?>

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


    <?php
    if(!isset($_POST['submit'])){
        ?><h1>Get my appointment</h1>
        <p>Here are the free slots of the HR</p>

        <div id='calendar'></div>

        <div id="container">

        <form id="middle" class = "inscription" action="" method="POST" style="width: unset">
            <p>Choose your slot</p>

            <label>Date</label>
            <input id="date" name='date' type="date" value="2022-04-01"><br>

            <label>Time start</label><input id="start" name="start" type="time" ><br>
            <label for="stop">Time end</label><input id="stop" name="stop" type="time" ><br>


            <input type="submit" name="submit" value="Add">

        </form>
        </div>
        <?php
    }else{

        echo "<h3>Your appointment is planned ! :D</h3>";
        $date=$_POST['date'];
        $start=$_POST['start'];
        $stop=$_POST['stop'];



        $dateStart = $date. " ". $start.':00';
        $dateStop = $date. " ". $stop.':00';


        $test = Meeting_slotdb::insertMeetingWithUser($dateStart,$dateStop,6);

    }
    ?>
</div>
</body>
</html>
