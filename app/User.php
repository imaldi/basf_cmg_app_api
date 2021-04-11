<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $table = 'm_employees';

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email'
    // ];

    // /**
    //  * The attributes excluded from the model's JSON form.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password',
    // ];

    protected $fillable = [
		'name',
		'emp_username',
		'email',
		'emp_nik',
		'emp_birth_date',
		'emp_phone_number',
		'emp_is_spv',
		'emp_employee_group_id',
		'emp_employee_department_id',
	];

	protected $hidden = [
		'password',
		'api_token'
	];

//     public function getEmailAttribute() {
//     return $this->attributes['emp_email'];
// }

// public function setEmailAttribute($value) {
//     $this->attributes['emp_email'] = $value;
// }

// public function getPasswordAttribute() {
//     return $this->attributes['emp_password'];
// }

// public function setPasswordAttribute($value) {
//     $this->attributes['emp_email'] = $value;
// }




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
