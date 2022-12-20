<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 * @property-read int id
 * @property string name
 * @property string email
 * @property string password;
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class Admin extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPermissions, HasRoles ;

    protected $hidden = [
        'password'
    ];
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $casts = [
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];
    /**
     * Interact with the user's password
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    public function scopeSearch(Builder $query, string $search): Builder {
        return  $query->where(function (Builder $builder) use ($search) {
            return $builder
                ->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ;
        });
    }

}
