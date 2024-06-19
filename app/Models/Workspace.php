<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string public_id
 * @property string name
 *
 * @property string icon_folder_name
 * @property number default_icon_number
 *
 * @method static Workspace create (array $attributes = [])
 */
class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_id',
        'name',
        'default_icon_number'
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];

    public function workspace_profiles(): BelongsTo
    {
        return $this->belongsTo(
            WorkspaceProfile::class,
            'id',
            'workspace_id',
        );
    }
}
