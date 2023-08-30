<?php

namespace App\Models;

use App\Core\Models\Traits\InteractWithMultiDatabases;
use App\Models\Game\Auth\Realmlist;
use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Realm extends Model implements HasName, HasCurrentTenantLabel
{
    use HasFactory;
    use InteractWithMultiDatabases;
    use HasSlug;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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

    //###################################################################################################################
    // SLUG
    //###################################################################################################################

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
