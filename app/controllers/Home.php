<?php

class Home extends Controller {
    
    public function __construct(){
        $this->addressModel = $this->model('Address');
    }

    public function index() {

        $search = $this->addressModel->searchRecords();
        $load = $this->addressModel->loadRecords();
        $add = $this->addressModel->addRecord();
        $delete = $this->addressModel->deleteRecord();

        $data = [
            'title' => 'Address Book - Home',
            'search' => $search,
            'load' => $load,
            'add' => $add,
            'delete' => $delete,
        ];

        $this->view('home/index', $data );
    }

}
