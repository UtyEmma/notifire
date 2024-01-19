<?php

namespace Utyemma\Notifire\Model;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailable extends Model {
    use HasFactory;

    protected $fillable = ['content', 'subject', 'layout', 'sent', 'mailable', 'title', 'variables'];

    protected $casts = [
        'variables' => 'array'
    ];

    protected $attributes = [
        'sent' => 0
    ];

}
