<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Category extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->timestamps = false;
                $model->saveQuietly();
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['name', 'slug', 'status'])
            ->useLogName('category')
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}");
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->merge([
            'meta' => [
                'ip' => request()?->ip() ?? 'cli',
                'agent' => request()?->userAgent() ?? 'cli',
                'url' => request()?->fullUrl() ?? 'cli',
            ]
        ]);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
