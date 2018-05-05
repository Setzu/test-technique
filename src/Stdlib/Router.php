<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/05/18
 * Time: 21:00
 */

/**
 * Class Router
 */
class Router
{

    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION = 'indexAction';
    const REGEX_PARAMS = '#^[a-zA-Z0-9 =]*$#';

    public $param;

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function dispatch()
    {
        $sUri = $_SERVER['REQUEST_URI'];
        $aParamsUri = explode('?', $sUri, 2);

        if (isset($aParamsUri[0]) && $aParamsUri[0] == '/index.php' || $aParamsUri[0] == '/') {
            $sController = self::DEFAULT_CONTROLLER;
        } else {
            return (new IndexController())->pageNotFound();
        }

        if (isset($aParamsUri[1]) && !empty($aParamsUri[1])) {
            if (preg_match(self::REGEX_PARAMS, $aParamsUri[1])) {
                $aParams = explode('=', $aParamsUri[1]);
                $sActionName = ucfirst(strtolower(trim(htmlspecialchars($aParams[1])))) . 'Action';
            } else {
                return (new IndexController())->pageNotFound();
            }
        } else {
            $sActionName = self::DEFAULT_ACTION;
        }

        if (!method_exists($sController, $sActionName)) {
            return (new IndexController())->pageNotFound();
        }

        return (new $sController)->$sActionName();
    }

    /**
     * Récupère toutes les valeurs en POST
     *
     * @return array
     */
    public static function getPostValues()
    {
        $values = [];

        foreach ($_POST as $k => $v) {
            $values[$k] = htmlspecialchars(trim($v));
        }

        return $values;
    }

    /**
     * @return string|null
     */
    public static function getParams()
    {
        $sUri = $_SERVER['REQUEST_URI'];
        $aParamsUri = explode('/', $sUri, 3);

        if (isset($aParamsUri[3]) && !empty($aParamsUri[3]) && preg_match(self::REGEX_PARAMS, $aParamsUri[3])) {
            return $aParamsUri[3];
        } else {
            return null;
        }
    }
}