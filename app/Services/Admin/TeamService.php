<?php

namespace App\Services\Admin;

use App\Contracts\Models;
use App\Enums\PaymentStatus;
use App\Notifications\TeamApproved;
use App\Notifications\TeamRejected;
use App\Services\Service;

class TeamService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface,
        private Models\TeamInterface $teamInterface,
        private Models\PaymentInterface $paymentInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $teams = $this->teamInterface->all(['id', 'name', 'institution', 'competition_id'], ['competition:id,name,level_id', 'competition.level:id,display_as', 'payment:team_id,proof,status', 'leader:team_id,name']);

        return compact('teams');
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
        $team = $this->teamInterface->get(['id', 'name', 'institution', 'competition_id'], true, ['competition:id,whatsapp_group', 'competition.level:id,level', 'payment.method', 'leader.user', 'member:team_id,name,card'], [['id', '=', $id]]);
        $status = PaymentStatus::class;

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
            $payment = $this->paymentInterface->get(['id'], true, [], [['team_id', '=', $id]]);
            if ($payment == null) {
                toast('ID tim tidak ditemukan pada system atau belum melakukan pembayaran', 'error');
                return;
            }

            $this->paymentInterface->update($payment->id, $request['status']);
            $user = $this->userInterface->get(['*'], true, [], [['email', '=', $request['email']]]);

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
            $this->teamInterface->deleteById($id);

            toast('Tim berhasil dihapus', 'success');
        } catch (\Throwable $th) {
            toast('Tim gagal dihapus', 'error');
            throw $th;
        }
    }
}