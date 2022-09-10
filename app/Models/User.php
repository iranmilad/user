<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

 class User extends Authenticatable implements JWTSubject
{
	//use SoftDeletes;
	protected $fillable=["id","first_name","last_name","mobile","email","email_verified_at","password","active"];

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}

	public function subscribe()
	{
		return $this->hasOne(UserSubscribe::class)->whereDate('expire_at','>=',now());
	}

	public function questions()
	{
		return $this->hasMany(UserQuestion::class);
	}

	public function memberLists()
	{
		return $this->hasMany(UserMemberList::class);
	}

	public function tokens()
	{
		return $this->hasMany(UserToken::class);
	}

	public function getHasSubscribeAttribute(){
		return $this->subscribe()->count() > 0;
	}

	public function getFullNameAttribute(){
		return $this->first_name . ' '. $this->last_name;
	}

	  // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
