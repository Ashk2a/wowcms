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
 * App\Models\DatabaseCredential
 *
 * @property int $id
 * @property string $host
 * @property int $port
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RealmDatabase> $databases
 * @property-read int|null $databases_count
 * @property-read string $url
 * @method static \Database\Factories\DatabaseCredentialFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential matchUrl(string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereUsername($value)
 */
	class DatabaseCredential extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Realm
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int $priority
 * @property int $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RealmDatabase|null $authDatabase
 * @property-read \App\Models\RealmDatabase|null $characterDatabase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RealmDatabase> $databases
 * @property-read int|null $databases_count
 * @property-read \App\Models\RealmDatabase|null $worldDatabase
 * @method static \Database\Factories\RealmFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Realm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereUpdatedAt($value)
 */
	class Realm extends \Eloquent implements \Filament\Models\Contracts\HasName, \Filament\Models\Contracts\HasCurrentTenantLabel {}
}

namespace App\Models{
/**
 * App\Models\RealmDatabase
 *
 * @property int $id
 * @property int $realm_id
 * @property int $database_credential_id
 * @property \App\Enums\RealmDatabaseTypes $type
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DatabaseCredential|null $credential
 * @property-read \App\Models\Realm $realm
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase query()
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereDatabaseCredentialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereRealmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealmDatabase whereUpdatedAt($value)
 */
	class RealmDatabase extends \Eloquent {}
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

