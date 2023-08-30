<?php

declare(strict_types=1);

namespace App\Models\Game\Auth;

use App\Core\Models\Traits\InteractWithMultiDatabases;
use App\Models\Realm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Realmlist extends Model
{
    use InteractWithMultiDatabases;

    //###################################################################################################################
    // ATTRIBUTES
    //###################################################################################################################

    public $connection = 'auth';

    public $table = 'realmlist';

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    //###################################################################################################################
    // RELATIONS
    //###################################################################################################################

    public function realm(): HasOne
    {
        $relation = $this
            ->setAppConnection()
            ->hasOne(Realm::class);

        $this->setAuthConnection();

        return $relation;
    }
}
