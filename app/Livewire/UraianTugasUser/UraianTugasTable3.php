<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\DataDetailUraianTugasStaf;
use App\Models\RincianTugasStaf;
use App\Models\TugasDanFungsi;
use App\Models\UraianTugasDanTusi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UraianTugasTable3 extends Component
{
    #[Rule('required|string')]
    public $uraian_tugas_staf = '';

    #[Rule('required|string')]
    public $hasil_kerja_staf = '';

    #[Rule('required|string')]
    public $satuan_hasil = '';

    #[Rule('required|numeric')]
    public $target = '';

    #[Rule('required')]
    public $frekuensi = ''; // Properti untuk select

    #[Rule('required|numeric|max:330')]
    public $waktu_penyelesaian = '';

    // Properti untuk menyimpan konteks Tusi yang dipilih
    public $selectedTusi = null;
    public $id_uraian_tugas_tusi = null;

    public function prepareToCreate($tusiId)
    {
        $this->resetInput();

        $userId = Auth::id();
        $this->selectedTusi = TugasDanFungsi::find($tusiId);

        if ($this->selectedTusi && $userId) {
            $uraianTugasTusi = UraianTugasDanTusi::where('id_tusi', $tusiId)
                ->whereHas('dataUraianTugasStaf', function ($query) use ($userId) {
                    $query->where('id_user', $userId);
                })
                ->first();

            if ($uraianTugasTusi) {
                $this->id_uraian_tugas_tusi = $uraianTugasTusi->id;
                $this->dispatch('open-create-modal');
            } else {
                $this->dispatch('show-error', message: 'Relasi tugas tidak ditemukan.');
            }
        }
    }

    public function saveUraianTugas()
    {
        $this->validate();

        // Rumus Untuk Menghitung Rumus
        $volume = $this->target * $this->frekuensi;
        $beban_ideal = round(($volume * $this->waktu_penyelesaian / 75000), 2);
        $beban_berlebih = round(($volume * $this->waktu_penyelesaian / 100800), 2);
        $userdata = Auth::user();

        // dd([
        //     'id_uraian_tugas_tusi' => $this->id_uraian_tugas_tusi,
        //     'uraian_tugas_staf' => $this->uraian_tugas_staf,
        //     'hasil_kerja_staf' => $this->hasil_kerja_staf,
        //     'satuan_kerja' => $this->satuan_kerja,
        //     'target' => $this->target,
        //     'frekuensi' => $this->frekuensi,
        //     'waktu_penyelesaian' => $this->waktu_penyelesaian,
        //     'permempan_41' => $this->permempan_41,
        //     'permempan_45' => $this->permempan_45,
        //     'volume' => $volume,
        //     'beban_ideal' => $beban_ideal,
        //     'beban_berlebih' => $beban_berlebih,
        //     'nama_jabatan' => $userdata->nama_jabatan,
        // ]);

        if (!$this->id_uraian_tugas_tusi) {
            $this->dispatch('show-error', message: 'Gagal menyimpan, ID tugas tidak valid.');
            return;
        }

        // Create Uraian Tugas Staf
        $data_uraian_tugas_staf = DataDetailUraianTugasStaf::create([
            'id_uraian_tugas_tusi' => $this->id_uraian_tugas_tusi,
            'uraian_tugas_staf' => $this->uraian_tugas_staf,
            'abk_ideal' => $beban_ideal,
            'abk_berlebih' => $beban_berlebih,
            'kategori_jabatan' => $userdata->jabatan,
            'status' => 'belum',
        ]);

        // Create Rincian Tugas
        RincianTugasStaf::create([
            'detail_uraian_tugas_staf_id' => $data_uraian_tugas_staf->id,
            'hasil_kerja' => $this->hasil_kerja_staf,
            'satuan_hasil' => $this->satuan_hasil,
            'target' => $this->target,
            'frekuensi' => $this->frekuensi,
            'volume' => $volume,
            'waktu_penyelesaian' => $this->waktu_penyelesaian,
        ]);

        // Kirim event untuk menutup modal
        $this->dispatch('close-create-modal');
        // Reset input setelah berhasil
        $this->resetInput();
        // Beri notifikasi sukses
        $this->dispatch('show-success', message: 'Uraian tugas berhasil ditambahkan.');

        $this->dispatch('uraianTugasCreatedTable2');
        $this->dispatch('uraianTugasCreatedTable1');
    }

    private function resetInput()
    {
        $this->uraian_tugas_staf = '';
        $this->hasil_kerja_staf = '';
        $this->satuan_hasil = '';
        $this->target = '';
        $this->frekuensi = '';
        $this->waktu_penyelesaian = '';
        $this->selectedTusi = null;
        $this->id_uraian_tugas_tusi = null;
        $this->resetValidation();
    }

    public function render()
    {
        $userId = Auth::id();
        $daftarTusi = collect();

        if ($userId) {
            $daftarTusi = TugasDanFungsi::whereHas('uraianTugasDanTusis.dataUraianTugasStaf', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })->get();
        }

        return view('livewire.uraian-tugas-user.uraian-tugas-table3', [
            'daftarTusi' => $daftarTusi
        ]);
    }
}
