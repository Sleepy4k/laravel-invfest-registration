<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Enums\PaymentStatus;
use App\Foundations\Service;

class PaymentService extends Service
{
    /**
     * Model contract constructor.
     */
    public function __construct(
        private Models\UserInterface $userInterface,
        private Models\PaymentInterface $paymentInterface,
        private Models\PaymentMethodInterface $paymentMethodInterface,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        $uid = auth('web')->user()->id;
        $paymentMethods = $this->paymentMethodInterface->all(['id', 'name', 'number', 'owner', 'logo']);
        $user = $this->userInterface->findById($uid, ['id'], [
            'leader:id,team_id,user_id',
            'leader.team:id,competition_id,name',
            'leader.team.competition:id,registration_fee'
        ]);

        return compact('paymentMethods', 'user');
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
        $request['team_id'] = auth('web')->user()->leader?->team?->id;
        $request['status'] = PaymentStatus::PENDING;
        $request['method_id'] = $request['payment_method_id'];

        unset($request['payment_method_id']);

        $this->paymentInterface->create($request);
    }
}
