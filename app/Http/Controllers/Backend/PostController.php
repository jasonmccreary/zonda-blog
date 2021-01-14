<?php

namespace App\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use BaseController;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Redirect;
use Response;
use Validator;
/**
 * Class PostController.
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
use View;

class PostController extends Controller
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
     * Display the post page.
     * @return View
     */
    public function index()
    {
        return view('backend.post.post')->with(
                        'posts', $this->postService->getAllPosts()
        );
    }

    /**
     * Display the post add page.
     * @return View
     */
    public function add()
    {
        return view('backend.post.post-add');
    }

    /**
     * Display the post edit page.
     * @return View
     */
    public function edit($id)
    {
        try {
            return view('backend.post.post-edit')->with(
                            'post', $this->postService->findById($id)
            );
        } catch (GeneralException $e) {
            return redirect('post');
        }
    }

    /**
     * Used to store post information.
     * @return array $response
     */
    public function store()
    {
        try {
            $validator = Validator::make(Request::all(), Post::$rules);
            if ($validator->fails()) {
                $response['status'] = config('constants.ERROR');
                $response['message'] = 'Please fill the required field.';
            } else {
                $this->postService->save(Request::all());
                $response['status'] = config('constants.SUCCESS');
                $response['message'] = 'Post saved successfully.';
            }
        } catch (QueryException $e) {
            $response['status'] = config('constants.ERROR');
            $response['message'] = 'There was a problem due to duplicate post. Please try again.';
        }

        return Response::json($response);
    }

    /**
     * Used to update post information.
     * @return array $response
     */
    public function update()
    {
        try {
            $validator = Validator::make(Request::all(), Post::$rules);
            if ($validator->fails()) {
                $response['status'] = config('constants.ERROR');
                $response['message'] = 'Please fill the required field.';
            } else {
                $this->postService->update(Request::all());
                $response['status'] = config('constants.SUCCESS');
                $response['message'] = 'Post updated successfully.';
            }
        } catch (QueryException $e) {
            $response['status'] = config('constants.ERROR');
            $response['message'] = 'There was a problem due to duplicate post. Please try again.';
        } catch (GeneralException $e) {
            $response['status'] = config('constants.ERROR');
            $response['message'] = $e->getMessage();
        }

        return Response::json($response);
    }

    /**
     * Used to delete post information.
     * @param $id
     * @return array $response
     */
    public function destroy($id)
    {
        try {
            $this->postService->destroy($id);
            $response['status'] = config('constants.SUCCESS');
            $response['message'] = 'Post deleted successfully.';
        } catch (GeneralException $e) {
            $response['status'] = config('constants.ERROR');
            $response['message'] = 'There was a problem deleting this post. Please try again.';
        }

        return Response::json($response);
    }
}
