<?php

namespace App\Models;

use App\Core\Models\Traits\InteractsWithDatabases;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements FilamentUser, HasName, HasTenants
{
    use HasFactory;
    use InteractsWithDatabases;
    use Notifiable;

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    //##################################################################################################################
    // FILAMENT
    //##################################################################################################################

    public function userAccounts(): HasMany
    {
        return $this->hasMany(UserAccount::class);
    }

    //##################################################################################################################
    // FILAMENT
    //##################################################################################################################

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->nickname;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return true;
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return Realm::all();
    }
}
