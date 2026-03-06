<div wire:ignore.self class="modal fade" id="edit-tugas-staf" tabindex="-1" role="dialog"
    aria-labelledby="editTugasStafLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editTugasStafLabel">Edit Data Tugas Staf</h4>
                    {{-- Tombol close standar Bootstrap --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($uraianTugas)
                        {{-- Field dari DataDetailUraianTugasStaf --}}
                        <div class="form-group">
                            <label for="uraiantugas">Uraian Tugas : </label>
                            {{-- wire:model.defer mengikat input ke properti di komponen --}}
                            <textarea class="form-control @error('uraian_tugas_staf') is-invalid @enderror" rows="3" id="uraiantugas"
                                wire:model.defer="uraian_tugas_staf"></textarea>
                            {{-- Menampilkan pesan error jika validasi gagal --}}
                            @error('uraian_tugas_staf')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="hasilkerja">Hasil Kerja : </label>
                            <input type="text" class="form-control @error('hasil_kerja') is-invalid @enderror"
                                id="hasilkerja" wire:model.defer="hasil_kerja">
                            @error('hasil_kerja')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuankerja">Satuan Hasil : </label>
                            <input type="text" class="form-control @error('satuan_hasil') is-invalid @enderror"
                                id="satuankerja" wire:model.defer="satuan_hasil">
                            @error('satuan_hasil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="target">Target : </label>
                            <input type="number" class="form-control @error('target') is-invalid @enderror"
                                id="target" wire:model.defer="target">
                            @error('target')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Frekuensi / Shift :</label>
                            <select class="form-control @error('frekuensi') is-invalid @enderror" style="width: 100%;"
                                wire:model.defer="frekuensi">
                                <option value="">-- Pilih Frekuensi --</option>
                                <option value="235">5 Hari Kerja(235)</option>
                                <option value="1">Tahunan (1)</option>
                                <option value="2">Semesteran (2)</option>
                                <option value="3">Caturwulanan (3)</option>
                                <option value="4">Triwulanan (4)</option>
                                <option value="6">Dwi bulan (6)</option>
                                <option value="12">Bulanan (12)</option>
                                <option value="52">Mingguan (52)</option>
                                <option value="287">6 Hari Kerja (287)</option>
                                <option value="365">Setiap Hari (365)</option>
                            </select>
                            @error('frekuensi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="waktu">Waktu Penyelesaian (menit) : </label>
                            <input type="number" class="form-control @error('waktu_penyelesaian') is-invalid @enderror"
                                id="waktu" wire:model.defer="waktu_penyelesaian">
                            <span class="text-danger font-weight-bold font-italic">*Maksimal waktu diisi 330</span>
                            @error('waktu_penyelesaian')
                                <br><span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="catatan">Catatan Mahasiswa : </label>
                            <textarea class="form-control" rows="3" id="catatan" disabled>{{ $catatan_mahasiswa ?? 'Tidak ada catatan.' }}</textarea>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                        <span wire:loading wire:target="save">Simpan Perubahan...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
