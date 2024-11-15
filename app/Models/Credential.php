<?php

namespace App\Models;

use App\Models\User;
use App\Models\Check;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Credential extends Model
{

    use HasFactory;
    use HasUlids;

    /**
     * Summary of fillable
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'type',
        'value',
        'user_id',
    ];


    /**
     * Summary of casts
     * @return array<string,string|class-string>
     */
    protected function casts(): array
    {
        return [
            'type' => 'array',
            'value' => 'encrypted',
        ];
    }

    /**
     * Summary of user
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo{
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }

    /**
     * Summary of checks
     * @return HasMany<Check>
     */
    public function checks(): HasMany
    {
        return $this->hasMany(related: Check::class, foreignKey: 'check_id');
    }

}
