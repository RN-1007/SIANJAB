<div>
    <button type="button" class="mt-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus"></i> Tambah Data
    </button>

    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form wire:submit.prevent="store">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addModalLabel">Tambah Data Master User dan Tusi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInput">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="form-group" wire:ignore>
                            <label for="id_uraian_tugas_staf">Jabatan Staf</label>
                            <select class="form-control" id="id_uraian_tugas_staf">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($uraianTugasStafs as $item)
                                    @if ($item->user)
                                        <option value="{{ $item->id }}">
                                            {{ $item->user->jabatan }}
                                            @if ($item->user->strukturJabatan)
                                                ({{ $item->user->strukturJabatan->nama_jabatan }})
                                            @endif
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{-- Error ditaruh diluar wire:ignore --}}
                        @error('id_uraian_tugas_staf')
                            <span class="text-danger mt-1 d-block">{{ $message }}</span>
                        @enderror

                        <div class="form-group" wire:ignore>
                            <label for="id_tusi">Tugas dan Fungsi</label>
                            <select class="form-control" id="id_tusi">
                                <option value="">-- Pilih Tusi --</option>
                                @foreach ($tusis as $tusi)
                                    <option value="{{ $tusi->id }}">
                                        ({{ $tusi->code_tusi }})
                                        {{ Str::limit($tusi->tusi, 100) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('id_tusi')
                            <span class="text-danger mt-1 d-block">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            wire:click="resetInput">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store">Menyimpan... <i
                                    class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
