<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Mail\StoryApproval;
use App\Repositories\Story\StoryRepositoryInterface;
use App\Service\Actions\Story\NewApprovedStoriesAction;
use App\Service\Actions\Story\StoryApprovedUpdateAction;
use App\Service\Actions\Story\StoryCreateAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;


class StoryController extends Controller
{
    public function create(): View
    {
        return view('addStory');
    }

    public function approve($token, StoryApprovedUpdateAction $storyApprovedUpdateAction): RedirectResponse
    {
       $storyApprovedUpdateAction->run($token);

       return redirect()->route('addStory')->with('status', 'Story approved.');
    }


    public function store(StoryCreateAction $storyCreateAction, StoryRequest $request): RedirectResponse
    {
        $data = $request->all();
        $story = $storyCreateAction->run($data);

        $approvalLink = route('story-approval', ['token' => $story->token]);
        Cache::put('STORY_APPROVAL_TOKEN_' . $story->token, true, now()->addHours(24));
        Mail::to(Auth::user()->email)->send(new StoryApproval($story, $approvalLink));

        return redirect()->back()->with('status', 'Please check your email to confirm your story submission.');
    }

    public function index(StoryRepositoryInterface $storyRepository)
    {
        $approvedStories = $storyRepository->getApprovedStories();
        return view('noticeBoard', compact('approvedStories'));
    }

    public function getNewApprovedStories(Request $request, NewApprovedStoriesAction $newApprovedStoriesAction): JsonResponse
    {
         $newApprovedStories = $newApprovedStoriesAction->run($request);

        return response()->json([
            'status' => 'success',
            'stories' => $newApprovedStories->toArray()
        ]);
    }

}
