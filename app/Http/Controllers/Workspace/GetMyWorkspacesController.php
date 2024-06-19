<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Services\WorkspaceService;
use Illuminate\Http\Request;

class GetMyWorkspacesController extends Controller
{
    public function __construct(
        private readonly WorkspaceService $workspaceService
    ) {}

    public function __invoke(Request $request)
    {
        $workspaces = $this->workspaceService->getViewerWorkspaces();

        return $this->sendResponse($workspaces);
    }
}
