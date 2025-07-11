<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'avatar',
        'document',
        'name',
        'phone',
        'email',
        'password',
        'status'
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getRolesFormattedAttribute()
    {
        return $this->roles->map(fn ($role) => [
            'name' => $role->name,
            'label' => $role->label,
        ]);
    }

    public function toArray()
    {
        $array = parent::toArray();

        if ($this->relationLoaded('roles')) {
            $array['roles'] = collect($this->roles)->map(function ($role) {
                return [
                    'name' => is_array($role) ? $role['name'] : $role->name,
                    'label' => is_array($role) ? $role['label'] : $role->label,
                ];
            })->values();
        }

        return $array;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public static function paginateWithFilters($filters = [])
    {
        return User::when(isset($filters['name']), function ($query) use ($filters) {
                    $query->where('name', 'like', "%{$filters['name']}%");
                })
                ->when(isset($filters['document']), function ($query) use ($filters) {
                    $query->where('document', $filters['document']);
                })
                ->when(isset($filters['phone']), function ($query) use ($filters) {
                    $query->where('phone', $filters['phone']);
                })
                ->when(isset($filters['email']), function ($query) use ($filters) {
                    $query->where('email', $filters['email']);
                })
                ->when(isset($filters['role']), function ($query) use ($filters) {
                    $query->whereHas('roles', function ($q) use ($filters) {
                        $q->where('name', $filters['role']);
                    });
                })
            ->paginate($filters['per_page'] ?? 10);
    }
}