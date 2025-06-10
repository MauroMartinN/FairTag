<?php
require_once '../model/userDAO.php';
require_once '../model/entidades/user.php';

class DashboardController
{


    public function index()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol_id'] != 1) {
            header("Location: index.php?c=Home&a=index");
            exit;
        }

        require_once '../view/header.php';
        require_once '../view/dashboard/index.php';
        require_once '../view/footer.php';
    }
}
