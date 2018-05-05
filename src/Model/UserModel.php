<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/05/18
 * Time: 20:40
 */

/**
 * Class UserModel
 */
class UserModel extends AbstractModel
{

    /**
     * UserModel constructor.
     * @param string $dbname
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct($dbname = '', $host = '', $user = '', $password = '')
    {
        parent::__construct($dbname, $host, $user, $password);
    }

    /**
     * @param string $username
     * @return array
     */
    public function selectUserByUsername($username)
    {
        $select = 'SELECT * FROM user WHERE username = :username';

        try {
            $stmt = $this->bdd->prepare($select);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $aResult = $stmt->fetch(\PDO::FETCH_ASSOC);
            $stmt->closeCursor();
        } catch (\PDOException $e) {
//             die($e->getMessage());

            return [];
        }

        return $aResult;
    }
}