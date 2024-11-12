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
        private Models\SubmissionInterface $submissionInterface
    ) {}

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
