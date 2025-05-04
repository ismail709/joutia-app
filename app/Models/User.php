<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role_id',
        'profile_img_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        $adminRoleId = Role::firstWhere('name',RoleEnum::ADMIN->value)->id;
        return $this->role_id == $adminRoleId;
    }

    protected function scopeAdmin(Builder $query)
    {
        $adminRoleId = Role::firstWhere('name',RoleEnum::ADMIN->value)->id;
        if($adminRoleId)
            return $query->where('role_id',$adminRoleId);
    }

    protected function scopeUser(Builder $query)
    {
        $userRoleId = Role::firstWhere('name',RoleEnum::USER->value)->id;
        if($userRoleId)
            return $query->where('role_id',$userRoleId);
    }

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
