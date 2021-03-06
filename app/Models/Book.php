<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Book
 *
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property string $book_name
 * @property string $author
 * @property string $release_date
 * @property string $cover_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCoverUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $isbn
 * @property mixed $favorites
 * @property mixed $is_favoured
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereIsbn($value)
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'book_name',
        'released_at',
        'cover_url',
    ];
    protected $appends=array('is_favoured');

    public function getIsFavouredAttribute(): bool
    {
        return $this->isFavoured();
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->as('users')->withTimestamps();
    }


    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function isFavoured(): bool
    {
        return (bool)BookFavourite::where('user_id', Auth::id())
            ->where('book_id', $this->id)
            ->first();
    }
}
