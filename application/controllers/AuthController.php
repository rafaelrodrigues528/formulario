<?php

/**
 * Classe para autenticação de usuário
 *
 * @category   Zend
 * @package    Zend_Auth
 * @copyright  Copyright (c) 2013
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: @package_version@
 * @link       http://localhost/FormLabDCT
 * @since
 * @deprecated
 */
class AuthController extends Zend_Controller_Action
{

    public function init ()
    {}

    public function indexAction ()
    {
        return $this->_helper->redirector('login');
    }

    public function loginAction ()
    {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();
        $form = new Application_Form_Login();
        $this->view->form = $form;
        // Verifica se existem dados de POST
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            // Formulário corretamente preenchido?
            if ($form->isValid($data)) {
                $login = $form->getValue('login');
                $senha = $form->getValue('senha');

                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                // Inicia o adaptador Zend_Auth para banco de dados
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                $authAdapter->setTableName('usuario')
                    ->setIdentityColumn('login')
                    ->setCredentialColumn('senha')
                    ->setCredentialTreatment('SHA1(?)');
                // Define os dados para processar o login
                $authAdapter->setIdentity($login)->setCredential($senha);
                // Efetua o login
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                // Verifica se o login foi efetuado com sucesso
                if ($result->isValid()) {
                    // Armazena os dados do usuário em sessão, apenas
                    // desconsiderando
                    // a senha do usuário
                    $info = $authAdapter->getResultRowObject(null, 'senha');
                    $storage = $auth->getStorage();
                    $storage->write($info);
                    // Redireciona para o Controller protegido
                    return $this->_helper->redirector->goToRoute(
                            array(
                                    'controller' => 'lab',
                                    'action' => 'select'
                            ), null, true);
                } else {
                    // Dados inválidos
                    $this->_helper->FlashMessenger(
                            'Usuário ou senha inválidos!');
                    $this->_redirect('/auth/login');
                }
            } else {
                // Formulário preenchido de forma incorreta
                $form->populate($data);
            }
        }
    }

    public function logoutAction ()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector('index');
    }
}