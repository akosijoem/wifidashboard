<?php
class ReturningUser extends Eloquent {

	protected $table = 'return_logs';
	protected $primaryKey = 'log_id';

	public static function getReturningUser($date,$location){
		$res = DB::table('return_logs')->join('profiles_fb', 'return_logs.mac', '=', 'profiles_fb.mac')
						->where('return_logs.location_id', '=', $location)
						->whereRaw('return_logs.created_at LIKE "'.$date.'%"')
						->orderBy('return_logs.created_at', 'ASC')
						->get();
				
		return $res;
	}

}
