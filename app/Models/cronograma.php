<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cronograma extends Model
{
    public function tecnicos(): BelongsTo
    {
        return $this->belongsTo(tecnicos::class, 'idtecnico');
    }
    public function unidades(): BelongsTo
    {
        return $this->belongsTo(unidades::class, 'idunidad');
    }
}
