<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Activity
 *
 * @property int $id
 * @property int $user_id
 * @property int $subject_id
 * @property string $subject_type
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Activity whereUserId($value)
 */
	class Activity extends \Eloquent {}
}

namespace App{
/**
 * App\Channel
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Channel whereUpdatedAt($value)
 */
	class Channel extends \Eloquent {}
}

namespace App{
/**
 * App\Favorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $favorited_id
 * @property string $favorited_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $favorited
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereFavoritedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereFavoritedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Favorite whereUserId($value)
 */
	class Favorite extends \Eloquent {}
}

namespace App{
/**
 * App\Reply
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Favorite[] $favorites
 * @property-read mixed $favorites_count
 * @property-read mixed $is_favorited
 * @property-read \App\User $owner
 * @property-read \App\Thread $thread
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereUserId($value)
 */
	class Reply extends \Eloquent {}
}

namespace App{
/**
 * App\Thread
 *
 * @property int $id
 * @property int $user_id
 * @property int $channel_id
 * @property int $replies_count
 * @property string $title
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \App\Channel $channel
 * @property-read \App\User $creator
 * @property-read mixed $is_subscribed_to
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ThreadSubscription[] $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread filter($filters)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereRepliesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Thread whereUserId($value)
 */
	class Thread extends \Eloquent {}
}

namespace App{
/**
 * App\ThreadSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Thread $thread
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ThreadSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ThreadSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ThreadSubscription whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ThreadSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ThreadSubscription whereUserId($value)
 */
	class ThreadSubscription extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activity
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Thread[] $threads
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

