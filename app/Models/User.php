<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use Notifiable, HasRoles, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'email_verified_at',
    'password',
    'phone',
    'address',
    'photo',
    'company_id',
    'locale',
    'date_of_birth',
    'gender',
    'blood_group',
    'status',
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
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function companies()
  {
    return $this->morphToMany(Company::class, 'user', 'user_companies', 'user_id', 'company_id');
  }

  public function doctorSchedules()
  {
    return $this->hasMany(DoctorSchedule::class);
  }

  public function patientAppointments()
  {
    return $this->hasMany(PatientAppointment::class);
  }

  public function doctorAppointments()
  {
    return $this->hasMany(PatientAppointment::class, 'doctor_id');
  }

  public function getPhotoUrlAttribute()
  {
    if ($this->photo)
      return asset($this->photo);
    else
      return asset('assets/images/placeholder.jpg');
  }

  public function patientCaseStudy()
  {
    return $this->hasOne(PatientCaseStudy::class);
  }

  public function labReports()
  {
    return $this->hasMany(LabReport::class, 'patient_id');
  }
}
