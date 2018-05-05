<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/05/18
 * Time: 20:20
 */

/**
 * Class AbstractModel
 */
abstract class AbstractModel
{

    const DBNAME = 'perso';
    const HOST = 'localhost';
    const USER = 'root';
    const PWD = 'gfp';

    const SQL_ERROR = "Une erreur s'est produite, veuillez réessayer ultérieurement.";

    public $bdd;

    /**
     * ConnectionPDO constructor.
     * @param string $dbname
     * @param string $host
     * @param string $user
     * @param string $password
     * @throws \Exception
     */
    public function __construct($dbname = '', $host = '' , $user = '', $password = '')
    {
        // Connexion à une base ODBC
        if (empty($user) || !is_string($user)) {
            $dbname = self::DBNAME;
        }
        if (empty($password) || !is_string($password)) {
            $host = self::HOST;
        }
        if (empty($user) || !is_string($user)) {
            $user = self::USER;
        }
        if (empty($password) || !is_string($password)) {
            $password = self::PWD;
        }

        $dsn = 'mysql:dbname=' . $dbname . ';host=' . $host;

        $this->bdd = new \PDO($dsn, $user, $password);

        if (!$this->bdd) {
            throw new \Exception('Connexion à la base de données impossible.');
        }
    }

}