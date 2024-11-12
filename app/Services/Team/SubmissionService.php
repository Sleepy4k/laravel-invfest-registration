<?php

namespace App\Services\Team;

use App\Contracts\Models;
use App\Services\Service;

class SubmissionService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface,
        private Models\SubmissionInterface $submissionInterface
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $user = $this->userInterface->findById(auth('web')->user()->id, ['*'], ['leader.team.payment', 'leader.team.submission']);

        return compact('user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     *
     * @return void
     */
    public function store(array $request): void
    {
        try {
            $this->submissionInterface->create($request);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
