<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;

class Music extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'created_at'     => 'datetime:d-m-y',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function singer(): BelongsTo
    {
        return $this->belongsTo(Singer::class);
    }

    public function rhythm(): BelongsTo
    {
        return $this->belongsTo(Rhythm::class);
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function search(string $search): LengthAwarePaginator
    {
        return $this->where('title', 'like', '%' . $search . '%')
            ->orWhere('lyrics', 'like', '%' . $search . '%')
            ->with('singer', 'note', 'rhythm')
            ->paginate(10);
    }

}
