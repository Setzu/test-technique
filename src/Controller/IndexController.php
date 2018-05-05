<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/05/18
 * Time: 20:55
 */

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{

    const SESSION_EXPIRATION_TIME = 30;

    /**
     * @return mixed
     */
    public function indexAction()
    {
        $aSession = $this->getSession();

        if (isset($aSession['user'])) {
            return $this->render('index', 'main');
        }

        if (!empty($_POST)) {

            $aPostedDatas = Router::getPostValues();

            if (array_key_exists('username', $aPostedDatas)) {

                $oUserModel = new UserModel();
                $aUserInfos = $oUserModel->selectUserByUsername($aPostedDatas['username']);

                if (!is_array($aUserInfos) || !count($aUserInfos) > 0 || $aPostedDatas['password'] != $aUserInfos['password']) {
                    $this->addFlashMessage('Les informations de connexion sont incorrectes');

                    return $this->render('index', 'login');
                } else {
                    $this->setSessionValues('user', $aUserInfos);

                    return $this->redirect('index', 'main');
                }
            }
        } else {
            return $this->render('index', 'login');
        }

        return $this->render('index', 'login');
    }

    /**
     * @return mixed
     */
    public function mainAction()
    {
        $aSession = $this->getSession();

        if (!isset($aSession['user'])) {
            $this->addFlashMessage('Vous devez être authentifié pour accéder à cette page');

            return $this->render('index', 'login');
        }

        return $this->render('index', 'main');
    }

    /**
     * @return mixed
     */
    public function logoutAction()
    {
        session_destroy();

        return $this->render('index', 'login');
    }
}