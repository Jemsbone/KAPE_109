<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rating';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'rating_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'rating',
        'rating_message',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'rating' => 5, // Default rating if not specified
    ];

    /**
     * Get the user that made the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Scope a query to only include ratings for a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include ratings with a minimum rating value.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $minRating
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinRating($query, $minRating = 1)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /**
     * Scope a query to only include ratings with a maximum rating value.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $maxRating
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaxRating($query, $maxRating = 10)
    {
        return $query->where('rating', '<=', $maxRating);
    }

    /**
     * Scope a query to only include high ratings (8-10).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighRatings($query)
    {
        return $query->where('rating', '>=', 8);
    }

    /**
     * Scope a query to only include low ratings (1-3).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowRatings($query)
    {
        return $query->where('rating', '<=', 3);
    }

    /**
     * Scope a query to only include average ratings (4-7).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAverageRatings($query)
    {
        return $query->whereBetween('rating', [4, 7]);
    }

    /**
     * Get the rating as stars (string representation).
     *
     * @return string
     */
    public function getStarsAttribute()
    {
        return str_repeat('⭐', $this->rating) . str_repeat('☆', 10 - $this->rating);
    }

    /**
     * Get the rating as a percentage (out of 10).
     *
     * @return float
     */
    public function getPercentageAttribute()
    {
        return ($this->rating / 10) * 100;
    }

    /**
     * Check if the rating is considered high (8-10).
     *
     * @return bool
     */
    public function getIsHighRatingAttribute()
    {
        return $this->rating >= 8;
    }

    /**
     * Check if the rating is considered low (1-3).
     *
     * @return bool
     */
    public function getIsLowRatingAttribute()
    {
        return $this->rating <= 3;
    }

    /**
     * Check if the rating has a message.
     *
     * @return bool
     */
    public function getHasMessageAttribute()
    {
        return !empty(trim($this->rating_message));
    }

    /**
     * Get a shortened version of the rating message.
     *
     * @param  int  $length
     * @return string
     */
    public function getExcerptAttribute($length = 100)
    {
        if (strlen($this->rating_message) <= $length) {
            return $this->rating_message;
        }

        return substr($this->rating_message, 0, $length) . '...';
    }

    /**
     * Validate that the rating is within the allowed range (1-10).
     *
     * @param  int  $value
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setRatingAttribute($value)
    {
        $value = (int) $value;
        if ($value < 1 || $value > 10) {
            throw new \InvalidArgumentException('Rating must be between 1 and 10.');
        }

        $this->attributes['rating'] = $value;
    }

    /**
     * Get all possible rating values.
     *
     * @return array
     */
    public static function getPossibleRatings()
    {
        return range(1, 10);
    }
}