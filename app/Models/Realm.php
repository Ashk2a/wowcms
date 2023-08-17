<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realm extends Model implements HasName
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function getFilamentName(): string
    {
        return $this->name;
    }
}
