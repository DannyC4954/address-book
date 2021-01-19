<?php

class Add extends Controller {
    
    public function __construct(){
        $this->addressModel = $this->model('Address');
    }

    public function index() {

        $validate = $add = $this->addressModel->validation();
        $add = $this->addressModel->addRecord();
        $delete = $this->addressModel->deleteRecord();
        $view =  $this->addressModel->viewRecord();

        $data = [
            'title' => 'Address Book - Add a record',
            'validate' => $validate,
            'add' => $add,
            'delete' => $delete,
            'view' => $view
        ];

        $this->view('add/add', $data );
    }

}
