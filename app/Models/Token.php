<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Token extends Model
{
    use SoftDeletes;

    public $table = 'tokens';

    protected $fillable = [
        'website', 'domain', 'consumer_key', 'consumer_secret', 'access_token', 'access_token_secret'
    ];

    public function getWebsites()
    {
        return self::select('website')
            ->pluck('website')
            ->all();
    }

    public function getTokenByWebsite($website) {
        return self::where('website', $website)->firstOrFail();
    }
}
