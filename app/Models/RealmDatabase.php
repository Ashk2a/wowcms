<?php

namespace App\Models;

use App\Enums\RealmDatabaseTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealmDatabase extends Model
{
    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public $casts = [
        'type' => RealmDatabaseTypes::class,
    ];

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public function realm(): BelongsTo
    {
        return $this->belongsTo(Realm::class);
    }

    public function databaseCredential(): BelongsTo
    {
        return $this->belongsTo(DatabaseCredential::class);
    }
}
