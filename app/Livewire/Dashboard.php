<?php

namespace App\Livewire;

use App\Models\DataDetailUraianTugasStaf;
use App\Models\DataUraianTugasStaf;
use App\Models\StrukturJabatan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use stdClass;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $search = '';

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }


    public function render()
    {
        $user = Auth::user();
        $datastafutamas = collect();
        $idPd = null;
        $viewData = [];
        $labels = [];

        if ($user->strukturJabatan) {
            $idPd = $user->strukturJabatan->id_pd;
        }
        // dd($idPd);

        $grandTotalData = [
            'abk_ideal' => 0,
            'abk_berlebih' => 0,
            'pemenuhan_pegawai' => 0,
            'jumlah_eksisting' => 0,
        ];

        if (in_array($user->role, ['user', 'kepala', 'subkepala'])) {
            $idPd = $user->strukturJabatan->id_pd ?? null;

            if ($idPd) {
                $datastafutamas = StrukturJabatan::query()
                    ->with([
                        'users' => function ($query) {
                            $query->where('role', 'user')
                                ->when($this->search, function ($q) {
                                    $q->where('jabatan', 'like', '%' . $this->search . '%');
                                })
                                ->with(['uraianTugasStaf.semuaDetailTugas']);
                        }
                    ])
                    ->whereHas('users', function ($query) {
                        $query->where('role', 'user')
                            ->when($this->search, function ($q) {
                                $q->where('jabatan', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->where('id_pd', $idPd)
                    ->paginate(2);

                $relevantUserIds = StrukturJabatan::where('id_pd', $idPd)
                    ->whereHas('users', fn($q) => $q->where('role', 'user'))
                    ->get()->pluck('users.*.id')->flatten();

                if ($relevantUserIds->isNotEmpty()) {
                    $grandTotalUraianTugas = DataUraianTugasStaf::whereIn('id_user', $relevantUserIds)->with('semuaDetailTugas')->get();

                    $grandTotalData['pemenuhan_pegawai'] = $grandTotalUraianTugas->sum('pemenuhan_pegawai');
                    $grandTotalData['jumlah_eksisting'] = $grandTotalUraianTugas->sum('jumlah_eksisting');
                    $grandTotalDetailTugas = $grandTotalUraianTugas->pluck('semuaDetailTugas')->flatten();
                    $grandTotalData['abk_ideal'] = $grandTotalDetailTugas->sum('abk_ideal');
                    $grandTotalData['abk_berlebih'] = $grandTotalDetailTugas->sum('abk_berlebih');
                }
            }
            $labels = [
                'card_title' => 'Data Kinerja Anda',
                'abk_ideal_label' => 'Beban Kerja Ideal',
                'abk_berlebih_label' => 'Beban Kerja Berlebih',
                'eej_label' => 'Efektivitas dan Efisiensi Jabatan',
                'prestasi_label' => 'Tingkat Prestasi Kerja Jabatan',
                'tugas_label' => 'Tugas Layanan Utama',
                'staf_card_title' => 'Staf Eksisting',
                'pns_label' => 'Staf Eksisting PNS',
                'pppk_label' => 'Staf Eksisting PPPK',
                'cpns_label' => 'Staf Eksisting CPNS',
                'non_pns_label' => 'Staf Eksisting non-PNS',
            ];

            $dataUraianTugas = $user->uraianTugasStaf;

            if ($dataUraianTugas) {
                $allDetailTugas = $dataUraianTugas->semuaDetailTugas;
                $abkIdeal = $allDetailTugas->sum('abk_ideal');
                $abkBerlebih = $allDetailTugas->sum('abk_berlebih');
                $jumlahEksisting = $dataUraianTugas->jumlah_eksisting;
                $tugasCount = $allDetailTugas->count();
                $eej = ($jumlahEksisting > 0) ? ($abkIdeal / $jumlahEksisting) : 0;

                if ($eej >= 1.25) $prestasi = ['teks' => 'A (Sangat Baik)', 'progress' => 95];
                elseif ($eej >= 1.0) $prestasi = ['teks' => 'B (Baik)', 'progress' => 85];
                elseif ($eej >= 0.75) $prestasi = ['teks' => 'C (Cukup)', 'progress' => 65];
                else $prestasi = ['teks' => 'D (Kurang)', 'progress' => 40];

                $data = new stdClass();
                $data->abk_ideal = $abkIdeal;
                $data->abk_berlebih = $abkBerlebih;
                $data->pns = $dataUraianTugas->pns;
                $data->pppk = $dataUraianTugas->pppk;
                $data->cpns = $dataUraianTugas->cpns;
                $data->non_pns = $dataUraianTugas->non_pns;

                $viewData = ['data' => $data, 'eej' => $eej, 'prestasi' => $prestasi, 'tugasCount' => $tugasCount];
            } else {
                $data = new stdClass();
                $data->abk_ideal = 0;
                $data->abk_berlebih = 0;
                $data->pns = 0;
                $data->pppk = 0;
                $data->cpns = 0;
                $data->non_pns = 0;

                $viewData = [
                    'data' => $data,
                    'eej' => 0,
                    'prestasi' => ['teks' => 'N/A', 'progress' => 0],
                    'tugasCount' => 0,
                ];
            }

            // dd($viewData);
            // dd($datastafutamas);
        } else {
            $labels = [
                'card_title' => 'Ringkasan Kinerja (Semua Staf)',
                'abk_ideal_label' => 'Rata-Rata Beban Kerja Ideal',
                'abk_berlebih_label' => 'Rata-Rata Beban Kerja Berlebih',
                'eej_label' => 'Rata-Rata Efektivitas & Efisiensi',
                'prestasi_label' => 'Tingkat Prestasi Rata-Rata',
                'tugas_label' => 'Total Tugas Layanan Utama',
                'staf_card_title' => 'Total Staf Eksisting',
                'pns_label' => 'Total Staf PNS',
                'pppk_label' => 'Total Staf PPPK',
                'cpns_label' => 'Total Staf CPNS',
                'non_pns_label' => 'Total Staf non-PNS',
            ];

            $allData = DataUraianTugasStaf::with('semuaDetailTugas')->get();
            if ($allData->isNotEmpty()) {
                $aggregatedData = new stdClass();

                $abkIdealTotalsPerStaf = $allData->map(function ($item) {
                    return $item->semuaDetailTugas->sum('abk_ideal');
                });

                $abkBerlebihTotalsPerStaf = $allData->map(function ($item) {
                    return $item->semuaDetailTugas->sum('abk_berlebih');
                });

                $aggregatedData->abk_ideal = $abkIdealTotalsPerStaf->avg();
                $aggregatedData->abk_berlebih = $abkBerlebihTotalsPerStaf->avg();

                $total_eej = 0;
                $valid_records_for_eej = 0;

                foreach ($allData as $index => $item) {
                    if ($item->jumlah_eksisting > 0) {
                        $currentAbkIdeal = $abkIdealTotalsPerStaf[$index];
                        $total_eej += ($currentAbkIdeal / $item->jumlah_eksisting);
                        $valid_records_for_eej++;
                    }
                }
                $avg_eej = ($valid_records_for_eej > 0) ? ($total_eej / $valid_records_for_eej) : 0;

                if ($avg_eej >= 1.25) $prestasi = ['teks' => 'A (Sangat Baik)', 'progress' => 95];
                elseif ($avg_eej >= 1.0) $prestasi = ['teks' => 'B (Baik)', 'progress' => 85];
                elseif ($avg_eej >= 0.75) $prestasi = ['teks' => 'C (Cukup)', 'progress' => 65];
                else $prestasi = ['teks' => 'D (Kurang)', 'progress' => 40];

                $tugasCount = DataDetailUraianTugasStaf::count();
                $aggregatedData->pns = $allData->sum('pns');
                $aggregatedData->pppk = $allData->sum('pppk');
                $aggregatedData->cpns = $allData->sum('cpns');
                $aggregatedData->non_pns = $allData->sum('non_pns');

                $viewData = [
                    'data' => $aggregatedData,
                    'eej' => $avg_eej,
                    'prestasi' => $prestasi,
                    'tugasCount' => $tugasCount,
                ];
            } else {
                $data = new stdClass();
                $data->abk_ideal = 0;
                $data->abk_berlebih = 0;
                $data->pns = 0;
                $data->pppk = 0;
                $data->cpns = 0;
                $data->non_pns = 0;
                $viewData = [
                    'data' => $data,
                    'eej' => 0,
                    'prestasi' => ['teks' => 'N/A', 'progress' => 0],
                    'tugasCount' => 0,
                ];
            }
        }
        return view('livewire.dashboard', array_merge($viewData, ['labels' => $labels], [
            'datastafutamas' => $datastafutamas,
            'grandTotalData' => $grandTotalData,
            'search' => $this->search,
        ]));
    }
}
