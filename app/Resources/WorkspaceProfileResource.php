<?php

namespace App\Resources;

use App\Models\Workspace;
use App\Models\WorkspaceProfile;
use Illuminate\Support\Facades\Auth;

class WorkspaceProfileResource
{
    public function toJson(WorkspaceProfile $workspaceProfile, Workspace $workspace): array
    {
        $icons = [];

        foreach ([20, 36, 72, 96, 192, 256] as $size) {
            $icons["icon_$size"] = $this->getProfileAvatar(workspaceProfile: $workspaceProfile, size: $size);
        }

        return [
            'id' => $workspaceProfile->public_id,
            'email' => $workspaceProfile->email,
            'first_name' => $workspaceProfile->first_name,
            'last_name' => $workspaceProfile->last_name,
            'display_name' => $workspaceProfile->display_name,
            'title' => $workspaceProfile->display_name,
            'is_self' => $workspaceProfile->user_id === Auth::id(),
            'workspace_id' => $workspace->public_id,
            'icon' => $icons
        ];
    }

    private function getProfileAvatar(WorkspaceProfile $workspaceProfile, int $size): string
    {
        return "http://localhost/workspace_profile_avatars/default/$workspaceProfile->default_avatar_number/$size.png";
    }
}
