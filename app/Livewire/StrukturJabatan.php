<?php

namespace App\Livewire;

use App\Models\StrukturJabatan as StrukturJabatanModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.app')]
class StrukturJabatan extends Component
{

    public function mount()
    {
        Log::info('StrukturJabatan component mounted');
    }

    public function render()
    {
        Log::info('StrukturJabatan component rendering');

        $allJabatans = StrukturJabatanModel::with('dataPd')
            ->orderBy('id_pd')
            ->orderByRaw("
                parent_id IS NULL DESC,
                
                CASE
                    WHEN parent_id IS NULL THEN
                        CASE
                            WHEN tipe_jabatan = 'Pimpinan Tinggi' THEN 1
                            WHEN tipe_jabatan = 'Jabatan Fungsional' THEN 3
                            WHEN tipe_jabatan = 'Staf Ahli' THEN 3
                            ELSE 2
                        END
                    ELSE NULL
                END ASC,

                CASE
                    WHEN parent_id IS NOT NULL THEN
                        CASE
                            WHEN tipe_jabatan = 'Nomenklatur Jabatan' THEN 1
                            WHEN tipe_jabatan = 'Kepala' THEN 2
                            WHEN tipe_jabatan = 'Sub Kepala' THEN 3
                            ELSE 4
                        END
                    ELSE NULL
                END ASC,
                
                parent_id ASC,
                id ASC
            ")
            ->get();

        $groupedByPd = $allJabatans->groupBy('dataPd.nama_pd');

        $structuredData = collect();

        foreach ($groupedByPd as $pdName => $jabatans) {
            $hierarchy = $this->buildHierarchy($jabatans);
            $structuredData->put($pdName, $this->flattenHierarchy($hierarchy));
        }

        return view('livewire.struktur-jabatan.index', [
            'structuredData' => $structuredData
        ]);
    }

    #[On('jabatan-created')]
    public function refreshTabel()
    {
        Log::info('🔄 refreshTabel() dipanggil! Event jabatan-created diterima dari komponen lain');

        // Dispatch event ke JavaScript
        $this->dispatch('refresh-struktur-jabatan-table');
        Log::info('✅ Event refresh-struktur-jabatan-table di-dispatch ke JavaScript');

    }

    private function buildHierarchy($jabatans, $parentId = null)
    {
        $branch = collect();

        $jabatans->where('parent_id', $parentId)->each(function ($jabatan) use ($jabatans, &$branch) {
            $children = $this->buildHierarchy($jabatans, $jabatan->id);
            if ($children->isNotEmpty()) {
                $jabatan->children = $children;
            }
            $branch->push($jabatan);
        });

        return $branch;
    }

    private function flattenHierarchy($hierarchy, $level = 0)
    {
        $result = collect();
        foreach ($hierarchy as $item) {
            $item->level = $level;
            $result->push($item);
            if (isset($item->children)) {
                $result = $result->merge($this->flattenHierarchy($item->children, $level + 1));
            }
            unset($item->children);
        }
        return $result;
    }
}
