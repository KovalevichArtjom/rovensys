<?php
include $_SERVER['DOCUMENT_ROOT'] . '/model/MainModel.php';

class MainController
{
    /**
     * Render content for page.
     * @author AKovalevich
     */
    public static function getPageIndex(){

        $message = null;
        //Array of purchases statuses
        $arrStatusPurchase = array(
             0 =>'В карзине',
             1 =>'Куплено'
        );

        $listPurchases = MainModel::getAllPurchases();
        //For json requests
        if(isset($_POST) && $_POST['dataType'] === 'json'){
            $res = MainModel::getPostParam($_POST['ac']);

            echo json_encode($res);
            exit;
        }

        include $_SERVER['DOCUMENT_ROOT'].'/view/main/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/view/pages/MainTpl.php';
        include $_SERVER['DOCUMENT_ROOT'].'/view/main/footer.php';
    }
}