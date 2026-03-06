<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\DataDetailUraianTugasStaf;
use Livewire\Attributes\On;
use Livewire\Component;

class EditUraianTugasModal extends Component
{
    // Properti $show tidak lagi diperlukan
    public ?DataDetailUraianTugasStaf $uraianTugas = null;

    // Properti dari DataDetailUraianTugasStaf
    public $uraian_tugas_staf;
    public $abk_ideal;
    public $abk_berlebih;
    public $catatan_mahasiswa;

    // Properti dari RincianTugasStaf
    public $hasil_kerja;
    public $satuan_hasil;
    public $target;
    public $frekuensi;
    public $waktu_penyelesaian;

    #[On('openEditModal')]
    public function loadModal($uraianTugasId)
    {
        $this->reset();
        $this->uraianTugas = DataDetailUraianTugasStaf::with('rincianTugas')->find($uraianTugasId);

        if ($this->uraianTugas) {
            $this->uraian_tugas_staf = $this->uraianTugas->uraian_tugas_staf;
            $this->abk_ideal = $this->uraianTugas->abk_ideal;
            $this->abk_berlebih = $this->uraianTugas->abk_berlebih;
            $this->catatan_mahasiswa = $this->uraianTugas->catatan_mahasiswa;

            if ($this->uraianTugas->rincianTugas) {
                $this->hasil_kerja = $this->uraianTugas->rincianTugas->hasil_kerja;
                $this->satuan_hasil = $this->uraianTugas->rincianTugas->satuan_hasil;
                $this->target = $this->uraianTugas->rincianTugas->target;
                $this->frekuensi = $this->uraianTugas->rincianTugas->frekuensi;
                $this->waktu_penyelesaian = $this->uraianTugas->rincianTugas->waktu_penyelesaian;
            }

            // Kirim event ke browser untuk membuka modal
            $this->dispatch('open-edit-tugas-modal');
        }
    }

    public function save()
    {
        $this->validate([
            'uraian_tugas_staf' => 'required|string|max:255',
            'hasil_kerja' => 'required|string|max:255',
            'satuan_hasil' => 'required|string|max:50',
            'target' => 'required|numeric',
            'frekuensi' => 'required|numeric', // Diubah menjadi numeric
            'waktu_penyelesaian' => 'required|numeric|max:330',
        ]);

        if ($this->uraianTugas) {

            $volume = $this->target * $this->frekuensi;
            $beban_ideal = round(($volume * $this->waktu_penyelesaian / 75000), 2);
            $beban_berlebih = round(($volume * $this->waktu_penyelesaian / 100800), 2);


            $this->uraianTugas->update([
                'uraian_tugas_staf' => $this->uraian_tugas_staf,
                'abk_ideal' => $beban_ideal,
                'abk_berlebih' => $beban_berlebih,
            ]);

            $this->uraianTugas->rincianTugas()->updateOrCreate(
                ['detail_uraian_tugas_staf_id' => $this->uraianTugas->id],
                [
                    'hasil_kerja' => $this->hasil_kerja,
                    'satuan_hasil' => $this->satuan_hasil,
                    'target' => $this->target,
                    'frekuensi' => $this->frekuensi,
                    'waktu_penyelesaian' => $this->waktu_penyelesaian,
                    'volume' => $volume, // <-- DATA BARU
                ]
            );

            $this->dispatch('close-edit-tugas-modal');
            $this->dispatch('uraianTugasCreatedTable1');
            $this->dispatch('uraianTugasCreatedTable2');
            $this->dispatch('show-success', message: 'Data berhasil diperbarui!');
        }
    }

    public function render()
    {
        return view('livewire.uraian-tugas-user.edit-uraian-tugas-modal');
    }
}
