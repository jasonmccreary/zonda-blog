<?php

namespace App\Controllers\Backend;

use App\Services\PostService;
use Auth;
use BaseController;
use Form;
use Input;
use Redirect;
use View;

/**
 * Class DashboardController.
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * @var
     */
    protected $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display the dashboard page.
     * @return View
     */
    public function index()
    {
        return view('backend.dashboard.dashboard')->with([
                        'totalCount'=> count($this->postService->getAllPosts()),
                        'publishCount'=> $this->postService->getPublishPostCount(),
                        'draftCount'=> $this->postService->getDraftPostCount(),
        ]);
    }
}
