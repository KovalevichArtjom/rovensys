<?php

class MainModel
{
    /**
     * Getting all having purchases.
     * @return mixed|string
     * @author AKovalevich
     */
    public static function getAllPurchases(){
        global $DB;
        $query = 'select t.id, t.name, t.amount, t.status
                  from purchases t';
        $answer = $DB::$ObjMySqli->query($query);
        if($answer){
            //get result request.
            $result = $answer->fetch_all(MYSQLI_ASSOC);
            return $result;
        }else{
            //if have error request
            return $DB::$ObjMySqli->error.'<br/>';
        }
    }

    /**
     * Adding new purchase.
     * @param $namePurchase
     * @param $amountPurchase
     * @param $statusPurchase
     * @return string
     * @author AKovalevich
     */
    public static function addPurchase($namePurchase,$amountPurchase,$statusPurchase){
        global $DB;
        $query = 'INSERT INTO purchases (name, amount, status)
                  VALUES (?,?,?)';
        $request = $DB::$ObjMySqli->prepare($query);
        if($request){
            //prepare query variables
            $request->bind_param('sii',$namePurchase,$amountPurchase,$statusPurchase);
            $request->execute();

            return true;
        }else{
            //if have error request
            return $DB::$ObjMySqli->error.'<br/>';
        }
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
    public static function updPurchase($namePurchase,$amountPurchase,$statusPurchase,$idPurchase){
        global $DB;
        $query = 'UPDATE purchases t
                  SET  t.name = ?, t.amount = ?, t.status = ? 
                  WHERE t.id = ?';
        $request = $DB::$ObjMySqli->prepare($query);
        if($request){
            //prepare query variables
            $request->bind_param('siii',$namePurchase,$amountPurchase,$statusPurchase,$idPurchase);
            $request->execute();

            return true;
        }else{
            //if have error request
            return $DB::$ObjMySqli->error.'<br/>';
        }
    }

    /**
     * Delete only purchases client which were in shopping cart
     * @param $idPurchase
     * @return bool|string
     */
    public static function delPurchase($idPurchase){
        global $DB;
        $query = 'DELETE 
                  FROM purchases 
                  WHERE purchases.id = ?';
        $request = $DB::$ObjMySqli->prepare($query);
        if($request){
            //prepare query variables
            $request->bind_param('s',$idPurchase);
            $request->execute();

            return true;
        }else{
            //if have error request
            return $DB::$ObjMySqli->error.'<br/>';
        }
    }

}