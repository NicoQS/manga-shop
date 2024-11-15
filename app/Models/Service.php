<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use App\Models\Check;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 * @property Collection<Check> $checks
 *
 */

final class Service extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * Summary of fillable
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'url',
        'user_id',
    ];

    /**
     * Summary of user
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }

    /**
     * Summary of checks
     * @return HasMany<Check>
     */
    public function checks(): HasMany
    {
        return $this->hasMany(related: Check::class, foreignKey: 'service_id');
    }
}
