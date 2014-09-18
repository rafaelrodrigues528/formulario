<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
       $this->setName('login');

		$login = new Zend_Form_Element_Text('login');
		$login->setLabel('Usuário:')
                        ->setAttrib('class', 'input-block-level')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty')
                            ;

		$senha = new Zend_Form_Element_Password('senha');
		$senha->setLabel('Senha:')
                        ->setAttrib('class', 'input-block-level')
			  ->setRequired(true)
			  ->addFilter('StripTags')
			  ->addFilter('StringTrim')
			  ->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Logar')
			   ->setAttrib('id', 'submitbutton')
                        ->setAttrib('class', 'btn btn-large btn-primary');

		$this->addElements(array($login, $senha, $submit));
    }


}

