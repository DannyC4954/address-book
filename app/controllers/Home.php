<?php

class Home extends Controller {
    
    public function __construct(){
        $this->addressModel = $this->model('Address');
    }

    public function index() {

        $search = $this->addressModel->searchRecords();
        $load = $this->addressModel->loadRecords();

        $data = [
            'title' => 'Address Book - Home',
            'search' => $search,
            'load' => $load,
        ];

        $this->view('home/index', $data );
    }

    public function ajaxadd() {

        if( isset( $_POST["ajax-add"] ) ){
            // Add data to JSON file
            $fileData = file_get_contents( '../app/results.json' );

            // decode json
            $jsonArray = json_decode($fileData, true);
            
            if( !empty( $jsonArray ) ){
                foreach( $jsonArray as $j ){
                    if( $j["email"] == $_POST["email"] ){
                        return "Email already in use, please enter another";
                    }
                }
            }

            // add data
            $jsonArray[] = array(
                'first_name'=> $_POST["first_name"], 
                'last_name'=> $_POST["last_name"], 
                'phone'=> $_POST["phone"], 
                'email'=>$_POST["email"] 
            );

            // encode json and save to file
            file_put_contents('../app/results.json', json_encode($jsonArray));
        }

    }

    public function ajaxdelete() {
        if( isset( $_POST["delete-record"] ) ){
            // Get data from JSON file
            $fileData = file_get_contents( '../app/results.json' );

            // decode json
            $jsonArray = json_decode($fileData, true);
            foreach ($jsonArray as $key => $value) {

                if ( $value['email'] == $_POST["delete-ID"] ) {

                    unset( $jsonArray[$key] );
                    
                }

            }

            file_put_contents('../app/results.json', json_encode($jsonArray));
        }
    }

}
