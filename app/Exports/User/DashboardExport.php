<?php

namespace App\Exports\User;

use App\Foundations\Export;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardExport extends Export implements FromCollection
{
    /**
     * Data to be exported
     *
     * @var array
     */
    private Model $data;

    /**
     * Model contract constructor.
     */
    public function __construct(Model $data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = (object) $this->data;

        return collect([
            [
                'Title' => 'Nama Tim',
                'Data' => $user->leader->team->name,
            ],
            [
                'Title' => 'Kompetisi',
                'Data' => $user->leader->team->competition->name,
            ],
            [
                'Title' => 'Tingkat',
                'Data' => $user->leader->team->competition->level->display_as,
            ],
            [
                'Title' => 'Nama Ketua',
                'Data' => $user->leader->name,
            ],
            [
                'Title' => 'Email Ketua',
                'Data' => $user->email,
            ],
            [
                'Title' => 'Nomor Telepon Ketua',
                'Data' => $user->leader->phone,
            ],
            [
                'Title' => 'Nomor Identitas Ketua',
                'Data' => $user->leader->card,
            ],
            [
                'Title' => 'Anggota',
                'Data' => $user->leader->team->members->pluck('name')->implode(', '),
            ],
            [
                'Title' => 'Pendamping',
                'Data' => $user->leader->team->companion->name ?? '-',
            ],
            [
                'Title' => 'Status Pembayaran',
                'Data' => $user->leader->team->payment->status,
            ],
            [
                'Title' => 'Metode Pembayaran',
                'Data' => $user->leader->team->payment->method->name,
            ],
            [
                'Title' => 'Nomor Pembayaran',
                'Data' => $user->leader->team->payment->method->number,
            ],
            [
                'Title' => 'Nama Pemilik',
                'Data' => $user->leader->team->payment->method->owner,
            ],
            [
                'Title' => 'Bukti Pembayaran',
                'Data' => $user->leader->team->payment->proof,
            ],
            [
                'Title' => 'Grup WhatsApp',
                'Data' => $user->leader->team->competition->whatsapp_group,
            ],
        ]);
    }
}
