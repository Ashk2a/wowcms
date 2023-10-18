<?php

namespace App\Models;

use App\Core\Models\Traits\InteractsWithDatabases;
use App\Models\Game\Auth\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccount extends Model
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
