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
}
