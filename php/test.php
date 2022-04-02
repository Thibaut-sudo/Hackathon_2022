


<?php



include ('../inc/db_USERS.inc.php');
use Users\Usersdb;

$test = Usersdb::getAllCandidateWithEmail("a");

foreach ($test as $key){


    echo $key->id_users;
}




?>

<?php

include('../inc/db_CANDIDATE.inc.php');

use Candidate\Candidatedb;
?>
