<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Enums\PaymentStatus;
use App\Foundations\Service;
use App\Notifications\TeamApproved;
use App\Notifications\TeamRejected;

class TeamService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface,
        private Models\TeamInterface $teamInterface,
        private Models\TeamLeaderInterface $teamLeaderInterface,
        private Models\PaymentInterface $paymentInterface,
        private Models\CompetitionInterface $competitionInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $competitions = $this->competitionInterface->all(['id', 'name']);

        return compact('competitions');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return array
     */
    public function show(string $id): array
    {
        $status = PaymentStatus::class;
        $team = $this->teamInterface->findById($id, ['id', 'competition_id', 'name', 'institution'], [
            'competition:id,level_id,whatsapp_group',
            'competition.level:id,level',
            'payment:id,team_id,method_id,proof,status',
            'payment.method:id,name,owner,number',
            'leader:id,user_id,team_id,name,phone,card',
            'leader.user:id,email',
            'members:team_id,name,card',
            'companion:id,team_id,name,card'
        ]);

        return compact('team', 'status');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $request
     * @param string $id
     *
     * @return void
     */
    public function update(array $request, string $id): void
    {
        try {
            $payment = $this->paymentInterface->findByCustomId([['team_id', '=', $id]], ['id', 'team_id']);
            if (is_null($payment)) {
                toast('ID tim tidak ditemukan pada system atau belum melakukan pembayaran', 'error');
                return;
            }

            $this->paymentInterface->update($payment->id, ['status' => $request['status']]);
            $user = $this->userInterface->findByCustomId([['email', '=', $request['email']]]);

            if ($request['status'] == PaymentStatus::APPROVE->value) {
                $user->notify(new TeamApproved($request['whatsapp_link']));
            } else {
                $user->notify(new TeamRejected());
            }

            toast('Status tim berhasil diubah', 'success');
        } catch (\Throwable $th) {
            toast('Status tim gagal diubah', 'error');
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return void
     */
    public function destroy(string $id): void
    {
        try {
            $teamLeader = $this->teamLeaderInterface->findByCustomId([['team_id', '=', $id]], ['id', 'team_id', 'user_id']);

            $this->teamInterface->deleteById($id);

            if (isset($teamLeader) && !is_null($teamLeader?->user_id ?? null)) {
                $this->userInterface->deleteById($teamLeader->user_id);
            }

            toast('Tim berhasil dihapus', 'success');
        } catch (\Throwable $th) {
            toast('Tim gagal dihapus', 'error');
            throw $th;
        }
    }
}
