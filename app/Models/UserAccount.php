<?php

namespace App\Models;

use App\Core\Models\Traits\InteractsWithDatabases;
use App\Models\Game\Auth\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAccount extends Pivot
{
    use InteractsWithDatabases;

    public function account(): BelongsTo
    {
        $relation = $this
            ->setAuthConnection()
            ->belongsTo(Account::class);

        $this->setAppConnection();

        return $relation;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
