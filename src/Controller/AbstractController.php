<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/05/18
 * Time: 21:06
 */

/**
 * Class AbstractController
 */
abstract class AbstractController extends SessionManager
{

    const DEFAULT_DIRECTORY = 'index';
    const DEFAULT_VIEW = 'login';

    abstract function indexAction();

    /**
     * Créée une propriété pour chaque valeur du tableau $aVariables
     *
     * @param array $aVariables
     * @return $this
     * @throws \Exception
     */
    protected function setVariables(array $aVariables)
    {
        foreach ($aVariables as $sName => $mValue) {
            if (!is_string($sName)) {
                throw new \Exception('La clé doit être une string.');
            }

            $this->{$sName} = $mValue;
        }

        return $this;
    }

    /**
     * Affiche la vue $view du répertoire $directory
     *
     * @param string $directory
     * @param string $view
     * @return mixed
     * @throws \Exception
     */
    protected function render($directory = '', $view = '')
    {
        if (empty($directory) || !is_string($directory)) {
            $directory = self::DEFAULT_DIRECTORY;
        }

        if (empty($view) || !is_string($view)) {
            $view = self::DEFAULT_VIEW;
        }

        $sFilePath = __DIR__ . '/../View/' . $directory . '/' . $view . '.php';

        // Contrôle de l'existence du fichier
        if (file_exists($sFilePath)) {
            return require_once $sFilePath;
        } else {
            throw new \Exception('Le fichier ' . $sFilePath . ' n\'a pas été trouvé.');
        }
    }

    /**
     * Redirige vers /Nom_du_Controller/Action_du_controller.
     *
     * @param string $controller
     * @param string $action
     */
    protected function redirect($controller = '', $action = '')
    {
        $sControllerName = (string) strtolower(trim($controller));
        $sActionName = (string) strtolower(trim($action));

        if (!empty($sActionName)) {
            header('Location: /' . $sControllerName . '.php?action=' . $sActionName);
            exit;
        } else {
            header('Location: /' . $sControllerName);
            exit;
        }
    }

    /**
     * Affiche la page 404
     *
     * @return mixed
     * @throws \Exception
     */
    public function pageNotFound()
    {
        return $this->render('error', '404');
    }
}