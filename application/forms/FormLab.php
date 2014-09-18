<?php

class Application_Form_FormLab extends Zend_Form {

    public function init() {
        $this->setName('formulario');
        $this->setMethod('POST');

        $local = new Zend_Form_Element_Text('local');
        $local->setLabel('Local:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
        ;


        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $turnoVisita = new Zend_Form_Element_Select('turnoVisita');
        $turnoVisita->setLabel('Turno da visita:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Manhã' => 'Manhã', 'Tarde' => 'Tarde'))
                ->addValidator('NotEmpty');


        $nomeLaboratorio = new Zend_Form_Element_Text('nomeLaboratorio');
        $nomeLaboratorio->setLabel('Nome do Laboratório:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');



        $somenteAula = new Zend_Form_Element_Select('somenteAula');
        $somenteAula->setLabel('Somente aula?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');

        $frequenciaAula = new Zend_Form_Element_Text('frequenciaAula');
        $frequenciaAula->setLabel('Frequência aula/semana:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $turnoAula = new Zend_Form_Element_Select('turnoAula');
        $turnoAula->setLabel('Turno da aula:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Manhã' => 'Manhã', 'Tarde' => 'Tarde', 'Noite' => 'Noite'))
                ->addValidator('NotEmpty');


        $quantGabinete = new Zend_Form_Element_Text('quantGabinete');
        $quantGabinete->setLabel('Quantidade de gabinete:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $quantTipoGabinete = new Zend_Form_Element_Text('quantTipoGabinete');
        $quantTipoGabinete->setLabel('Quantidade tipos de gabinete:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $sOperacional = new Zend_Form_Element_Select('sisOperacional');
        $sOperacional->setLabel('Sistema operacional:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Windows' => 'Windows', 'Linux' => 'Linux', 'Outros' => 'Outros'))
                ->addValidator('NotEmpty');


        $licencaDTI = new Zend_Form_Element_Select('licencaDti');
        $licencaDTI->setLabel('Tem licença gerenciada pela DTI?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');

        $ocsInstalado = new Zend_Form_Element_Select('ocsInstalado');
        $ocsInstalado->setLabel('OCS instalado?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');


        $ipServidores = new Zend_Form_Element_Text('ipsServidores');
        $ipServidores->setLabel('IP(s) da(s) máquina(s) servidor():')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $estruturaLRede = new Zend_Form_Element_Text('estruturaLRede');
        $estruturaLRede->setLabel('Estrutura lógica da rede:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $roteador = new Zend_Form_Element_Text('roteador');
        $roteador->setLabel('Roteador:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $ipEntrada = new Zend_Form_Element_Text('ipEntrada');
        $ipEntrada->setLabel('IP entrada:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $ipSaida = new Zend_Form_Element_Text('ipSaida');
        $ipSaida->setLabel('IP saída:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $nomeResponsavel = new Zend_Form_Element_Text('nomeResponsavel');
        $nomeResponsavel->setLabel('Nome do responsável do local:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $ramalContato = new Zend_Form_Element_Text('ramal');
        $ramalContato->setLabel('Ramal para contato:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $emailContato = new Zend_Form_Element_Text('email');
        $emailContato->setLabel('E-mail:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $admRemota = new Zend_Form_Element_Select('acessoRemoto');
        $admRemota->setLabel('Possibilidade de administração remota?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');

        $backup = new Zend_Form_Element_Select('backup');
        $backup->setLabel('Tem backup?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');


        $firewall = new Zend_Form_Element_Select('firewall');
        $firewall->setLabel('Firewall?')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->setMultiOptions(array('Sim' => 'Sim', 'Não' => 'Não'))
                ->addValidator('NotEmpty');



        $observacao = new Zend_Form_Element_Textarea('observacoes');
        $observacao->setLabel('Observações:')
                ->setAttrib('class', 'input-block-level')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');





        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
                ->setAttrib('id', 'submitbutton')
                ->setAttrib('class', 'btn btn-large btn-primary');

        $this->addElements(array($local, $data, $turnoVisita, $nomeLaboratorio, $somenteAula, $frequenciaAula
            , $turnoAula, $quantGabinete, $quantTipoGabinete, $sOperacional, $licencaDTI, $ocsInstalado,
            $ipServidores, $estruturaLRede, $roteador, $ipEntrada, $ipSaida, $nomeResponsavel, $ramalContato,
            $emailContato, $admRemota, $backup, $firewall, $observacao, $submit));
    }

}
