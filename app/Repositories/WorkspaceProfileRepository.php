<?php

namespace App\Repositories;

use App\Models\WorkspaceProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class WorkspaceProfileRepository
{
    public function getMyWorkspaceProfilesByWorkspaceIds(array $ids): Collection
    {
        return WorkspaceProfile::query()
            ->whereIn('workspace_id', $ids)
            ->where('user_id', Auth::id())
            ->get();
    }
}
