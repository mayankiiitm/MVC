<?php
class Auth 
{
    private static $table=AUTH_TABLE;
    private static $db;
    public static function authorized(){
        $header['authorization']='2e336bb90a8daa1da7e9aca1d5acbcba3b14cdfe08cca85371a4b271c984080e';
        $public_key=Input::get('public_key');
        $time=Input::get('time');
        if($private_key=self::get_private_key($public_key)){
            $data=$public_key.$time.$private_key;
            $hash=self::hash($data,$private_key);
            return $hash===$header['authorization']?true:false;    
        }
        return false;    
    }
    private static function get_private_key($public_key){
        self::$db=DB::getInstance();
        $table=self::$table;
        $sth=self::$db->prepare("SELECT private_key FROM $table WHERE public_key=?");
        $sth->execute(array($public_key));
        if($sth->rowCount()){
            $result=$sth->fetch(PDO::FETCH_OBJ);
            return $result->private_key;
        }
        return false;
    }
    private static function hash($data,$key){
        return hash_hmac('sha256', $data, $key);
    }
}
?>