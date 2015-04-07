<?php
/**
 * Created by JetBrains PhpStorm.
 * User: moufasa
 * Date: 23/12/12
 * Time: 18:06
 * To change this template use File | Settings | File Templates.
 */

 class Application_Form_Code_Ajouter extends Zend_Form
 {
	public function init()
	{
        $this->addElement('textarea','code', array(
             'required' => true,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'	=> 'Envoyer',
            'class' => 'btn btn-primary'
        ));
    }
 }