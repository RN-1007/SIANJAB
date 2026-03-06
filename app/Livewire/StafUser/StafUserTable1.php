<?php

namespace App\Livewire\StafUser;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\DataDetailUraianTugasStaf;
use App\Models\RincianTugasStaf;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class StafUserTable1 extends Component
{
    public $jabatanStafId;
    public $dataUraianTugas = [];
    public $dataStaf, $dataTusi;
    public $selectedId;
    public $uraian_tugas_staf, $abk_ideal, $abk_berlebih, $nama_jabatan_permempan_45,
        $nama_jabatan_permempan_41, $data_pendukung_2024, $data_pendukung, $catatan_mahasiswa;
    public $deleteId, $deleteName, $deleteUraianTugasStaf, $deleteAbkIdeal, $deleteAbkBerlebih,
        $deleteNamaJabatanPermempan45, $deleteNamaJabatanPermempan41, $deleteDataPendukung2024,
        $deleteDataPendukung, $deleteCatatanMahasiswa;
    public $tusiMap = [];

    // PROPERTIES UNTUK MODAL RINCIAN
    public $selectedRincianId = null;
    public $rincianTugas = null;
    public $showRincianModal = false;

    // TAMBAHKAN LOADING STATES
    public $loadingModalId = null;
    public $loadingType = '';
    public $loadingRincianId = null; // Loading untuk rincian
    public $loadingEditId = null; // Loading untuk edit
    public $loadingDeleteId = null; // Loading untuk delete

    public array $form = [
        'uraian_tugas_staf' => '',
        'hasil_kerja' => '',
        'satuan_hasil' => '',
        'target' => '',
        'frekuensi' => '',
        'waktu_penyelesaian' => '',
    ];

    protected $rules = [
        'form.uraian_tugas_staf' => 'required|string|max:255',
        'form.hasil_kerja' => 'required|string|max:255',
        'form.satuan_hasil' => 'required|string|max:50',
        'form.target' => 'required|numeric',
        'form.frekuensi' => 'required|numeric',
        'form.waktu_penyelesaian' => 'required|numeric|max:330',
    ];

    public function mount($jabatanStafId = null)
    {
        $this->jabatanStafId = $jabatanStafId;
    }

    public function openDataPendukungModal($uraianTugasId, $type = 'upload', $targetColumn = 'data_pendukung')
    {
        try {
            // Set loading state
            $this->loadingModalId = $uraianTugasId;
            $this->loadingType = $targetColumn;

            // Log untuk debugging
            logger('Opening modal', [
                'uraianTugasId' => $uraianTugasId,
                'type' => $type,
                'targetColumn' => $targetColumn
            ]);

            // Dispatch ke modal component dengan parameter yang benar
            $this->dispatch(
                'showStafDataPendukungModal',
                $uraianTugasId,      // Parameter 1: uraianTugasId
                $type,               // Parameter 2: type  
                $targetColumn        // Parameter 3: targetColumn
            );

            logger('Modal dispatch sent successfully');
        } catch (\Exception $e) {
            // Handle error
            logger('Modal error: ' . $e->getMessage());
            session()->flash('error', 'Gagal membuka modal: ' . $e->getMessage());
        } finally {
            // Reset loading state setelah selesai
            $this->loadingModalId = null;
            $this->loadingType = '';
        }
    }

    // METHOD UNTUK MEMBUKA MODAL RINCIAN
    public function showRincianTugas($uraianTugasStafId)
    {
        try {
            // Set loading state
            $this->loadingRincianId = $uraianTugasStafId;

            logger('Opening Rincian Modal for ID: ' . $uraianTugasStafId);

            // Cari rincian tugas berdasarkan detail_uraian_tugas_staf_id
            $this->rincianTugas = RincianTugasStaf::where('detail_uraian_tugas_staf_id', $uraianTugasStafId)->first();
            $this->selectedRincianId = $uraianTugasStafId;

            if ($this->rincianTugas) {
                logger('Rincian found:', $this->rincianTugas->toArray());
                $this->dispatch('showRincianTugasModal');
            } else {
                logger('No rincian found for ID: ' . $uraianTugasStafId);
                // Bisa tampilkan pesan bahwa belum ada rincian
                session()->flash('info', 'Belum ada rincian tugas untuk uraian tugas ini.');
                $this->dispatch('showRincianTugasModal'); // Tetap buka modal meskipun kosong
            }
        } catch (\Exception $e) {
            logger('Error opening rincian modal: ' . $e->getMessage());
            session()->flash('error', 'Gagal membuka detail rincian tugas.');
        } finally {
            // Reset loading state
            $this->loadingRincianId = null;
        }
    }

    // METHOD UNTUK MENUTUP MODAL RINCIAN
    public function closeRincianModal()
    {
        $this->rincianTugas = null;
        $this->selectedRincianId = null;
        $this->showRincianModal = false;
    }

    #[On('stafDataUpdated')]
    public function refreshData()
    {
        // Reset loading state
        $this->loadingModalId = null;
        $this->loadingType = '';

        // Refresh component data jika diperlukan
        $this->mount($this->jabatanStafId);

        logger('Data refreshed successfully');
    }

    // Event listener untuk refresh khusus table1 dari auto status update
    #[On('refreshTable1')]
    public function refreshTable1()
    {
        $this->mount($this->jabatanStafId);
        logger('Table1 specifically refreshed after status update');
    }

    // Event listener ketika data pindah dari table2 ke table1
    #[On('dataMovedToTable1')]
    public function handleDataMoved($uraianTugasId)
    {
        $this->refreshTable1();

        // Optional: Show notification bahwa data sudah pindah
        $this->dispatch('show-success-modal', [
            'title' => 'Data Dipindahkan!',
            'message' => 'Data uraian tugas sudah pindah ke tabel "Sudah Lengkap" karena sudah memiliki data pendukung.'
        ]);

        logger('Data moved to Table1 for ID: ' . $uraianTugasId);
    }

    public function render()
    {
        if ($this->jabatanStafId) {
            // PERBAIKAN: Menambahkan relasi yang lebih lengkap untuk mengambil data dari TugasDanFungsi
            $this->dataUraianTugas = DataDetailUraianTugasStaf::with([
                'uraianTugas.tusi',  // Relasi ke TugasDanFungsi
                'uraianTugas.dataUraianTugasStaf',
                'rincianTugas'
            ])
                ->whereHas('uraianTugas.dataUraianTugasStaf', function ($query) {
                    $query->where('id_user', $this->jabatanStafId);
                })
                ->where('status', '=', 'sudah')
                ->join('uraian_tugas_dan_tusis', 'data_detail_uraian_tugas_stafs.id_uraian_tugas_tusi', '=', 'uraian_tugas_dan_tusis.id')
                ->join('tugas_dan_fungsis', 'uraian_tugas_dan_tusis.id_tusi', '=', 'tugas_dan_fungsis.id') // JOIN ke tabel tugas_dan_fungsis
                ->leftJoin('rincian_tugas_staf', 'data_detail_uraian_tugas_stafs.id', '=', 'rincian_tugas_staf.detail_uraian_tugas_staf_id')
                ->select(
                    'data_detail_uraian_tugas_stafs.*',
                    'tugas_dan_fungsis.nama_jabatan_permempan_45 as tusi_nama_jabatan_permempan_45', // Ambil dari tugas_dan_fungsis
                    'tugas_dan_fungsis.nama_jabatan_permempan_41 as tusi_nama_jabatan_permempan_41'  // Ambil dari tugas_dan_fungsis
                )
                ->orderByDesc(
                    RincianTugasStaf::selectRaw('MAX(rincian_tugas_staf.updated_at)')
                        ->from('rincian_tugas_staf')
                        ->join('data_detail_uraian_tugas_stafs', 'rincian_tugas_staf.detail_uraian_tugas_staf_id', '=', 'data_detail_uraian_tugas_stafs.id')
                        ->join('uraian_tugas_dan_tusis as sub_utdt', 'data_detail_uraian_tugas_stafs.id_uraian_tugas_tusi', '=', 'sub_utdt.id')
                        ->whereColumn('sub_utdt.id_tusi', 'uraian_tugas_dan_tusis.id_tusi')
                )
                ->orderByDesc('rincian_tugas_staf.updated_at')
                ->get();
        } else {
            $this->dataUraianTugas = collect();
        }

        return view('livewire.staf-user.staf-user-table1', [
            'dataUraianTugasValid' => $this->dataUraianTugas
        ]);
    }

    public function resetInputFields()
    {
        $this->reset(['selectedId', 'form']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetDeleteState()
    {
        $this->reset([
            'deleteId',
            'deleteUraianTugasStaf',
            'deleteAbkIdeal',
            'deleteAbkBerlebih',
            'deleteNamaJabatanPermempan45',
            'deleteNamaJabatanPermempan41',
            'deleteDataPendukung2024',
            'deleteDataPendukung',
            'deleteCatatanMahasiswa',
            'loadingDeleteId'
        ]);
    }

    /**
     * Memetakan nilai frekuensi string ke nilai numerik.
     */
    private function mapFrekuensiToNumeric($frekuensi)
    {
        if (is_numeric($frekuensi)) {
            return $frekuensi;
        }

        $map = [
            'tahunan' => '1',
            'semesteran' => '2',
            'caturwulanan' => '3',
            'triwulanan' => '4',
            'dwi bulan' => '6',
            'bulanan' => '12',
            'mingguan' => '52',
            '5 hari kerja' => '235',
            '6 hari kerja' => '287',
            'setiap hari' => '365',
        ];

        $normalizedFrekuensi = strtolower(trim($frekuensi));
        return $map[$normalizedFrekuensi] ?? '';
    }

    public function edit($id)
    {
        try {
            $this->loadingEditId = $id;
            $this->resetInputFields();

            $data = DataDetailUraianTugasStaf::with('rincianTugas')->findOrFail($id);
            $this->selectedId = $id;

            $frekuensiValue = optional($data->rincianTugas)->frekuensi;

            $this->form = [
                'uraian_tugas_staf' => $data->uraian_tugas_staf,
                'hasil_kerja' => optional($data->rincianTugas)->hasil_kerja,
                'satuan_hasil' => optional($data->rincianTugas)->satuan_hasil,
                'target' => optional($data->rincianTugas)->target,
                'frekuensi' => $this->mapFrekuensiToNumeric($frekuensiValue),
                'waktu_penyelesaian' => optional($data->rincianTugas)->waktu_penyelesaian,
                'catatan_mahasiswa' => $data->catatan_mahasiswa,
            ];

            $this->dispatch('showEditModal');
        } catch (\Exception $e) {
            logger('Error in edit: ' . $e->getMessage());
            session()->flash('error', 'Gagal memuat data untuk diedit.');
        } finally {
            $this->loadingEditId = null;
        }
    }

    public function update()
    {
        $this->validate();

        if ($this->selectedId) {
            $staf = DataDetailUraianTugasStaf::find($this->selectedId);
            if ($staf) {
                $volume = $this->form['target'] * $this->form['frekuensi'];
                $beban_ideal = round(($volume * $this->form['waktu_penyelesaian'] / 75000), 2);
                $beban_berlebih = round(($volume * $this->form['waktu_penyelesaian'] / 103448), 2);

                $staf->update([
                    'uraian_tugas_staf' => $this->form['uraian_tugas_staf'],
                    'abk_ideal' => $beban_ideal,
                    'abk_berlebih' => $beban_berlebih,
                ]);

                $staf->rincianTugas()->updateOrCreate(
                    ['detail_uraian_tugas_staf_id' => $staf->id],
                    [
                        'hasil_kerja' => $this->form['hasil_kerja'],
                        'satuan_hasil' => $this->form['satuan_hasil'],
                        'target' => $this->form['target'],
                        'frekuensi' => $this->form['frekuensi'],
                        'volume' => $volume,
                        'waktu_penyelesaian' => $this->form['waktu_penyelesaian'],
                    ]
                );
            }

            session()->flash('message', 'Data berhasil diperbarui.');
            $this->resetInputFields();
            $this->dispatch('hideEditModal');
        }
    }

    public function confirmDelete($id)
    {
        try {
            // Set loading state
            $this->loadingDeleteId = $id;

            // Reset delete state sebelum mengisi data baru
            $this->resetDeleteState();

            $skpd = DataDetailUraianTugasStaf::find($id);
            if ($skpd) {
                $this->deleteId = $skpd->id;
                $this->deleteUraianTugasStaf = $skpd->uraian_tugas_staf;
                $this->deleteAbkIdeal = $skpd->abk_ideal;
                $this->deleteAbkBerlebih = $skpd->abk_berlebih;
                $this->deleteNamaJabatanPermempan45 = $skpd->nama_jabatan_permempan_45;
                $this->deleteNamaJabatanPermempan41 = $skpd->nama_jabatan_permenpan_41;
                $this->deleteDataPendukung2024 = $skpd->data_pendukung_2024;
                $this->deleteDataPendukung = $skpd->data_pendukung;
                $this->deleteCatatanMahasiswa = $skpd->catatan_mahasiswa;
                $this->dispatch('showDeleteModal');
            } else {
                session()->flash('message', 'Data tidak ditemukan.');
            }
        } catch (\Exception $e) {
            logger('Error in confirmDelete: ' . $e->getMessage());
            session()->flash('error', 'Gagal memuat data untuk dihapus.');
        } finally {
            // Reset loading state
            $this->loadingDeleteId = null;
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            DataDetailUraianTugasStaf::find($this->deleteId)->delete();
            session()->flash('message', 'Data berhasil dihapus.');
            $this->resetDeleteState();
            $this->dispatch('hideDeleteModal');
        }
    }
}
