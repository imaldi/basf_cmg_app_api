<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Models\MasterDepartment;
use App\Models\MEmployeeGroup;
use App\Models\FormLoadingPackedGoods;
use App\Models\FormLoadingTexN701S;
use Spatie\Permission\Traits\HasRoles;


use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasRoles;

    protected $table = 'm_employees';

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email'
    // ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    protected $fillable = [
		'emp_name',
		'emp_username',
		'emp_email',
		'emp_nik',
		'emp_birth_date',
		'emp_phone_number',
		'emp_is_spv',
		'emp_employee_department_id',
		'password'
	];


	protected $hidden = [
		'password',
		'api_token'
	];

    // public function department(){
	// 	return $this->/**
    //      * Get the user that owns the User
    //      *
    //      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //      */
    //     public function user(): BelongsTo
    //     {
    //         return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    //     }
	// }

    /**
     * Get the department that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(MasterDepartment::class, 'emp_employee_department_id');
    }

    public function locationAs5sPic(){
        // ->role('Form 5s - PIC')->get()->where('id',$this->id)->first()
		return $this->belongsToMany('App\Models\MasterLocation', 'form_5s_masters', 'form_5s_m_pic_id', 'form_5s_m_area_id');
	}

	// public function group(){
	// 	return $this->belongsTo(MEmployeeGroup::class, 'emp_employee_group_id');
	// }

    //to check whether user has given permission via their role
    public function hasPermission(String $permission){
        return $this->getPermissionsViaRoles()->where('name',$permission)->first() != null;
    }

    public function formLoadingPackedGoods(){
        return $this->hasMany(FormLoadingPackedGoods::class,'ul2_employee_id');
    }

    public function formLoadingTexN701S(){
        return $this->hasMany(FormLoadingTexN701S::class,'ul1_employee_id');
    }

    public function formLoadingPackedGoods(){
        return $this->hasMany(FormLoadingPackedGoods::class,'ul2_employee_id');
    }

    public function formLoadingTexN701S(){
        return $this->hasMany(FormLoadingTexN701S::class,'ul1_employee_id');
    }

    //Ternyata ini penyebab tidak bisa login dari tadi


	// public function getAuthPassword()
	// {
	// 	return $this->emp_password;
	// }

    // public function getAuthEmail()
    // {
    //     return $this->emp_email;
    // }

    // public function username()
    // {
    //     return 'username';
    // }
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
