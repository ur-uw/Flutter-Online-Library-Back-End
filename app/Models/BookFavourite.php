<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BookFavourite
 *
 * @property Carbon $created_at
 * @property int $id
 * @property Carbon $updated_at
 * @property int $user_id
 * @property int $book_id
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookFavourite whereUserId($value)
 * @mixin \Eloquent
 */
class BookFavourite extends Model
{
    use HasFactory;

    protected $table = 'favourites';

}
