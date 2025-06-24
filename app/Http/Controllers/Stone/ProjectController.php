<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Hiển thị danh sách dự án
     */
    public function index(Request $request)
    {
        $query = StoneProject::where('status', 1);
        
        // Lọc theo khu vực
        if ($request->has('region') && $request->region) {
            switch ($request->region) {
                case 'north':
                    $query->where('region', StoneProject::REGION_NORTH);
                    break;
                case 'central':
                    $query->where('region', StoneProject::REGION_CENTRAL);
                    break;
                case 'south':
                    $query->where('region', StoneProject::REGION_SOUTH);
                    break;
            }
        }
        
        // Lọc theo tỉnh/thành phố
        if ($request->has('province') && $request->province) {
            $query->where('province', $request->province);
        }
        
        // Sắp xếp
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'date-asc':
                $query->orderBy('completed_date', 'asc');
                break;
            case 'date-desc':
                $query->orderBy('completed_date', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $projects = $query->paginate(9);
        
        // Lấy danh sách tỉnh/thành phố để hiển thị filter
        $provinces = StoneProject::where('status', 1)
            ->select('province')
            ->distinct()
            ->orderBy('province', 'asc')
            ->pluck('province')
            ->toArray();
            
        return view('stone.projects.index', compact('projects', 'provinces'));
    }
    
    /**
     * Hiển thị chi tiết dự án
     */
    public function show($slug)
    {
        $project = StoneProject::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Lấy dự án liên quan (cùng khu vực)
        $relatedProjects = StoneProject::where('status', 1)
            ->where('id', '!=', $project->id)
            ->where('region', $project->region)
            ->limit(3)
            ->get();
            
        return view('stone.projects.show', compact('project', 'relatedProjects'));
    }
} 