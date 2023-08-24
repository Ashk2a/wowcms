<?php

namespace App\Models;

use App\Models\Game\Auth\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAccount extends Pivot
{
    public function account(): BelongsTo
    {
        return $this->setConnection('auth')->belongsTo(Account::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
