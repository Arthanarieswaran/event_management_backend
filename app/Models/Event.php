<?php
namespace App\Models;

use App\Models\Attendee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location', 'start_time', 'end_time', 'max_capacity'];

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    // Mutators: called automatically when saving
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value, config('app.timezone'))
            ->setTimezone('UTC');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value, config('app.timezone'))
            ->setTimezone('UTC');
    }

    // Accessors: called automatically when fetching
    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value, 'UTC')->setTimezone(config('app.timezone'));
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value, 'UTC')->setTimezone(config('app.timezone'));
    }
}
