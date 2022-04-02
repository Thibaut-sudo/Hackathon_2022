<?php


namespace Users;

require_once '../inc/db_link.inc.php';

use DB\DBLink;
use http\Exception;
use PDO;


setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
class Users
{

}
class Usersdb{

    const TABLE_NAME = 'USERS';




    public function getAllUsers()
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . "", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Users\Users");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }

    public function getAllCandidateWithEmail($email)
    {
        $result = array();

        $bdd = null;
        try {
            $bdd = DBLink::connect2db(MYDB, $message);
            $result = $bdd->query("SELECT * FROM " . self::TABLE_NAME . " where email = '$email' ", PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Users\Users");
        } catch (Exception $e) {
            $message .= $e->getMessage() . '<br>';
        }
        DBLink::disconnect($bdd);
        return $result;
    }







}

?>
