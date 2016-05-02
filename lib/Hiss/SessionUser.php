<?php

class SessionUser {
    
    private $logged;
    private $authuri;
    private $user;
    private $service;
    private $redirect_uri;
    
    static function getGoogleUser($client_id, $client_secret, $redirect_uri){
        session_start();
        require_once ('libraries/Google/autoload.php');
        $googleuser = new SessionUser();
        $this->redirect_uri = $redirect_uri;
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($this->redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");
        $this->service = new Google_Service_Oauth2($client);
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: ' . filter_var($this->redirect_uri, FILTER_SANITIZE_URL));
            exit;
        }
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        } else {
            $googleuser->authuri = $client->createAuthUrl();
            $googleuser->logged = false;
        }
        if($googleuser->logged == true){
            $googleuser->user = $this->service->userinfo->get();
        }
        return $googleuser;
    }
    
    public function isLogged(){ return $this->logged; }
    public function getAuthUri() { return $this->authuri; }
    public function getUser() { return $this->user; }
}