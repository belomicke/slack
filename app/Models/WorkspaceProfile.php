<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string public_id
 * @property string first_name
 * @property string last_name
 * @property string display_name
 * @property string title
 * @property string email
 *
 * @property string avatar_folder_name
 * @property int default_avatar_number
 *
 * @property string user_id
 * @property string workspace_id
 *
 * @method static WorkspaceProfile create (array $attributes = [])
 */
class WorkspaceProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_id',
        'first_name',
        'last_name',
        'display_name',
        'title',
        'email',
        'user_id',
        'workspace_id',
        'default_avatar_number'
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(
            Workspace::class,
            'workspace_id',
            'id'
        );
    }
}
