<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class historial extends Model
{
    public function nodos(): BelongsTo
    {
        return $this->belongsTo(nodos::class, 'nodo');
    }
    public function tecnicos(): BelongsTo
    {
        return $this->belongsTo(tecnicos::class, 'tecnico');
    }
}
