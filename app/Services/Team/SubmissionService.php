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
        $uid = auth('web')->user()->id;
        $user = $this->userInterface->findById($uid, ['id'], [
            'leader:id,team_id,user_id',
            'leader.team:id',
            'leader.team.payment:team_id,status',
            'leader.team.submission:team_id,title,file'
        ]);

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
            $request['team_id'] = auth('web')->user()->leader?->team?->id ?? null;
            if ($request['team_id'] == null) {
                alert('Gagal', 'Karya gagal ditambahkan, silahkan refresh halaman anda', 'error');
                return;
            }

            $this->submissionInterface->create($request);

            alert('Berhasil', 'Karya berhasil ditambahkan, semoga sukses!', 'success');
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
