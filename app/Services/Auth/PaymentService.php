<?php

namespace App\Services\Auth;

use App\Contracts\Models;
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
        $paymentMethods = $this->paymentMethodInterface->all();
        $team = $this->userInterface->get(['*'], true, ['leader.team.competition'], [['id', '=', auth('web')->user()->id]]);

        return compact('paymentMethods', 'team');
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
        $this->paymentInterface->create($request);
    }
}
