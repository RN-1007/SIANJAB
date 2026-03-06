<?php

namespace App\Livewire\StafUser;

use Livewire\Component;
use App\Models\DataDetailUraianTugasStaf;
use App\Models\DataUraianTugasStaf;
use App\Models\RincianTugasStaf;
use App\Models\TugasDanFungsi;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class StafUserTable2 extends Component
{
    public $jabatanStafId;
    public $dataUraianTugas = [];
    public $rincianTugas = null;
    public $expandedRow = null;
    public $selectedId;

    // FITUR CHECKBOX - Properties untuk multiple selection
    public $selectedItems = [];
    public $selectAll = false;

    // Properties untuk edit/delete - DIPISAH DARI TABLE1
    public $deleteId2, $deleteName2, $deleteUraianTugasStaf2, $deleteAbkIdeal2, $deleteAbkBerlebih2,
        $deleteNamaJabatanPermempan452, $deleteNamaJabatanPermempan412, $deleteDataPendukung20242,
        $deleteDataPendukung2, $deleteCatatanMahasiswa2;

    // TAMBAHKAN LOADING STATES seperti di Table1
    public $loadingModalId = null;
    public $loadingType = '';
    public $selectedRincianId = null;
    public $loadingRincianId = null; // Loading untuk rincian
    public $loadingEditId = null; // Loading untuk edit
    public $loadingDeleteId = null; // Loading untuk delete
    public $loadingSubmit = false; // Loading untuk submit checkbox

    public array $form2 = [
        'uraian_tugas_staf' => '',
        'hasil_kerja' => '',
        'satuan_hasil' => '',
        'target' => '',
        'frekuensi' => '',
        'waktu_penyelesaian' => '',
        'catatan_mahasiswa' => '',
    ];

    // Rules untuk Form 2
    protected function rules()
    {
        return [
            'form2.uraian_tugas_staf' => 'required|string|max:255',
            'form2.hasil_kerja' => 'required|string|max:255',
            'form2.satuan_hasil' => 'required|string|max:50',
            'form2.target' => 'required|numeric',
            'form2.frekuensi' => 'required|numeric',
            'form2.waktu_penyelesaian' => 'required|numeric|max:330',
        ];
    }

    public function mount($jabatanStafId = null)
    {
        $this->jabatanStafId = $jabatanStafId;
        $this->selectedItems = [];
        $this->selectAll = false;
    }

    // HAPUS - Method toggleItemSelection tidak diperlukan lagi
    // Karena kita hanya menggunakan wire:model.live

    // Helper method untuk update status selectAll
    private function updateSelectAllStatus()
    {
        $totalItems = $this->dataUraianTugas->count();
        $selectedCount = count($this->selectedItems);

        if ($selectedCount === 0) {
            $this->selectAll = false;
        } elseif ($selectedCount === $totalItems && $totalItems > 0) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false; // Partial selection
        }
    }


    // FITUR CHECKBOX - Method untuk clear selection
    public function clearSelection()
    {
        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('selectionUpdated', 0);

        logger('Selection cleared');
    }

    // PERBAIKAN UTAMA - Method untuk submit selected items
    public function submitSelectedItems()
    {
        // Validasi apakah ada item yang dipilih
        if (empty($this->selectedItems)) {
            session()->flash('error', 'Tidak ada item yang dipilih.');
            return;
        }

        // Set loading state
        $this->loadingSubmit = true;

        try {
            DB::beginTransaction();

            // Log untuk debugging
            logger('Starting submitSelectedItems', [
                'selectedItems' => $this->selectedItems,
                'jabatanStafId' => $this->jabatanStafId
            ]);

            // Update status dari 'belum' ke 'sudah' untuk item yang dipilih
            $updatedCount = DataDetailUraianTugasStaf::whereIn('id', $this->selectedItems)
                ->where('status', 'belum')
                ->update(['status' => 'sudah']);

            DB::commit();

            logger('Status update completed', [
                'updatedCount' => $updatedCount,
                'selectedItemsCount' => count($this->selectedItems)
            ]);

            // Reset selection setelah berhasil
            $this->selectedItems = [];
            $this->selectAll = false;

            // Dispatch events untuk refresh kedua tabel
            $this->dispatch('refreshTable1'); // Refresh tabel data lengkap
            $this->dispatch('stafDataUpdated'); // Refresh tabel saat ini

            // Flash message sukses
            session()->flash('success', "Berhasil memindahkan {$updatedCount} data ke tabel data lengkap.");
        } catch (\Exception $e) {
            DB::rollBack();

            logger('Error in submitSelectedItems', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Gagal memindahkan data: ' . $e->getMessage());
        } finally {
            // Reset loading state
            $this->loadingSubmit = false;
        }
    }

    // HAPUS - Method toggleSelectAll tidak diperlukan lagi karena menggunakan wire:model.live

    // TAMBAHAN - Method untuk handle wire:model.live pada selectAll
    public function updatedSelectAll($value)
    {
        $allIds = $this->dataUraianTugas->pluck('id')->map(fn($id) => (string) $id)->toArray();

        if ($value) {
            // Jika checkbox utama dicentang, isi selectedItems dengan semua ID
            $this->selectedItems = $allIds;
        } else {
            // Jika centang dihilangkan, kosongkan selectedItems
            $this->selectedItems = [];
        }

        $this->dispatch('selectionUpdated', count($this->selectedItems));

        logger('Select all updated via wire:model', [
            'value' => $value,
            'selectedCount' => count($this->selectedItems),
            'selectedItems' => $this->selectedItems
        ]);
    }

    // PERBAIKAN - Pastikan lifecycle hook berfungsi untuk selectedItems
    public function updatedSelectedItems()
    {
        // Filter item yang valid dan konversi ke string
        $this->selectedItems = array_values(array_unique(array_filter(
            array_map('strval', $this->selectedItems)
        )));

        // Update status selectAll berdasarkan selectedItems saat ini
        $this->updateSelectAllStatus();

        // Dispatch event untuk update UI
        $this->dispatch('selectionUpdated', count($this->selectedItems));

        logger('Selected items updated via wire:model', [
            'selectedItems' => $this->selectedItems,
            'selectedCount' => count($this->selectedItems),
            'totalItems' => $this->dataUraianTugas->count(),
            'selectAll' => $this->selectAll
        ]);
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

    public function resetInputFields2()
    {
        $this->reset(['selectedId', 'form2']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetDeleteState2()
    {
        $this->reset([
            'deleteId2',
            'deleteUraianTugasStaf2',
            'deleteAbkIdeal2',
            'deleteAbkBerlebih2',
            'deleteNamaJabatanPermempan452',
            'deleteNamaJabatanPermempan412',
            'deleteDataPendukung20242',
            'deleteDataPendukung2',
            'deleteCatatanMahasiswa2',
            'loadingDeleteId'
        ]);
    }

    #[On('stafDataUpdated')]
    public function refreshData()
    {
        // Reset loading state
        $this->loadingModalId = null;
        $this->loadingType = '';

        // Clear selection setelah refresh - DIPERBAIKI
        $this->selectedItems = [];
        $this->selectAll = false;

        // Refresh component data jika diperlukan
        $this->mount($this->jabatanStafId);

        logger('Table2 data refreshed successfully');
    }

    // Listen untuk auto-check status setelah data pendukung diupdate
    #[On('checkStatusAfterUpload')]
    public function handleStatusCheck($uraianTugasId)
    {
        $this->checkAndUpdateStatus($uraianTugasId);
    }

    #[On('refreshTable2')]
    public function handleRefreshTable2()
    {
        $this->refreshData();
    }

    public function render()
    {
        if ($this->jabatanStafId) {
            $this->dataUraianTugas = DataDetailUraianTugasStaf::with([
                'uraianTugas.tusi',
                'uraianTugas.dataUraianTugasStaf',
                'rincianTugas'
            ])
                ->whereHas('uraianTugas.dataUraianTugasStaf', fn($query) => $query->where('id_user', $this->jabatanStafId))
                ->where('status', '=', 'belum')
                ->join('uraian_tugas_dan_tusis', 'data_detail_uraian_tugas_stafs.id_uraian_tugas_tusi', '=', 'uraian_tugas_dan_tusis.id')
                ->join('tugas_dan_fungsis', 'uraian_tugas_dan_tusis.id_tusi', '=', 'tugas_dan_fungsis.id')
                ->leftJoin('rincian_tugas_staf', 'data_detail_uraian_tugas_stafs.id', '=', 'rincian_tugas_staf.detail_uraian_tugas_staf_id')
                ->select('data_detail_uraian_tugas_stafs.*', 'tugas_dan_fungsis.nama_jabatan_permempan_45 as tusi_nama_jabatan_permempan_45', 'tugas_dan_fungsis.nama_jabatan_permempan_41 as tusi_nama_jabatan_permempan_41')
                ->orderByDesc(
                    RincianTugasStaf::selectRaw('MAX(rincian_tugas_staf.updated_at)')->from('rincian_tugas_staf')
                        ->join('data_detail_uraian_tugas_stafs as uts_inner', 'rincian_tugas_staf.detail_uraian_tugas_staf_id', '=', 'uts_inner.id')
                        ->join('uraian_tugas_dan_tusis as utdt_inner', 'uts_inner.id_uraian_tugas_tusi', '=', 'utdt_inner.id')
                        ->whereColumn('utdt_inner.id_tusi', 'uraian_tugas_dan_tusis.id_tusi')
                )
                ->orderByDesc('rincian_tugas_staf.updated_at')
                ->get();
        } else {
            $this->dataUraianTugas = collect();
        }

        return view('livewire.staf-user.staf-user-table2', [
            'dataUraianTugasValid' => $this->dataUraianTugas
        ]);
    }

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
                // PERBAIKAN: Menggunakan event yang konsisten 'showRincianTugasModal'
                $this->dispatch('showRincianTugasModal');
            } else {
                logger('No rincian found for ID: ' . $uraianTugasStafId);
                session()->flash('info', 'Belum ada rincian tugas untuk uraian tugas ini.');
                // PERBAIKAN: Menggunakan event yang konsisten 'showRincianTugasModal'
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

    public function closeRincianModal()
    {
        $this->rincianTugas = null;
        $this->selectedRincianId = null;
        $this->showRincianModal = false;
    }

    // Method untuk auto update status ketika data pendukung diisi
    public function checkAndUpdateStatus($id)
    {
        try {
            $item = DataDetailUraianTugasStaf::findOrFail($id);

            // Cek apakah sudah ada data pendukung (salah satu atau keduanya)
            $hasDataPendukung = !empty($item->data_pendukung) || !empty($item->data_pendukung_sebelumnya);

            if ($hasDataPendukung && $item->status === 'belum') {
                // Update status menjadi 'sudah' otomatis
                $item->update(['status' => 'sudah']);

                logger('Status auto updated to "sudah" for ID: ' . $id);

                // Refresh kedua tabel
                $this->dispatch('stafDataUpdated');
                $this->dispatch('refreshTable1');

                return true;
            }

            return false;
        } catch (\Exception $e) {
            logger()->error('Error checking and updating status:', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);

            return false;
        }
    }

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

    public function edit2($id)
    {
        try {
            $this->loadingEditId = $id;

            // Reset form sebelum mengisi data baru
            $this->resetInputFields2();

            $data = DataDetailUraianTugasStaf::with('rincianTugas')->findOrFail($id);
            $this->selectedId = $id;

            $frekuensiValue = optional($data->rincianTugas)->frekuensi;

            $this->form2 = [
                'uraian_tugas_staf' => $data->uraian_tugas_staf,
                'hasil_kerja' => optional($data->rincianTugas)->hasil_kerja,
                'satuan_hasil' => optional($data->rincianTugas)->satuan_hasil,
                'target' => optional($data->rincianTugas)->target,
                'frekuensi' => $this->mapFrekuensiToNumeric($frekuensiValue),
                'waktu_penyelesaian' => optional($data->rincianTugas)->waktu_penyelesaian,
                'catatan_mahasiswa' => $data->catatan_mahasiswa,
            ];

            $this->dispatch('showEditModal2');
        } catch (\Exception $e) {
            logger('Error in edit2: ' . $e->getMessage());
            session()->flash('error', 'Gagal memuat data untuk diedit.');
        } finally {
            $this->loadingEditId = null;
        }
    }

    public function update2()
    {
        $this->validate();

        if ($this->selectedId) {
            $staf = DataDetailUraianTugasStaf::find($this->selectedId);
            if ($staf) {
                $volume = $this->form2['target'] * $this->form2['frekuensi'];
                $beban_ideal = round(($volume * $this->form2['waktu_penyelesaian'] / 75000), 2);
                $beban_berlebih = round(($volume * $this->form2['waktu_penyelesaian'] / 103448), 2);

                $staf->update([
                    'uraian_tugas_staf' => $this->form2['uraian_tugas_staf'],
                    'abk_ideal' => $beban_ideal,
                    'abk_berlebih' => $beban_berlebih,
                ]);

                $staf->rincianTugas()->updateOrCreate(
                    ['detail_uraian_tugas_staf_id' => $staf->id],
                    [
                        'hasil_kerja' => $this->form2['hasil_kerja'],
                        'satuan_hasil' => $this->form2['satuan_hasil'],
                        'target' => $this->form2['target'],
                        'frekuensi' => $this->form2['frekuensi'],
                        'volume' => $volume,
                        'waktu_penyelesaian' => $this->form2['waktu_penyelesaian'],
                    ]
                );
            }

            session()->flash('message', 'Data berhasil diperbarui.');
            $this->resetInputFields2();
            $this->dispatch('hideEditModal2');
        }
    }

    public function confirmDelete2($id)
    {
        try {
            // Set loading state
            $this->loadingDeleteId = $id;

            // Reset delete state sebelum mengisi data baru
            $this->resetDeleteState2();

            $skpd = DataDetailUraianTugasStaf::find($id);
            if ($skpd) {
                $this->deleteId2 = $skpd->id;
                $this->deleteUraianTugasStaf2 = $skpd->uraian_tugas_staf;
                $this->deleteAbkIdeal2 = $skpd->abk_ideal;
                $this->deleteAbkBerlebih2 = $skpd->abk_berlebih;
                $this->deleteNamaJabatanPermempan452 = $skpd->nama_jabatan_permempan_45;
                $this->deleteNamaJabatanPermempan412 = $skpd->nama_jabatan_permenpan_41;
                $this->deleteDataPendukung20242 = $skpd->data_pendukung_2024;
                $this->deleteDataPendukung2 = $skpd->data_pendukung;
                $this->deleteCatatanMahasiswa2 = $skpd->catatan_mahasiswa;
                $this->dispatch('showDeleteModal2'); // EVENT TERPISAH
            } else {
                session()->flash('message', 'Data tidak ditemukan.');
            }
        } catch (\Exception $e) {
            logger('Error in confirmDelete2: ' . $e->getMessage());
            session()->flash('error', 'Gagal memuat data untuk dihapus.');
        } finally {
            // Reset loading state
            $this->loadingDeleteId = null;
        }
    }

    public function destroy2()
    {
        if ($this->deleteId2) {
            DataDetailUraianTugasStaf::find($this->deleteId2)->delete();
            session()->flash('message', 'Data berhasil dihapus.');
            $this->resetDeleteState2();
            $this->dispatch('hideDeleteModal2'); // EVENT TERPISAH
        }
    }

    public function toggleRow($id)
    {
        $this->expandedRow = $this->expandedRow === $id ? null : $id;
    }
}
