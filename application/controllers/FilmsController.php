<?php

/**
 * Created by PhpStorm.
 * User: laring
 * Date: 02.04.15
 * Time: 4:12
 */
class FilmsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // Создаём объект нашей модели
        $films = new Application_Model_Films();

        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запись
        $this->view->films = $films->fetchAll();
    }

    public function addAction()
    {
        // Создаём форму
        $form = new Application_Form_Films();

        // Указываем текст для submit
        $form->submit->setLabel('Добавить');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Извлекаем название фильма
                $name = $form->getValue('name');

                $year = $form->getValue('year');

                $country = $form->getValue('country');

                $genre = $form->getValue('genre');

                $director = $form->getValue('director');

                // Создаём объект модели
                $films = new Application_Model_Films();

                // Вызываем метод модели addFilm для вставки новой записи
                $films->addFilm($name, $year, $country, $genre, $director);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            }
            else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function updAction()
    {
        // Создаём форму
        $form = new Application_Form_Films();

        // Указываем текст для submit
        $form->submit->setLabel('Сохранить');
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Извлекаем id
                $id = (int)$form->getValue('id');

                // Извлекаем название фильма
                $name = $form->getValue('name');

                $year = $form->getValue('year');

                $country = $form->getValue('country');

                $genre = $form->getValue('genre');

                $director = $form->getValue('director');

                // Создаём объект модели
                $films = new Application_Model_Films();

                // Вызываем метод модели updateMovie для обновления новой записи
                $films->updFilm($id, $name, $year, $country, $genre, $director);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            }
            else {
                $form->populate($formData);
            }
        }
        else {
            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $films = new Application_Model_Films();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($films->getFilm($id));
            }
        }
    }

//    public function updAction()
//    {
//        // action body
//        $modelFilm = new Application_Model_Films();
//        $id = $this->getRequest()
//            ->getParam('id');
//        $modelFilm->updateFilm();
//        //$this->getRequest()->getParam('id') == $_POST['id']
////        $request = $this->getRequest(); // == Zend_Controller_Request_Abstract
////        $request->getParam('id');
//    }

    public function delAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $films = new Application_Model_Films();

                // Вызываем метод модели delFilm для удаления записи
                $films->delFilm($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('index');
        }
        else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $films = new Application_Model_Films();

            // Достаём запись и передаём в view
            $this->view->film = $films->getFilm($id);
        }
    }


//    public function delAction()
//    {
//        $id = $this->getRequest()
//            ->getParam('id');
//        $modelDel = new Application_Model_Films();
//        $modelDel->deleteFilm($id);
//    }


}
