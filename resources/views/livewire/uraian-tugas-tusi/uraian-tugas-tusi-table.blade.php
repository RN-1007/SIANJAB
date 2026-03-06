<div>
    <table class="table table-bordered table-sm" id="example1">
        <thead>
            <tr class="text-center">
                <th class="text-center" style="width: 5%">No</th>
                <th class="text-center" style="25%">Kode Tusi</th>
                <th class="text-center">Tusi</th>
                <th class="text-center">Nama Jabatan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($uraianTugas as $item)
                <tr>
                    <td class="text-center font-weight-bold text-md">{{ $loop->iteration }}.</td>

                    <td class="text-md font-weight-bold">{{ $item->tusi->code_tusi ?? 'N/A' }}</td>

                    <td class="text-md">{{ $item->tusi->tusi ?? 'N/A' }}</td>

                    <td class="text-md font-weight-bold">
                        {{ $item->dataUraianTugasStaf->user->jabatan ?? 'N/A' }}
                    </td>

                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"
                                title="Edit Data">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger"
                                title="Hapus Data">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- MODAL EDIT --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form wire:submit.prevent="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel">Edit Data Master User dan Tusi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="resetInput">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        {{-- INPUT 1: Jabatan Staf (EDIT) --}}
                        {{-- Gunakan wire:ignore di pembungkus --}}
                        <div class="form-group" wire:ignore>
                            <label for="edit_id_uraian_tugas_staf">Jabatan Staf</label>
                            {{-- Hapus wire:model --}}
                            <select class="form-control" id="edit_id_uraian_tugas_staf" style="width: 100%;">
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

                        {{-- INPUT 2: Tugas dan Fungsi (EDIT) --}}
                        <div class="form-group" wire:ignore>
                            <label for="edit_id_tusi">Tugas dan Fungsi</label>
                            <select class="form-control" id="edit_id_tusi" style="width: 100%;">
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
                            <span wire:loading.remove wire:target="update">Simpan Perubahan</span>
                            <span wire:loading wire:target="update">Menyimpan... <i
                                    class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
        aria-labelledby="modal-delete-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-delete-label">Konfirmasi Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus data: <strong>{{ $deleteName }}</strong>? Tindakan ini tidak dapat
                    dibatalkan.
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="destroy()" wire:loading.attr="disabled"
                        wire:target="destroy">
                        <span wire:loading.remove wire:target="destroy">Ya, Hapus!</span>
                        <span wire:loading wire:target="destroy"><i class="fas fa-spinner fa-spin"></i>
                            Menghapus...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
