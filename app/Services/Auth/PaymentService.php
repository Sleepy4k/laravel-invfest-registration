<?php

namespace App\Services\Auth;

use App\Contracts\Models;
use App\Enums\PaymentStatus;
use App\Services\Service;

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
        $user = $this->userInterface->findById(auth('web')->user()->id, ['*'], ['leader.team.competition']);
        $paymentMethods = $this->paymentMethodInterface->all();
        $team = $this->userInterface->get(['*'], true, ['leader.team.competition'], [['id', '=', auth('web')->user()->id]]);

        return compact('paymentMethods', 'team', 'user');
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
        $request['team_id'] = auth('web')->user()->leader->first()->team->first()->id;
        $request['status'] = PaymentStatus::PENDING;
        $request['method_id'] = $request['payment_method_id'];

        unset($request['payment_method_id']);

        $this->paymentInterface->create($request);
    }
}
