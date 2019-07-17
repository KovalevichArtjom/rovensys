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
        $arrStatusPurchase = array('0'=> 'В карзине','1'=>'Куплено');

        $listPurchases = MainModel::getAllPurchases();
        if(isset($_POST) and $_POST['dataType'] === 'json'){
            if($_POST['ac']) {
                if ($_POST['ac'] === 'addPurchase') {
                    $res = MainModel::addPurchase($_POST['namePurchase'],
                                                  $_POST['amountPurchase'],
                                                  $_POST['statusPurchase']
                    );
                }
                if ($_POST['ac'] === 'updPurchase') {
                    $res = MainModel::updPurchase($_POST['namePurchase'],
                                                  $_POST['amountPurchase'],
                                                  $_POST['statusPurchase'],
                                                  $_POST['idPurchase']
                    );
                }
                if ($_POST['ac'] === 'delPurchase') {
                    $res = MainModel::delPurchase($_POST['idPurchase']);
                }
            echo json_encode($res);
            exit;
            }
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/view/pages/MainTpl.php';
    }
}