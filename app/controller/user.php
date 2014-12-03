<?php
class User
{
	function __construct() {
		//$this->is_loggedin();
	}

	public function index(){
		$user=new Users;
		$zip=$user->select("SELECT zip, primary_city,
       latitude, longitude, distance
  FROM (
        SELECT z.zip,
        z.primary_city,
        z.latitude, z.longitude,
        p.radius,
        p.distance_unit
                 * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                 * COS(RADIANS(z.latitude))
                 * COS(RADIANS(p.longpoint - z.longitude))
                 + SIN(RADIANS(p.latpoint))
                 * SIN(RADIANS(z.latitude)))) AS distance
  FROM zip AS z
  JOIN ( 
        SELECT  42.81  AS latpoint,  -70.81 AS longpoint,
                5000000000000000000000000000000000000.0 AS radius, 111.045 AS distance_unit
    ) AS p ON 1=1
  WHERE z.latitude
     BETWEEN p.latpoint  - (p.radius / p.distance_unit)
         AND p.latpoint  + (p.radius / p.distance_unit)
    AND z.longitude
     BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
         AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
 ) AS d

 ORDER BY distance");
		Json::response($zip);
	}

	private function is_loggedin(){
		$access_token=Input::get('access_token')?Input::get('access_token'):(Input::post('access_token')?Input::post('access_token'):null);
		$user=new Users;
		if(!$user->access_token($access_token)){
			$data=array('data'=>array('success'=>'0'),'message'=>'Please login first');
			Json::response($data,401);
			exit;
		}
	}
}
?>