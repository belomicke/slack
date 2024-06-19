<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\WorkspaceProfile;
use App\Resources\WorkspaceResource;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWorkspaceController extends Controller
{
    public function __construct(
        private readonly WorkspaceResource $workspaceResource,
    ) {}

    public function __invoke(Request $request)
    {
        $name = $request->get('workspace_name') ?? 'test';
        $displayName = $request->get('workspace_profile_display_name');
        $avatarFile = $request->file('workspace_profile_avatar_file');
        $defaultAvatarNumber = $request->get('workspace_profile_default_avatar_number') ?? fake()->numberBetween(0, 26);

        $workspace = $this->createWorkspace(name: $name);
        $workspaceProfile = $this->createWorkspaceProfile(
            workspaceId: $workspace->id,
            avatarFile: $avatarFile,
            displayName: $displayName,
            defaultAvatarNumber: $defaultAvatarNumber
        );

        $responseData = $this->workspaceResource->toJsonWithProfile(
            workspace: $workspace,
            workspaceProfile: $workspaceProfile
        );

        return $this->sendResponse($responseData);
    }

    public function createWorkspace(string $name)
    {
        return Workspace::create([
            'public_id' => Str::uuid(),
            'name' => $name,
            'default_icon_number' => fake()->numberBetween(0, 24),
        ])->fresh();
    }

    public function createWorkspaceProfile(
        int $workspaceId,
        UploadedFile|null $avatarFile = null,
        string $displayName = '',
        int $defaultAvatarNumber = 0
    ) {
        $viewer = Auth::user();

        if ($avatarFile !== null) {
            $avatarFolderName = '';
            // save avatar
        }

        return WorkspaceProfile::create([
            'public_id' => Str::uuid(),
            'first_name' => $viewer->first_name,
            'last_name' => $viewer->last_name,
            'display_name' => $displayName ?? $viewer->username,
            'title' => '',
            'email' => $viewer->email,
            'workspace_id' => $workspaceId,
            'default_avatar_number' => $defaultAvatarNumber,
            'user_id' => $viewer->id
        ]);
    }
}
