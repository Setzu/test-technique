<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/05/18
 * Time: 09:37
 */

/**
 * Class SessionManager
 */
abstract class SessionManager
{

    public $aFlashMessages = [];

    const DEFAULT_EXPIRATION_TIME = 60;
    const FLASH_MESSAGE = 'flashmessage';
    const DANGER = 'danger';
    const SUCCESS = 'success';
    const ICON_DANGER = 'glyphicon-remove';
    const ICON_SUCCESS = 'glyphicon-ok';

    /**
     * SessionManager constructor.
     */
    public function __construct()
    {
        self::startSession();
    }

    /**
     * Démarre la session
     *
     * @param int $expiration
     */
    public static function startSession($expiration = self::DEFAULT_EXPIRATION_TIME)
    {
        $exp = (int) $expiration;

        if (session_status() == PHP_SESSION_NONE || session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            session_cache_expire($exp > 0 ? $exp : self::DEFAULT_EXPIRATION_TIME);
        }
    }

    /**
     * Enregistre $value en session
     *
     * @param mixed $value
     * @param mixed $value
     * @return array|mixed
     * @throws \Exception
     */
    public function setSessionValues($key, $value)
    {
        if (!is_int($key) && !is_string($key)) {
            throw new \Exception('La clé doit être un entier ou une chaîne de caractères');
        }

        return $_SESSION[$key] = $value;
    }

    /**
     * Récupère la session
     *
     * @return array
     */
    public function getSession()
    {
        return $_SESSION;
    }

    /**
     * Enregistre les flash messages en session
     *
     * @param $message
     * @param bool|true $error
     * @throws \Exception
     */
    public function addFlashMessage($message, $error = true)
    {
        if ($error) {
            $type = self::DANGER;
            $icon = self::ICON_DANGER;
        } else {
            $type = self::SUCCESS;
            $icon = self::ICON_SUCCESS;
        }

        $_SESSION[self::FLASH_MESSAGE][$type] = [
            'message' => $message,
            'icon' => $icon
        ];
    }

    /**
     * Affiche les flash messages et les supprimes de la session
     *
     * @return string
     */
    public static function flashMessages()
    {
        $aSession = $_SESSION;
        $sFlashMessages = '';

        if (array_key_exists(self::FLASH_MESSAGE, $aSession)) {
            foreach ($aSession[self::FLASH_MESSAGE] as $type => $aContent) {
                $sFlashMessages .= "<div class='col-md-6 col-md-offset-3 alert alert-$type'><span class='glyphicon " .
                    $aContent['icon'] . "' aria-hidden='true'></span>&nbsp;&nbsp;&nbsp;" . $aContent['message'] . '</div><br>';
            }
        }

        unset($_SESSION[self::FLASH_MESSAGE]);

        return $sFlashMessages;
    }
}