<?php

declare(strict_types=1);

namespace App\Models\Game\Auth;

use App\Core\Models\Traits\InteractsWithDatabases;
use App\Models\Game\Character\Character;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Account extends Model
{
    use InteractsWithDatabases;

    //##################################################################################################################
    // ATTRIBUTES
    //##################################################################################################################

    protected $connection = 'auth';

    protected $table = 'account';

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'salt',
        'verifier',
        'session_key',
    ];

    /**
     * @var array<string, string>
     */
    public $casts = [
        'joindate' => 'datetime',
        'last_login' => 'datetime',
    ];

    //##################################################################################################################
    // RELATIONS
    //##################################################################################################################

    public function user(): HasOneThrough
    {
        $relation = $this
            ->setAppConnection()
            ->hasOneThrough(
                User::class,
                UserAccount::class,
                'user_id',
                'id',
                'id',
                'user_id'
            );

        $this->setAuthConnection();

        return $relation;
    }

    public function characters(): HasMany
    {
        $relation = $this
            ->setCharactersConnection()
            ->hasMany(Character::class, 'account');

        $this->setAuthConnection();

        return $relation;
    }
}
