<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 22:37
 */

class Form_Auth extends Zend_Form {

    public function init() {

        parent::init();

        $this->setMethod('post');
        $this->addAttribs(array('class' => 'form-auth jsFormAuth'));

        $login = new Zend_Form_Element_Text('login', array(
            'class' => 'login',
            'placeholder' => 'Логин',
        ));

        $login->clearDecorators()
            ->addDecorator('ViewHelper');
        $this->addElement($login);

        $pass = new Zend_Form_Element_Password('password', array(
            'class' => 'password',
            'placeholder' => 'Пароль',
        ));

        $pass->clearDecorators()
            ->addDecorator('ViewHelper');
        $this->addElement($pass);

        $send = new Zend_Form_Element_Submit('send', array(
            'class' => 'jsSendForm',
        ));

        $send->clearDecorators()
            ->addDecorator('ViewHelper');
        $this->addElement($send);
    }
}