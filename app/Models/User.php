<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable
{
    use HasFactory;
    use HasUlids;
    use Notifiable;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'email_verified_at',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Summary of credentials
     * @return HasMany<Credential>
     */
    public function credentials(): HasMany
    {
        return $this->hasMany(related: Credential::class, foreignKey: 'user_id');
    }

    /**
     * Summary of services
     * @return HasMany<Service>
     */
    public function services(): HasMany
    {
        return $this->hasMany(related: Service::class, foreignKey: 'user_id');
    }

    /**
     * Summary of casts
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


}
