<?php

namespace App\Resources;

use App\Models\Workspace;
use App\Models\WorkspaceProfile;
use Illuminate\Support\Facades\Auth;

class WorkspaceProfileResource
{
    public function toJson(WorkspaceProfile $workspaceProfile, Workspace $workspace): array
    {
        return [
            'id' => $workspaceProfile->public_id,
            'email' => $workspaceProfile->email,
            'first_name' => $workspaceProfile->first_name,
            'last_name' => $workspaceProfile->last_name,
            'display_name' => $workspaceProfile->display_name,
            'title' => $workspaceProfile->display_name,
            'is_self' => $workspaceProfile->user_id === Auth::id(),
            'workspace_id' => $workspace->public_id,
            'icon' => [
                'icon_20' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 20),
                'icon_36' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 36),
                'icon_72' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 72),
                'icon_96' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 96),
                'icon_192' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 192),
                'icon_256' => $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: 256),
            ]
        ];
    }

    private function getProfileAvatar(WorkspaceProfile $workspaceProfile, int $size): string
    {
        return "http://localhost/storage/workspace_profile_avatars/default/$workspaceProfile->default_avatar_number/$size.png";
    }
}
