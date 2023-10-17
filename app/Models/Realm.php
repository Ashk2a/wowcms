<?php

namespace App\Models;

use App\Core\Models\Traits\InteractsWithDatabases;
use App\Enums\Emulators;
use App\Models\Game\Auth\Realmlist;
use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Realm extends Model implements HasCurrentTenantLabel, HasName
{
    use HasFactory;
    use InteractsWithDatabases;

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

    public function realmlist(): BelongsTo
    {
        $relation = $this
            ->setAuthConnection()
            ->belongsTo(Realmlist::class);

        $this->setAppConnection();

        return $relation;
    }

    public function authDatabase(): BelongsTo
    {
        return $this->belongsTo(AuthDatabase::class);
    }

    public function gameDatabases(): HasMany
    {
        return $this->hasMany(GameDatabase::class);
    }

    //###################################################################################################################
    // FILAMENT
    //###################################################################################################################

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getCurrentTenantLabel(): string
    {
        return __('labels.current_realm');
    }
}
