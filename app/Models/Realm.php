<?php

namespace App\Models;

use Filament\Models\Contracts\HasCurrentTenantLabel;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realm extends Model implements HasName, HasCurrentTenantLabel
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $realm) {
            $realm->slug = str($realm->name)->slug();
        });
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getCurrentTenantLabel(): string
    {
        return 'Current Realm';
    }
}
