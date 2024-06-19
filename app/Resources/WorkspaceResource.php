<?php

namespace App\Resources;

use App\Models\Workspace;
use App\Models\WorkspaceProfile;

readonly class WorkspaceResource
{
    public function __construct(
        private WorkspaceProfileResource $workspaceProfileResource
    ) {}

    public function toJsonWithProfile(Workspace $workspace, WorkspaceProfile $workspaceProfile): array
    {
        return [
            'workspace' => $this->toJson(workspace: $workspace),
            'profile' => $this->workspaceProfileResource->toJson(
                workspaceProfile: $workspaceProfile,
                workspace: $workspace
            )
        ];
    }

    public function toJson(Workspace $workspace): array
    {
        return [
            'id' => $workspace->public_id,
            'name' => $workspace->name,
            'icon' => [
                'icon_34' => $this->getWorkspaceIcon($workspace, 34),
                'icon_44' => $this->getWorkspaceIcon($workspace, 44),
                'icon_68' => $this->getWorkspaceIcon($workspace, 68),
                'icon_88' => $this->getWorkspaceIcon($workspace, 88),
                'icon_102' => $this->getWorkspaceIcon($workspace, 102),
                'icon_132' => $this->getWorkspaceIcon($workspace, 132),
                'icon_230' => $this->getWorkspaceIcon($workspace, 230),
            ],
            'active_users' => 0,
        ];
    }

    public function getWorkspaceIcon(Workspace $workspace, int $size): string
    {
        if ($workspace->icon_folder_name === null) {
            return "http://localhost/storage/workspace_icons/default/$workspace->default_icon_number/$size.png";
        }

        return '';
    }
}
