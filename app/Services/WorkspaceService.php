<?php

namespace App\Services;

use App\Repositories\WorkspaceProfileRepository;
use App\Repositories\WorkspaceRepository;
use App\Resources\WorkspaceProfileResource;
use App\Resources\WorkspaceResource;
use Illuminate\Support\Facades\Auth;

readonly class WorkspaceService
{
    public function __construct(
        private readonly WorkspaceRepository $workspaces,
        private readonly WorkspaceResource $workspaceResource,
        private readonly WorkspaceProfileRepository $workspaceProfiles,
    ) {}

    public function getViewerWorkspaces(int $offset = 0, int $limit = 50): array
    {
        $workspaces = $this->workspaces->getViewerWorkspaces(
            offset: $offset,
            limit: $limit
        );

        $workspacesIds = $workspaces->pluck('id')->toArray();
        $workspaceProfiles = $this->workspaceProfiles->getMyWorkspaceProfilesByWorkspaceIds(ids: $workspacesIds);
        $items = [];

        foreach ($workspaces as $workspace) {
            $workspaceProfile = $workspaceProfiles->where('workspace_id', $workspace->id)->first();

            $items[] = $this->workspaceResource->toJsonWithProfile(
                workspace: $workspace,
                workspaceProfile: $workspaceProfile
            );
        }

        return [
            'workspaces' => $items,
            'count' => Auth::user()->workspace_count
        ];
    }
}
