<?php

class MainModel
{
    /**
     * Executing post request.
     * @param $key
     * @return bool|string
     */
    public static function getPostParam($key){
        if ($key === 'addPurchase') {
            return self::addPurchase(
                $_POST['namePurchase'],
                $_POST['amountPurchase'],
                $_POST['statusPurchase']
            );
        }
        elseif ($key === 'updPurchase') {
            return self::updPurchase(
                $_POST['namePurchase'],
                $_POST['amountPurchase'],
                $_POST['statusPurchase'],
                $_POST['idPurchase']
            );
        }
        elseif ($key === 'delPurchase') {
            return self::delPurchase($_POST['idPurchase']);
        }
    }

    /**
     * Getting all having purchases.
     * @return mixed|string
     * @author AKovalevich
     */
    public static function getAllPurchases(){
        $query = 'select t.id, t.name, t.amount, t.status
                  from purchases t';
        return DB::getData($query);
    }

    /**
     * Adding new purchase.
     * @param $namePurchase
     * @param $amountPurchase
     * @param $statusPurchase
     * @return string
     * @author AKovalevich
     */
    private static function addPurchase($namePurchase,$amountPurchase,$statusPurchase){
        $query = 'INSERT INTO purchases (name, amount, status)
                  VALUES (?,?,?)';
        $dataRequest = [
            'query'=>$query,
            'types'=>[
                'namePurchase'=>'s',
                'amountPurchase'=>'i',
                'statusPurchase'=>'i'
            ],
            'params'=>[
                'namePurchase'=>$namePurchase,
                'amountPurchase'=>$amountPurchase,
                'statusPurchase'=>$statusPurchase
            ]
        ];
        return DB::query($dataRequest);
    }

    /**
     * Update Purchase client by id.
     * @param $namePurchase
     * @param $amountPurchase
     * @param $statusPurchase
     * @param $idPurchase
     * @return bool|string
     * @author AKovalevich
     */
    private static function updPurchase($namePurchase,$amountPurchase,$statusPurchase,$idPurchase){
        $query = 'UPDATE purchases t
                  SET  t.name = ?, t.amount = ?, t.status = ? 
                  WHERE t.id = ?';
        $dataRequest = [
            'query'=>$query,
            'types'=>[
                'namePurchase'=>'s',
                'amountPurchase'=>'i',
                'statusPurchase'=>'i',
                'idPurchase'=>'i'
            ],
            'params'=>[
                'namePurchase'=>$namePurchase,
                'amountPurchase'=>$amountPurchase,
                'statusPurchase'=>$statusPurchase,
                'idPurchase'=>$idPurchase
            ]
        ];
        return DB::query($dataRequest);
    }

    /**
     * Delete only purchases client which were in shopping cart
     * @param $idPurchase
     * @return bool|string
     */
    private static function delPurchase($idPurchase){
        $query = 'DELETE 
                  FROM purchases 
                  WHERE purchases.id = ?';
        $dataRequest = [
            'query'=>$query,
            'types'=>[
                'idPurchase'=>'s'
            ],
            'params'=>[
                'idPurchase'=>$idPurchase
            ]
        ];
        return DB::query($dataRequest);
    }

}