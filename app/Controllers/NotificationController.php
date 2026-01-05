<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

Class NotificationController{

    private string $viewPath = 'app/Views/NotificationView.php';

    public function getNotification(){
        if(isset($_SESSION["notification"])){
            $notification = $_SESSION["notification"];
            unset($_SESSION["notification"]);
            $this->showNotification($notification['message'], $notification['color']);
        }
    }

    public function showNotification($notificationMessage, $notificationColor){
        require_once $this->viewPath;
    }
}