<?php

declare(strict_types=1);

namespace App\Models\Game\Character;

use App\Core\Models\Traits\InteractsWithDatabases;
use App\Models\Game\Auth\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Character extends Model
{
    use InteractsWithDatabases;

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    protected $connection = 'characters';

    protected $primaryKey = 'guid';

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    //##################################################################################################################
    // RELATIONS
    //##################################################################################################################

    public function authAccount(): BelongsTo
    {
        $relation = $this
            ->setAuthConnection()
            ->belongsTo(Account::class, 'account');

        $this->setCharactersConnection();

        return $relation;
    }
}
