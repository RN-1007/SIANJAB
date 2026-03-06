<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\DataDetailUraianTugasStaf;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class UraianTugasTable2 extends Component
{

    #[On('uraianTugasCreatedTable2')]
    public function refreshComponent()
    {
        // Tidak perlu menulis apa-apa di sini.
    }

    public function render()
    {
        $loggedInUserId = Auth::id();

        $dataUraianTugas = DataDetailUraianTugasStaf::with([
            'uraianTugas.tusi',
            'rincianTugas'
        ])
            ->whereHas('uraianTugas.dataUraianTugasStaf', function ($query) use ($loggedInUserId) {
                $query->where('id_user', $loggedInUserId);
            })
            ->where('status', 'belum')

            ->join('uraian_tugas_dan_tusis', 'data_detail_uraian_tugas_stafs.id_uraian_tugas_tusi', '=', 'uraian_tugas_dan_tusis.id')
            ->leftJoin('rincian_tugas_staf', 'data_detail_uraian_tugas_stafs.id', '=', 'rincian_tugas_staf.detail_uraian_tugas_staf_id')
            ->select('data_detail_uraian_tugas_stafs.*')
            ->orderBy('uraian_tugas_dan_tusis.id_tusi')
            ->orderByDesc('rincian_tugas_staf.updated_at')
            ->get();

        return view('livewire.uraian-tugas-user.uraian-tugas-table2', [
            'dataUraianTugasValid' => $dataUraianTugas,
        ]);
    }
}
