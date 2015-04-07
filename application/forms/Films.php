<?php

class Application_Form_Films extends Zend_Form
{
    // Метод init() вызовется по умолчанию
    public function init()
    {
        // Задаём имя форме
        $this->setName('film');

        // Создаём элемент hidden c именем = id
        $id = new Zend_Form_Element_Hidden('id');

        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');

        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // Создаём элемент формы – text c именем = name
        $name = new Zend_Form_Element_Text('name');
        /*
        * Далее пишем содержание label, который будет отображаться для данного поля,
        * указываем, является элемент обязательным или нет,
        * пишем список фильтров, которые будут применяться к данному элементу,
        * и наконец, указываем валидатор и сообщение об ошибке, которое будет выведено пользователю
        */
        $name->setLabel('Название')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $year = new Zend_Form_Element_Text('year');
        $year->setLabel('Год')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $country = new Zend_Form_Element_Text('country');
        $country->setLabel('Страна')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $genre = new Zend_Form_Element_Text('genre');
        $genre->setLabel('Жанр')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $director = new Zend_Form_Element_Text('director');
        $director->setLabel('Режиссёр')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );



        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');

        // Создаём атрибут id = submitbutton
        $submit->setAttrib('id', 'submitbutton');

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($id, $name, $year, $country, $genre, $director, $submit));
    }
}
