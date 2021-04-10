<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use DB;

use Tymon\JWTAuth\Contracts\JWTSubject;

class MasterEmployee extends Model implements AuthenticatableContract, AuthorizableContract
{

    use Authenticatable, Authorizable;

	protected $table = 'm_employees';
	
	protected $fillable = [
		'emp_name',
		'emp_username',
		'emp_email',
		'emp_nik',
		'emp_birth_date',
		'emp_phone_number',
		'emp_is_spv',
		'emp_employee_group_id',
		'emp_employee_department_id',
	];

	protected $hidden = [
		'emp_password',
		'api_token'
	];

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
	
	public function department(){
		return $this->hasOne(MasterDepartment::class);
	}

	public function group(){
		return $this->hasOne(EmployeeGroup::class);
	}
}

