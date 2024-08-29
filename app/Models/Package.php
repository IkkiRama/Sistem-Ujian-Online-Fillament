<?php

namespace App\Models;

use App\Models\Tryout;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function questions(): HasMany
    {
        return $this->hasMany(PackageQuestion::class);
    }

    public function tryout(): HasMany
    {
        return $this->hasMany(Tryout::class);
    }
}
