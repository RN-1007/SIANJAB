<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Data Staf Berdasarkan Perangkat Daerah</h3>
            </div>

            <div class="card-body">
                @forelse ($skpds as $skpd)
                    <div class="skpd-group @if (!$loop->first) border-top pt-3 @endif mt-3">

                        <h5 class="font-weight-bold text-primary mb-3">
                            {{-- Menggunakan nama field dari model DataPd --}}
                            {{ $skpd->nama_pd }}
                        </h5>

                        @if ($skpd->strukturJabatans->isNotEmpty())
                            <a class="btn btn-sm btn-outline-primary rounded" data-toggle="collapse"
                                href="#collapseJabatan{{ $skpd->id }}" role="button" aria-expanded="false"
                                aria-controls="collapseJabatan{{ $skpd->id }}">
                                Lihat {{ $skpd->strukturJabatans->count() }} Jabatan <i class="fas fa-chevron-down ms-1"></i>
                            </a>
                            <a href="{{ route('data-summary', ['skpd' => $skpd->id]) }}"
                                class="btn btn-sm btn-primary ml-2"><span>Summary
                                    Data</span> <i class="fas fa-eye"></i></a>

                            <div class="collapse mt-3" id="collapseJabatan{{ $skpd->id }}">
                                <ul class="row list-unstyled ps-3">
                                    @foreach ($skpd->strukturJabatans as $jabatan)
                                        <li class="col-lg-4 col-md-6 col-12 mb-2 d-flex align-items-center">
                                            <i class="fas fa-angle-right text-muted pr-2"></i>
                                            <span>{{ $jabatan->nama_jabatan }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-muted fst-italic">
                                _Tidak ada data Nomenklatur Jabatan untuk Perangkat Daerah ini_
                            </p>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-muted">
                        <p>Tidak ada data Perangkat Daerah yang ditemukan.</p>
                    </div>
                @endforelse

                <div class="mt-4 d-flex justify-content-center">
                    {{ $skpds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>