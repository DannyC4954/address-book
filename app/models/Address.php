<?php

    class Address {

        // Load still being used to show address book on index page
        public function loadRecords(){
            // Add data to JSON file
            $fileData = file_get_contents( '../app/results.json' );

            // decode json
            $jsonArray = json_decode($fileData, true);

            return $jsonArray;
        }

        // Search still being used to search records on index page
        public function searchRecords(){
            if( isset( $_POST["search-address"] ) ){
                // Get data from JSON file
                $fileData = file_get_contents( '../app/results.json' );

                // decode json
                $jsonArray = json_decode($fileData, true);
                $search = $_POST["search-input"];
                
                return [$jsonArray, $search];
            }

        }

        // Original functions for PHP CRUD
        public function validation(){
            if( isset( $_POST["add-record"] ) ){
                
                if( empty( $_POST['first_name'] ) ){
                    $firstNameError = "Please enter a first name";
                    $errors["first_name"] = $firstNameError;
                }

                if( empty( $_POST['last_name'] ) ){
                    $lastNameError = "Please enter a last name";
                    $errors["last_name"] = $lastNameError;
                }

                if( empty( $_POST['phone'] ) ){
                    $phoneError = "Please enter a phone number";
                    $errors["phone"] = $phoneError;
                }

                if( empty( $_POST['email'] ) ){
                    $emailError = "Please enter an email address";
                    $errors["email"] = $emailError;
                }

                if( !empty($errors) ) {
                    return $errors;
                }
            }
        }

        public function addRecord(){
            if( isset( $_POST["add-record"] ) ){
                
                if( $this->validation() ) {
                    return $this->validation();
                  }

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
                header("location: ./");
            }

            if( isset( $_POST["update-record"] ) ){
                
                if( $this->validation() ) {
                    return $this->validation();
                  }

                $fileData = file_get_contents( '../app/results.json' );

                // decode json
                $jsonArray = json_decode($fileData, true);

                foreach ($jsonArray as $key => $value) {

                    if ( $value['email'] == $_GET["email"] ) {

                        unset( $jsonArray[$key] );
                        
                        $value["first_name"] = $_POST["first_name"];
                        $value["last_name"] = $_POST["last_name"];
                        $value["phone"] = $_POST["phone"];
                        $value["email"] = $_POST["email"];

                        $jsonArray[] = $value;
                        
                    }
    
                }

                file_put_contents('../app/results.json', json_encode($jsonArray));
                header("location: ./");             

            }
        }

        // View still being used to edit records
        public function viewRecord(){
            if( isset( $_GET["email"] ) ) {
                // Get data from JSON file
                $fileData = file_get_contents( '../app/results.json' );

                // decode json
                $jsonArray = json_decode($fileData, true);
                foreach( $jsonArray as $j ){
                    if( $j["email"] == $_GET["email"] ){;
                        return $j;
                    }
                }
                
            }
        }

        public function deleteRecord(){
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
                header("location: ./index");
            }
        }

    }
