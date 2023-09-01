<?php

namespace App\Models;

use App\Enums\Emulators;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthDatabase extends Model
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
        'emulator' => Emulators::class,
    ];

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public function databaseCredential(): BelongsTo
    {
        return $this->belongsTo(DatabaseCredential::class);
    }
}
