<?php

namespace App\Repositories;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class WorkspaceRepository
{
    public function getViewerWorkspaces(int $offset = 0, int $limit = 50): Collection
    {
        return Workspace::query()
            ->whereHas('workspace_profiles', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            })
            ->skip($offset)
            ->take($limit)
            ->get();
    }
}
