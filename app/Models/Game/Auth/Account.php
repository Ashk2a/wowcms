<?php

declare(strict_types=1);

namespace App\Models\Game\Auth;

use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Account extends Model
{
    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    public $connection = 'auth';

    public $table = 'account';

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
    ];

    /**
     * @var array<string, string>
     */
    public $casts = [
        'joindate' => 'datetime',
        'last_login' => 'datetime',
    ];

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public function userAccount(): HasOne
    {
        $relation = $this->setConnection('app')->hasOne(UserAccount::class);

        $this->setConnection('auth');

        return $relation;
    }

    public function user(): HasOneThrough
    {
        return $this
            ->setConnection('app')
            ->hasOneThrough(
                User::class,
                UserAccount::class,
                'user_id',
                'id',
                'id',
                'user_id'
            );
    }
}
