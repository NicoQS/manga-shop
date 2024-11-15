<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Check extends Model
{
    use HasFactory;
    use HasUlids;

    /**
     * Summary of fillable
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'path',
        'method',
        'body',
        'headers',
        'parameters',
        'credential_id',
        'service_id',
    ];

    /**
     * Summary of credential
     * @return BelongsTo<Credential>
     */
    public function credential(): BelongsTo
    {
        return $this->belongsTo(related: Credential::class, foreignKey: 'credential_id');
    }


    /**
     * Summary of service
     * @return BelongsTo<Service>
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(related: Service::class, foreignKey: 'service_id');
    }



    /**
     * Summary of casts
     * @return array<string,string|class-string>
     */
    protected function casts(): array
    {
        return [
            'body' => 'json',
            'headers' => AsCollection::class,
            'parameters' => AsCollection::class,
        ];
    }

}
