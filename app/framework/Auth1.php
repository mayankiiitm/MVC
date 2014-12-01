<?php
class Auth {
    public static $db;
    public static function is_valid_request(){
    $header=apache_request_headers();
    $authorization=$_POST['authorization'];
    $public_key=$_POST['public_key'];
    $time=$_POST['time'];
    $this->db=DB::getInstance();
    $secret_key=mysql_result(mysql_query("SELECT private_key FROM auth WHERE public_key='$public_key'"),0);
    $hash=my_algo_to_generate_hash($public_key, $secret_key);//this is dummy.
    if($hash===$authorization){
        $token=sha1('some really random strings');
        mysql_query("INSERT INTO tokens (token) VALUES ('$token')");
        return $token;
    }
    return false;

}

function is_valid_user(){
    if($this->is_valid_request()){
        $user=$_POST['email'];
        $pass=$_POST['pass'];
        $token=$_POST['token'];
        if (mysql_num_rows(mysql_query("SELECT id FROM tokens WHERE token='$token' "))) {
            $query=mysql_query("SELECT user_id FROM users WHERE email='$email' AND password='$pass'");
            if (mysql_num_rows($query)) {
                $access_token=my_algo_to_generate_hash($email,$password);
                $refresh_token=my_algo_to_generate_hash();
                mysql_query("UPDATE users SET access_token='$access_token', refresh_token='$refresh_token' WHERE email='$email'");
                return array(
                    'access_token'=>$access_token,
                    'expire_time'=>$some_time,
                    'refresh_token'=>$refresh_token
                    //return false in all other case
                    );
            }
        }
    }
}

function is_logged_in(){
    $access_token=$_POST['access_token'];
    $time=$_SERVER['REQUEST_TIME'];
    $some_time='time to which access_token is valid';//how much it should be?
    $query=mysql_query("SELECT user_id FROM users WHERE access_token='$access_token' AND TIMESTAMPDIFF(seconds,'$time' ,access_token_created_at)<'$time'");
    if(mysql_num_rows(result)){
        return true;
    }
    return false;
}