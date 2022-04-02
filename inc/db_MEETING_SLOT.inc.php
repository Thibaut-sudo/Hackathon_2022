<?php


namespace Meeting_slot;

require_once '../inc/db_link.inc.php';

use DB\DBLink;
use http\Exception;
use PDO;


setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
class Meeting_slot
{
    public $title ;
    public $job_start ;
    public $challenges ;
    public $description;
}
class Meeting_slotdb
{

    const TABLE_NAME = 'JOB_OFFER';


    public function insertMeeting($start, $stop)
    {


        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO `MEETING_SLOT`(`start_date`, `end_date`,`fk_candidate`,`fk_job_offer`,`fk_users`) VALUES (:start ,:stop,1,5,5)");


            $stmt->bindValue(':start', $start);
            $stmt->bindValue(':stop', $stop);


            if ($stmt->execute()) {
                $message .= "";
                $noError = true;

            } else {
                $message .= 'Une erreur système est survenue.<br>
                    Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site.
                    (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }
    public function insertMeetingWithUser($start, $stop,$user)
    {
        $noError = false;
        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $stmt = $bdd->prepare("INSERT INTO `MEETING_SLOT`(`start_date`, `end_date`,`fk_candidate`,`fk_job_offer`,`fk_users`) VALUES (:start ,:stop,2,6,5)");


            $stmt->bindValue(':start', $start);
            $stmt->bindValue(':stop', $stop);
       //     $stmt->bindValue(':user', $user);


            if ($stmt->execute()) {
                $message .= "";
                $noError = true;

            } else {
                $message .= 'Une erreur système est survenue.<br>
                    Veuillez essayer à nouveau plus tard ou contactez l\'administrateur du site.
                    (Code erreur: ' . $stmt->errorCode() . ')<br>';
            }
            $stmt = null;
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $noError;
    }
}

?>
