<?php

namespace App\Repositories\Story;


use App\Models\Story;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StoryRepository implements StoryRepositoryInterface
{
    protected function query(): Builder
    {
        return Story::query();
    }

    public function store(array $data)
    {
        return $this->query()->create($data);
    }
    public function getStoryByToken(string $token)
    {
        return $this->query()->where('token', $token)->first();
    }
    public function getApprovedStories(): Collection
    {
        return $this->query()->where('approved', true)->latest()->get();
    }
    public function updateApproved(Story $story): void
    {
        $story->update(['approved' => true, 'approved_at' => now(), '_token' => null]);
    }
    public function getNewApprovedStories($approvedFrom, $approvedTo)
    {
        return Story::where('approved', 1)->whereBetween('approved_at', [$approvedFrom, $approvedTo])->get();
    }
}

