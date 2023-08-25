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
 * @property string $name
 * @property string $host
 * @property int $port
 * @property string $username
 * @property mixed $password
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
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseCredential whereUsername($value)
 */
	class DatabaseCredential extends \Eloquent {}
}

namespace App\Models\Game\Auth{
/**
 * App\Models\Game\Auth\Account
 *
 * @property int $id Identifier
 * @property string $username
 * @property mixed $salt
 * @property mixed $verifier
 * @property mixed|null $session_key
 * @property mixed|null $totp_secret
 * @property string $email
 * @property string $reg_mail
 * @property \Illuminate\Support\Carbon $joindate
 * @property string $last_ip
 * @property string $last_attempt_ip
 * @property int $failed_logins
 * @property int $locked
 * @property string $lock_country
 * @property \Illuminate\Support\Carbon|null $last_login
 * @property int $online
 * @property int $expansion
 * @property int $mutetime
 * @property string $mutereason
 * @property string $muteby
 * @property int $locale
 * @property string $os
 * @property int $recruiter
 * @property int $totaltime
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\UserAccount|null $userAccount
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereExpansion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFailedLogins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereJoindate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastAttemptIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLockCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereMuteby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereMutereason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereMutetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereRecruiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereRegMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereSessionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTotaltime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTotpSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereVerifier($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models\Game\Auth{
/**
 * App\Models\Game\Auth\Realmlist
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $localAddress
 * @property string $localSubnetMask
 * @property int $port
 * @property int $icon
 * @property int $flag
 * @property int $timezone
 * @property int $allowedSecurityLevel
 * @property float $population
 * @property int $gamebuild
 * @property-read \App\Models\Realm|null $realm
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereAllowedSecurityLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereGamebuild($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereLocalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereLocalSubnetMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realmlist whereTimezone($value)
 */
	class Realmlist extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Realm
 *
 * @property int $id
 * @property int $realmlist_id
 * @property string $name
 * @property string $slug
 * @property int $priority
 * @property int $is_visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RealmDatabase|null $characterDatabase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RealmDatabase> $databases
 * @property-read int|null $databases_count
 * @property-read \App\Models\Game\Auth\Realmlist|null $realmlist
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
 * @method static \Illuminate\Database\Eloquent\Builder|Realm whereRealmlistId($value)
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
 * @property-read \App\Models\DatabaseCredential $databaseCredential
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserAccount> $userAccounts
 * @property-read int|null $user_accounts_count
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

namespace App\Models{
/**
 * App\Models\UserAccount
 *
 * @property int $user_id
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Game\Auth\Account|null $account
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAccount whereUserId($value)
 */
	class UserAccount extends \Eloquent {}
}

