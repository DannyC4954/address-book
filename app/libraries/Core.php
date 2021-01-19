<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
*/
class Core {
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){

        $url = $this->getUrl();
        $con = $this->getCon();

        // Look in controllers for controller
        if( !empty( $url[0] ) ){

            if( file_exists('../app/controllers/' . ucwords($url[0]) . '.php') ){
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 Index
                unset($url[0]);
            }

        }

        // Require the controller
        require_once '../app/controllers/'. $this->currentController .'.php';

        // Instanciate controller class
        $this->currentController = new $this->currentController;

        if( !$con || !$url ){
          // Check for second part
          if( isset( $url[1] ) ){
              // Check to see if method exists in controller
              if( method_exists( $this->currentController, $url[1] ) ){
                  $this->currentMethod = $url[1];
                  unset($url[1]);
              }
          }

          // Get params
          $this->params = $url ? array_values( $url ) : [];

          // Call a callback with array of params
          call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } else if ( $con[0] === "news" && $url[1] !== "index" ) {

          $this->newsModel = $this->model('Article');
          $article = $this->newsModel->getArticle();

          $data = [
              'title' => $url[1],
              'article' => $article
          ];

          $this->articleView('news/'.$url[1].'', $data );
        } else {
          // Check for second part
          if( isset( $url[1] ) ){
              // Check to see if method exists in controller
              if( method_exists( $this->currentController, $url[1] ) ){
                  $this->currentMethod = $url[1];
                  unset($url[1]);
              }
          }

          // Get params
          $this->params = $url ? array_values( $url ) : [];

          // Call a callback with array of params
          call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

    }

    public function getUrl() {
        if( isset( $_GET['url'] ) ){
            $url = rtrim( $_GET['url'], '/' );
            $url = filter_var( $url, FILTER_SANITIZE_URL );
            $url = explode( '/', $url );
            return $url;
        }
    }

    public function getCon() {
      if( isset( $_GET['url'] ) ){
          $url = trim( $_GET['url'], '/' );
          $url = filter_var( $url, FILTER_SANITIZE_URL );
          $url = explode( '/', $url );
          return $url;
      }
    }

    // News view
    public function articleView( $view, $data = [] ) {

        // Check for view file
        if( file_exists( '../app/views/' . $view . '.php' ) ) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            // die( 'View does not exist' );
            require_once '../app/views/404page.php';
        }
    }

    // Load model
    public function model( $model ) {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate the model
        return new $model();
    }

}
