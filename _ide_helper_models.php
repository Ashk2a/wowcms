<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Realm
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RealmFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Realm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereUpdatedAt($value)
 */
	class Realm extends \Eloquent implements \Filament\Models\Contracts\HasName {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property mixed|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser, \Filament\Models\Contracts\HasName, \Filament\Models\Contracts\HasTenants {}
}

