<?php
class ProfileFB extends Eloquent {

	protected $table = 'profiles_fb';
	protected $primaryKey = 'profile_id';

	public static function getNewUser($date,$location){
		$res = DB::table('profiles_fb')
						->whereRaw('created_at LIKE "'.$date.'%"')
						->where('location_id', '=', $location)
						->orderBy('created_at', 'ASC')
						->get();
				
		return $res;
	}

}
