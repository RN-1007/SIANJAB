<?php

namespace App\Livewire\DashboardConten;

use App\Models\DataPd;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class DataSummary extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;

    public function render()
    {
        $skpds = DataPd::with(['strukturJabatans' => function ($query) {
                $query->where('tipe_jabatan', 'Nomenklatur Jabatan');
            }])
            ->paginate($this->perPage);

        return view('livewire.dashboard-conten.data-summary', [
            'skpds' => $skpds,
        ]);
    }
}
