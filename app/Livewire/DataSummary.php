<?php

namespace App\Livewire;

use App\Models\DataPd;
use App\Models\StrukturJabatan;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class DataSummary extends Component
{
    public DataPd $skpd;
    public Collection $flattenedHierarchy;
    public array $totals = [];

    public function mount(DataPd $skpd)
    {
        if (auth()->user()->role !== 'admin') {
            auth()->logout();
            $this->redirect(route('login'), navigate: true);
            return;
        }

        $this->skpd = $skpd;

        $jabatans = StrukturJabatan::where('id_pd', $this->skpd->id)
            ->with(['users.uraianTugasStaf.semuaDetailTugas'])
            ->get();

        $hierarchy = $this->buildHierarchy($jabatans);
        $this->calculateNodeTotals($hierarchy);
        $this->totals = $this->sumTotals($hierarchy);

        // Mengubah data hierarki menjadi daftar datar untuk ditampilkan di view
        $this->flattenedHierarchy = $this->flattenHierarchyWithUsers($hierarchy);
    }

    private function buildHierarchy(Collection $elements, $parentId = null): Collection
    {
        $branch = new Collection();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildHierarchy($elements, $element->id);
                if ($children->isNotEmpty()) {
                    $element->children = $children;
                }
                $branch->add($element);
            }
        }
        return $branch;
    }

    private function calculateNodeTotals(Collection $nodes)
    {
        foreach ($nodes as $node) {
            $nodeTotals = [
                'kelas_jabatan' => 0, 'abk_ideal' => 0, 'pemenuhan_pegawai' => 0,
                'pns' => 0, 'cpns' => 0, 'pppk' => 0, 'non_pns' => 0, 'jumlah_eksisting' => 0
            ];

            foreach ($node->users as $user) {
                if ($uraian = $user->uraianTugasStaf) {
                    $nodeTotals['kelas_jabatan'] += $uraian->kelas_jabatan;
                    $nodeTotals['abk_ideal'] += $uraian->semuaDetailTugas->sum('abk_ideal');
                    $nodeTotals['pemenuhan_pegawai'] += $uraian->pemenuhan_pegawai;
                    $nodeTotals['pns'] += $uraian->pns;
                    $nodeTotals['cpns'] += $uraian->cpns;
                    $nodeTotals['pppk'] += $uraian->pppk;
                    $nodeTotals['non_pns'] += $uraian->non_pns;
                    $nodeTotals['jumlah_eksisting'] += $uraian->jumlah_eksisting;
                }
            }

            if (isset($node->children)) {
                $this->calculateNodeTotals($node->children);
                $childrenTotals = $this->sumTotals($node->children);
                foreach ($nodeTotals as $key => $value) {
                    $nodeTotals[$key] += $childrenTotals[$key];
                }
            }
            $node->totals = $nodeTotals;
        }
    }

    private function sumTotals(Collection $nodes): array
    {
        $grandTotal = [
            'kelas_jabatan' => 0, 'abk_ideal' => 0, 'pemenuhan_pegawai' => 0,
            'pns' => 0, 'cpns' => 0, 'pppk' => 0, 'non_pns' => 0, 'jumlah_eksisting' => 0
        ];
        foreach ($nodes as $node) {
            foreach ($grandTotal as $key => $value) {
                $grandTotal[$key] += $node->totals[$key];
            }
        }
        return $grandTotal;
    }

    /**
     * Mengubah hierarki pohon menjadi daftar datar (flat list)
     * sambil menyisipkan data user di bawah jabatan induknya.
     */
    private function flattenHierarchyWithUsers($nodes, $level = 0): Collection
    {
        $result = new Collection();

        foreach ($nodes as $node) { 
            $node->level = $level;
            $node->type = 'jabatan';
            $result->push($node);

            foreach ($node->users as $user) {
                $user->level = $level + 1;
                $user->type = 'user';
                
                $user->parent_id = $node->id; 
                
                $result->push($user);
            }

            if (isset($node->children)) {
                $result = $result->merge($this->flattenHierarchyWithUsers($node->children, $level + 1));
            }
        }
        return $result;
    }

    public function render()
    {
        return view('livewire.data-summary');
    }
}