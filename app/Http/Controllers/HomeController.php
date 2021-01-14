<?php

namespace App\Controllers;

use App\Exceptions\GeneralException;
use App\Services\PostService;
use BaseController;
use Redirect;
use View;

/**
 * Class HomeController.
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
class HomeController extends Controller
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
     * Display the blog list.
     * @return View
     */
    public function index()
    {
        return view('frontend.blog')->with('posts', $this->postService->getPublishPosts());
    }

    /**
     * Display the post detail.
     * @return View
     */
    public function detail($id)
    {
        try {
            return view('frontend.blog-detail')->with('post', $this->postService->findById($id));
        } catch (GeneralException $e) {
            return redirect('/');
        }
    }

    /**
     * Display the all post.
     * @return View
     */
    public function all()
    {
        return view('frontend.blog-all')->with('posts', $this->postService->getAllPublishPosts());
    }
}
