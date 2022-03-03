<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const VALIDATION_ROLE = [
        'role_id'               => ['required','integer'],
        'name'                  => ['required','string'],
        'email'                 => ['required','email','unique:users,email'],
        'mobile_no'             => ['required','unique:users,mobile_no'],
        'avatar'                => ['nullable','image','mimes:png,jpg,jpeg'],
        'district_id'           => ['required','integer'],
        'upazila_id'            => ['required','integer'],
        'postal_code'           => ['required','numeric'],
        'address'               => ['required','string'],
        'password'              => ['required','string','confirmed','min:8'],
        'password_confirmation' => ['required','string','min:8']
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'mobile_no',
        'avatar',
        'district_id',
        'upazila_id',
        'postal_code',
        'address',
        'password',
        'status'
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function district(){
        return $this->belongsTo(Location::class,'district_id','id');
    }

    public function upazila(){
        return $this->belongsTo(Location::class,'upazila_id','id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    private $order = array('id'=>'desc');
    private $column_order;
    private $orderValue;
    private $dirValue;
    private $lengthValue;
    private $startValue;

    public function setOrderValue($orderValue){
        $this->orderValue = $orderValue;
    }
    public function setDirValue($dirValue){
        $this->dirValue = $dirValue;
    }
    public function setLengthValue($lengthValue){
        $this->lengthValue = $lengthValue;
    }
    public function setStartValue($startValue){
        $this->startValue = $startValue;
    }

    private function get_datatable_query(){
        $query = self::with('role','district','upazila');
        return $query;
    }

    public function getList(){
        $query = $this->get_datatable_query();
        if($this->lengthValue != -1){
            $query->offset($this->startValue)->limit($this->lengthValue);
        }
        return $query->get();
    }

    public function count_filtered(){
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }

    public function count_all(){
        return self::toBase()->get()->count(); 
    }

}
