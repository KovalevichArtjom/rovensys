<?php
require_once('dbconfig.php');

class DB
{
    private static $Instance = null;
    /**
     * Connection from Data Base.
     */
    private static function connection(){
        if(self::$Instance === null) {
            self::$Instance = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $error = self::$Instance->connect_errno;
            if (!empty($error)) {
                echo 'Error connecting to database. Error code:' . $error;
            }
        }
        return self::$Instance;
    }

    /**
     * @param $dataRequest - array, containing string with Query
     * and Arrays with Types and Params request.
     * @return bool|string
     */
    public static function query($dataRequest){
        $types = null;//types params
        $params = [];//val params
        if(is_array($dataRequest)) {
            if (isset($dataRequest['query']) && is_array($dataRequest['types']) && is_array($dataRequest['params'])) {
                $request = self::connection()->prepare($dataRequest['query']);
                if ($request) {
                    //prepare query variables
                    foreach ($dataRequest['types'] as $param => $type) {
                        $types .= $type;
                        $params[] = $dataRequest['params'][$param];
                    }
                    //Using unpacking operator
                    $request->bind_param($types,...$params);
                    $request->execute();

                    return true;
                } else {
                    //if have error request
                    return self::connection()->error;
                }
            }
        }
    }

    /**
     * @param $query
     * @return mixed|string
     */
    public static function getData($query){
        $answer = self::connection()->query($query);
        if($answer){
            //get result request.
            $res = $answer->fetch_all(MYSQLI_ASSOC);
            return $res;
        }else{
            //if have error request
            return self::connection()->error;
        }
    }

    private function __construct(){}
    private function __clone(){}


}