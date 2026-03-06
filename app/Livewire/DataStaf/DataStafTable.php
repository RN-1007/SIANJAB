<?php

namespace App\Livewire\DataStaf;

use App\Models\DataPd;
use App\Models\StrukturJabatan;
use App\Models\DataUraianTugasStaf; // Pastikan model ini di import
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class DataStafTable extends Component
{
    use WithPagination;

    // PERBAIKAN 1: Set tema pagination ke bootstrap agar sesuai AdminLTE
    protected $paginationTheme = 'bootstrap';

    public $selectedSkpd = null;
    public ?DataPd $skpdObject = null;
    public $search = '';

    public function mount()
    {
        $this->dispatch('skpd-updated', skpdId: $this->selectedSkpd);
    }

    #[On('data-updated')]
    public function refreshTable()
    {
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('skpdSelected')]
    public function skpdSelected($skpd)
    {
        $this->selectedSkpd = $skpd;
        $this->reset('search');
        $this->resetPage();

        if (!empty($skpd)) {
            $this->skpdObject = DataPd::find($skpd);
        } else {
            $this->skpdObject = null;
        }

        $this->dispatch('skpd-updated', skpdId: $this->selectedSkpd);
    }

    public function render()
    {
        $datastafutamas = [];
        // Inisialisasi array untuk Grand Total
        $grandTotalData = [
            'abk_ideal' => 0,
            'abk_berlebih' => 0,
            'pemenuhan_pegawai' => 0,
            'jumlah_eksisting' => 0,
            'uraian_tugas_belum_verif' => 0
        ];

        if (!empty($this->selectedSkpd)) {
            $query = StrukturJabatan::query()
                ->whereIn('tipe_jabatan', [
                    'Kepala', 
                    'Sub Kepala', 
                    'Staf Ahli', 
                    'Jabatan Fungsional'
                ])
                ->where('id_pd', $this->selectedSkpd)
                ->with([
                    'users' => function ($query) {
                        $query->where('role', 'user');
                    },
                    // Eager load relasi lebih dalam untuk efisiensi
                    'users.uraianTugasStaf.semuaDetailTugas' 
                ]);

            if (!empty($this->search)) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama_jabatan', 'like', $searchTerm)
                        ->orWhereHas('users', function ($userQuery) use ($searchTerm) {
                            $userQuery->where('role', 'user')->where('jabatan', 'like', $searchTerm);
                        });
                });
            }

            // PERBAIKAN 2: Hitung Grand Total SEBELUM Pagination
            // Kita ambil ID User yang relevan dengan filter SKPD & Search saat ini
            // agar totalnya akurat sesuai filter.
            $allRelevantUsers = (clone $query)->get()->pluck('users')->flatten();
            
            foreach ($allRelevantUsers as $user) {
                if ($user->uraianTugasStaf) {
                    $grandTotalData['pemenuhan_pegawai'] += $user->uraianTugasStaf->pemenuhan_pegawai;
                    $grandTotalData['jumlah_eksisting'] += $user->uraianTugasStaf->jumlah_eksisting;
                    
                    // Hitung detail tugas
                    $details = $user->uraianTugasStaf->semuaDetailTugas;
                    $grandTotalData['abk_ideal'] += $details->sum('abk_ideal');
                    $grandTotalData['abk_berlebih'] += $details->sum('abk_berlebih');
                    $grandTotalData['uraian_tugas_belum_verif'] += $details->where('status', 'belum')->count();
                }
            }

            // Lakukan Pagination
            $paginator = $query->paginate(10);

            // Mapping data untuk tampilan
            foreach ($paginator as $indukJabatan) {
                $indukJabatan->nomenklatur_jabatan_struktural = $indukJabatan->nama_jabatan;
                $indukJabatan->jabatanStaf = $indukJabatan->users;
            }

            $datastafutamas = $paginator;

        } else {
            $datastafutamas = StrukturJabatan::where('id', 0)->paginate(10);
        }

        $dataskpd = DataPd::all();

        return view('livewire.data-staf.data-staf-table', [
            'datastafutamas' => $datastafutamas,
            'dataskpd' => $dataskpd,
            'grandTotalData' => $grandTotalData, // Kirim data total ke view
        ]);
    }
}