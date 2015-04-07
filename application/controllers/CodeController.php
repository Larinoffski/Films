<?php
class CodeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

    }

    public function insertAction()
    {
        // action body
        $form = new Application_Form_Code_Ajouter();
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                //on insert en base la data.
                unset($formData["submit"]);
                $model_code = new Application_Model_Code();
                $model_code->insert($formData);
                //on redirige vers le show.
                $this->redirect($this->view->url(array(
                        'module' => 'default',
                        'controller' => 'code',
                        'action' => 'liste'),
                    'default', true));
            }
        }
        $this->view->form = $form;
    }

    public function updateAction()
    {
        // action body
        $model_code = new Application_Model_Code();
        $data = $model_code->find($this->getParam("id"))->toArray();
        $data = $data[0];
        $form = new Application_Form_Code_Ajouter();
        $form->populate($data);
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                //on insert en base la data.
                unset($formData["submit"]);
                $model_code = new Application_Model_Code();
                $where = $model_code->getAdapter()->quoteInto('id = ?', $this->getParam("id"));
                $model_code->update($formData,$where);
                //on redirige vers le show.
                $this->redirect($this->view->url(array(
                        'module' => 'default',
                        'controller' => 'code',
                        'action' => 'liste'),
                    'default', true));
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        // action body
        $id = $this->getParam('id');
        $model_code = new Application_Model_Code();
        $where = $model_code->getAdapter()->quoteInto('id = ?', $id);
        $model_code->delete($where);
        $this->redirect($this->view->url(array(
                'module' => 'default',
                'controller' => 'code',
                'action' => 'liste'),
            'default', true));
    }

    public function listeAction()
    {
        $model_code = new Application_Model_Code();
        $data = $model_code->fetchAll()->toArray();
        $this->view->codes = $data;
    }

    public function showAction()
    {
        $model_code = new Application_Model_Code();
        $this->view->code = $model_code->find($this->getParam("id"))->toArray();
    }
}











