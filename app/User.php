<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, HasApiTokens; 
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','designation','spares','machine','workshop','super_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           if (Auth::user()) {
            $user = Auth::user();            
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
           }
         
       });
       static::updating(function($model)
       {
        if (Auth::user()) {
            $user = Auth::user();
            $model->updated_by = $user->id;
           }
          
       });    
               
   }
}