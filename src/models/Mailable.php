<?php

namespace Utyemma\Notifire\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailable extends Model {
    use HasFactory;

    protected $fillable = ['body', 'subject', 'sent', 'mailable'];

    protected $attributes = [
        'sent' => 0
    ];

}
