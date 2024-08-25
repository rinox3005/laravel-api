<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies', 'type')->paginate(4);
        return response()->json([
            'status' => true,
            'results' => $projects
        ]);
    }
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('technologies', 'type')->first();

        if ($project) {
            return response()->json([
                'status' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'status' => false,
                'results' => null
            ], 404);
        }
    }
}
