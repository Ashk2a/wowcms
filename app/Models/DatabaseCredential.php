<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DatabaseCredential extends Model
{
    use HasFactory;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'encrypted',
    ];

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public function databases(): HasMany
    {
        return $this->hasMany(GameDatabase::class);
    }

    //###################################################################################################################
    // VIRTUAL ATTRIBUTES
    //###################################################################################################################

    public function url(): Attribute
    {
        return new Attribute(
            get: fn (): string => $this->host . ':' . $this->port
        );
    }

    //###################################################################################################################
    // SCOPES
    //###################################################################################################################

    public function scopeMatchUrl(Builder $query, string $search): Builder
    {
        return $query
            ->where('host', 'like', "%$search%")
            ->orWhere('port', 'like', "%$search%");
    }
}
