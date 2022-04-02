<?php


namespace Application;

require_once '../inc/db_link.inc.php';

use DB\DBLink;
use http\Exception;
use PDO;


setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
class Application
{

}
class Applicationdb{

    const TABLE_NAME = 'APPLICATION';


    public function getAllApplicationWithUserId($id)
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " JOIN CANDIDATE ON CANDIDATE.id_candidate = APPLICATION.fk_candidate where statut !=1 and fk_job_offer = '$id' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "APPLICATION\APPLICATION");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getAllApplicationWithUserIdFilter($id,$gender,$grade)
    {
        if($gender!=null && $grade!= null){
            $result = array();

            $bdd = null;
            try {
                $bdd = DBLink::connect2db(MYDB, $message);
                $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " JOIN CANDIDATE ON CANDIDATE.id_candidate = APPLICATION.fk_candidate where statut !=1 and fk_job_offer = '$id' AND gender = '$gender' AND grade = '$grade' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "APPLICATION\APPLICATION");
            } catch (Exception $e) {
                $message .= $e->getMessage() . '<br>';
            }
            DBLink::disconnect($bdd);
            return $result;
        }else if($gender != null  && $grade == null){
            $result = array();

            $bdd = null;
            try {
                $bdd = DBLink::connect2db(MYDB, $message);
                $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " JOIN CANDIDATE ON CANDIDATE.id_candidate = APPLICATION.fk_candidate where statut !=1 and fk_job_offer = '$id' AND gender = '$gender'", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "APPLICATION\APPLICATION");
            } catch (Exception $e) {
                $message .= $e->getMessage() . '<br>';
            }
            DBLink::disconnect($bdd);
            return $result;

        }
        else if($gender == null  && $grade != null){
            $result = array();

            $bdd = null;
            try {
                $bdd = DBLink::connect2db(MYDB, $message);
                $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " JOIN CANDIDATE ON CANDIDATE.id_candidate = APPLICATION.fk_candidate where fk_job_offer = '$id' AND grade = '$grade' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "APPLICATION\APPLICATION");
            } catch (Exception $e) {
                $message .= $e->getMessage() . '<br>';
            }
            DBLink::disconnect($bdd);
            return $result;

        }

    }








}

?>
