<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/css.css" rel="stylesheet">
    <title>Deloitte</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.jpg">

</head>
<header>
    <?php
    include('../inc/header.inc.php');
    ?>
</header>
<body>
<?php
    include ('../inc/db_JOB_OFFER.inc.php');
    use Job\Jobbb;
    $count = Jobbb::getAllJobCount();
    echo "<h2 class = \"count\" >$count vacancies found</h2>";
    ?>
<h2></h2>
<div class = "all-job">
    <?php

    $test=Jobbb::getAllJobPublic();
    foreach ($test as $key) {
            echo "<a class = 'job-title' href = 'offre.php?id=$key->id_job_offer'> ";

            echo "<div class='job'>";
            echo "<h2>$key->title</h2>";
            echo "<p class = \"date\">$key->job_start</p>";
            echo "<p class = \"challenge\">$key->challenges</p>";
            echo "<p class = \"desc\">$key->description</p>";
            echo "</div>";
            echo "</a>";


        }
    ?>
</div>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->

</body>
</html>
