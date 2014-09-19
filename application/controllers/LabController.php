<?php

class LabController extends Zend_Controller_Action
{

    public function init ()
    {
        if (! Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector->goToRoute(
                    array(
                            'controller' => 'auth'
                    ), null, true);
        }

        $usuario = Zend_Auth::getInstance()->getIdentity();
        $this->view->usuario = $usuario;

        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messagesFormulario = $this->_flashMessenger->getMessages();
    }

    public function indexAction ()
    {
        return $this->_helper->redirector('select', 'lab');
    }

    public function insertAction ()
    {
        $formulario = new Application_Form_FormLab();
        $this->view->formulario = $formulario;

        // Verifica se existem dados de POST
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            // Formulário corretamente preenchido?
            if ($formulario->isValid($data)) {

                $objeto_model = new Application_Model_Db();

                if ($objeto_model->insereDados($data)) {
                    $mensagens = 'Dados inseridos com sucesso!';
                    $this->view->mensagens = $mensagens;
                } else {
                    $this->view->mensagens = 'Não foi possível enviar para o banco de dados!';
                    // Reenvia os dado para o formulário.
                    $formulario->populate($data);
                    $this->view->formulario = $formulario;
                    ;
                }
            } else {
                // Formulário preenchido de forma incorreta
                $formulario->populate($data);
            }
        }
    }

    public function selectAction ()
    {
        $idpdf = $this->getRequest()->getParam('idpdf');

        $objeto_model = new Application_Model_Db();
        if ($this->getRequest()->isPost()) {
            $lab = $this->getRequest()->getPost('infoLab');
            // $this->view->lab = $lab;
        }

        else {
            $lab = $this->getRequest()->getParam('infoLab');
        }
        try {

            if ($lab) {

                $valor = $objeto_model->selectDados($lab);
            } else {
                $valor = $objeto_model->selectAllDados();
            }
            $this->view->assign('valor', $valor);
        } catch (Zend_Exception $e) {

            echo $e;
        }
    }

    public function updateAction ()
    {
        $objeto_model = new Application_Model_Db();

        $idLab = $this->getRequest()->getPost('idLab');
        $local = $this->getRequest()->getPost('local');
        $data = $this->getRequest()->getPost('data');
        $turnoVisita = $this->getRequest()->getPost('turnoVisita');
        $nomeLaboratorio = $this->getRequest()->getPost('nomeLaboratorio');
        $somenteAula = $this->getRequest()->getPost('somenteAula');
        $frequenciaAula = $this->getRequest()->getPost('frequenciaAula');
        $turnoAula = $this->getRequest()->getPost('turnoAula');
        $quantGabinete = $this->getRequest()->getPost('quantGabinete');
        $quantTipoGabiente = $this->getRequest()->getPost('quantTipoGabiente');
        $sisOperacional = $this->getRequest()->getPost('sisOperacional');
        $licencaDti = $this->getRequest()->getPost('licencaDti');
        $ocsInstalado = $this->getRequest()->getPost('ocsInstalado');
        $ipsServidores = $this->getRequest()->getPost('ipsServidores');
        $estruturaLRede = $this->getRequest()->getPost('estruturaLRede');
        $roteador = $this->getRequest()->getPost('roteador');
        $ipEntrada = $this->getRequest()->getPost('ipEntrada');
        $ipSaida = $this->getRequest()->getPost('ipSaida');
        $nomeResponsavel = $this->getRequest()->getPost('nomeResponsavel');
        $ramal = $this->getRequest()->getPost('ramal');
        $email = $this->getRequest()->getPost('email');
        $acessoRemoto = $this->getRequest()->getPost('acessoRemoto');
        $backup = $this->getRequest()->getPost('backup');
        $firewall = $this->getRequest()->getPost('firewall');
        $observacoes = $this->getRequest()->getPost('observacoes');

        if ($idLab) {
            try {

                if ($objeto_model->updateDados($idLab, $local, $data,
                        $turnoVisita, $nomeLaboratorio, $somenteAula,
                        $frequenciaAula, $turnoAula, $quantGabinete,
                        $quantTipoGabiente, $sisOperacional, $licencaDti,
                        $ocsInstalado, $ipsServidores, $estruturaLRede,
                        $roteador, $ipEntrada, $ipSaida, $nomeResponsavel,
                        $ramal, $email, $acessoRemoto, $backup, $firewall,
                        $observacoes)) {

                    $mensagens = $local;
                    $this->view->mensagens = $mensagens;
                    return $this->_helper->redirector('select', 'lab');
                } else {
                    $this->view->mensagens = 'Não foi possível atualizar o bando de dados!';
                }
            } catch (Zend_Exception $e) {

                echo $e;
            }
        } else {

            $this->view->mensagens = 'Sem post';
        }
    }

    public function editAction ()
    {
        $objeto_model = new Application_Model_Db();

        $lab = $this->getRequest()->getPost('idLab');

        $valor = $objeto_model->selectDados($lab);

        $this->view->assign('valor', $valor);
    }

    public function deleteAction ()
    {
        $this->render('index');
        $idLab = $this->getRequest()->getPost('idLab');
        $objeto_model = new Application_Model_Db();
        $objeto_model->deleteDados($idLab);
        return $this->_helper->redirector('select', 'lab');
    }

    public function createpdfAction ()
    {
        $this->render('index');
        $idpdf = $this->getRequest()->getParam('idpdf');

        $objeto_model = new Application_Model_Db();
        if ($this->getRequest()->isPost()) {
            $lab = $this->getRequest()->getPost('infoLab');
            // $this->view->lab = $lab;
        }

        else {
            $lab = $this->getRequest()->getParam('infoLab');
        }
        try {

            if ($lab) {

                $valor = $objeto_model->selectDados($lab);
            } else {
                $valor = $objeto_model->selectAllDados();
            }
            $this->view->assign('valor', $valor);
        } catch (Zend_Exception $e) {

            echo $e;
        }
        if ($idpdf == 1) {

            $client = new Zend_Http_Client();

            // set some parameters
            $client->setParameterGet('infoLab', 'bi');

            $pdf = new Zend_Pdf();

            $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);

            // 595:842 A4

            $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER);

            $pdfPage->setFont($font, 12);

            $pdfPage->drawText('Local', 20, 570, 'UTF-8');

            $pdfPage->drawText('Nome laboratório', 75, 570, 'UTF-8');

            $pdfPage->drawText('Data', 205, 570, 'UTF-8');

            $pdfPage->drawText('Turno visita', 265, 570, 'UTF-8');

            $pdfPage->drawText('Somente aula?', 365, 570, 'UTF-8');

            $pdfPage->drawText('Frequencia aula', 475, 570, 'UTF-8');

            $pdfPage->drawText('Turno Aula', 595, 570, 'UTF-8');

            $pdfPage->drawText('Quantidade gabinete', 695, 570, 'UTF-8');

            $stringpos = 550; // posicao x do meu texto
            $stringdif = 12; // diferença entre cada quebra de linha.

            $pdfPage->setFont($font, 9);

            foreach ($valor as $value) {
                $pdfPage->drawText($stringpos, 20, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->nomeLaboratorio, 75, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->data, 205, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->turnoVisita, 265, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->somenteAula, 365, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->frequenciaAula, 475, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->turnoAula, 595, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->quantGabinete, 695, $stringpos,
                        'UTF-8');
                $stringpos = ($stringpos - $stringdif); // subtrai para que a
                                                            // linha fique embaixo
            }

            if ($stringpos < 285) {
                array_push($pdf->pages, $pdfPage);
               $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
               $stringpos=580;
            }

            $stringpos -= 4;

            $pdfPage->setFont($font, 12);
            $pdfPage->drawText('Quantidade tipo gabinete', 20, $stringpos,
                    'UTF-8');
            $pdfPage->drawText('Sistema operacional', 205, $stringpos, 'UTF-8');
            $pdfPage->drawText('Licença DTI?', 365, $stringpos, 'UTF-8');
            $pdfPage->drawText('OCS instalado?', 475, $stringpos, 'UTF-8');
            $pdfPage->drawText('Ips servidores', 595, $stringpos, 'UTF-8');
            $pdfPage->drawText('Estrutura L.rede', 710, $stringpos, 'UTF-8');

            $stringpos -= 12;
            $pdfPage->setFont($font, 9);
            foreach ($valor as $value) {
                $pdfPage->drawText($stringpos, 20, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->sisOperacional, 205, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->licencaDti, 365, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->ocsInstalado, 475, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->ipsServidores, 595, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->estruturaLRede, 710, $stringpos,
                        'UTF-8');

                $stringpos = ($stringpos - $stringdif); // subtrai para que a
                                                            // linha fique embaixo
            }

            if ($stringpos < 198) {
                array_push($pdf->pages, $pdfPage);
                $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
                $stringpos=580;
            }

            $stringpos -= 4;

            $pdfPage->setFont($font, 12);
            $pdfPage->drawText('Roteador', 20, $stringpos, 'UTF-8');
            $pdfPage->drawText('Ip entrada', 205, $stringpos, 'UTF-8');
            $pdfPage->drawText('Ip saída', 365, $stringpos, 'UTF-8');
            $pdfPage->drawText('Nome responsável', 475, $stringpos, 'UTF-8');
            $pdfPage->drawText('Ramal', 595, $stringpos, 'UTF-8');
            $pdfPage->drawText('E-mail', 715, $stringpos, 'UTF-8');

            $stringpos -= 12;
            $pdfPage->setFont($font, 9);
            foreach ($valor as $value) {
                $pdfPage->drawText($stringpos, 20, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->ipEntrada, 205, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->ipSaida, 365, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->nomeResponsavel, 475, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->ramal, 595, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->email, 715, $stringpos, 'UTF-8');

                $stringpos = ($stringpos - $stringdif); // subtrai para que a
                                                        // linha fique embaixo
                if ($stringpos < 14) {}
            }
            if ($stringpos <= 170) {

                array_push($pdf->pages, $pdfPage);
                $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
                $stringpos=580;
            }

            $stringpos -= 4;

            $pdfPage->setFont($font, 12);
            $pdfPage->drawText('Acesso remoto', 20, $stringpos, 'UTF-8');
            $pdfPage->drawText('Backup', 205, $stringpos, 'UTF-8');
            $pdfPage->drawText('Firewall', 375, $stringpos, 'UTF-8');
            $pdfPage->drawText('Observações', 475, $stringpos, 'UTF-8');

            $stringpos -= 12;
            $pdfPage->setFont($font, 9);
            foreach ($valor as $value) {
                $pdfPage->drawText($value->acessoRemoto, 20, $stringpos,
                        'UTF-8');
                $pdfPage->drawText($value->backup, 205, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->firewall, 375, $stringpos, 'UTF-8');
                $pdfPage->drawText($value->observacoes, 475, $stringpos,
                        'UTF-8');

                $stringpos = ($stringpos - $stringdif); // subtrai para que a
                                                            // linha fique embaixo
            }

            if ($stringpos < 14) {
                array_push($pdf->pages, $pdfPage);
                $pdfPage = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
            }

            // if $stringpos = 250 muda a pagina
            //
            // adicionamos nossa página como a 1ª página de nosso documento
            // $pagina=$stringpos/250;
            array_push($pdf->pages, $pdfPage);
            // $pdf->pages[1] = $pdfPage;
            $pdf->save('lab.pdf');
            header('Content-type: application/pdf');
            echo $pdf->render();
        } else {
            return $this->_helper->redirector('select', 'lab');
        }
    }
}
