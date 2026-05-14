@extends('layouts.dashboard')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h3 fw-black mb-1" style="letter-spacing: -0.02em;">KOTAK MASUK</h1>
            <p class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.1em;">Komunikasi Publik Cakra
                Manggala</p>
        </div>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;"></th>
                    <th>Pengirim</th>
                    <th>Subjek & Pesan</th>
                    <th class="d-none d-md-table-cell">Waktu</th>
                    <th class="text-end">Manajemen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesans as $pesan)
                    <tr style="{{ !$pesan->is_read ? 'background: rgba(242,182,97,0.03);' : '' }}">
                        <td class="text-center">
                            @if(!$pesan->is_read)
                                <div class="bg-accent" style="width: 8px; height: 8px; margin: 0 auto;"></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-black text-white mb-1" style="font-size: 0.95rem;">{{ strtoupper($pesan->nama) }}
                            </div>
                            <div class="x-small text-white-50 fw-bold" style="font-size: 0.7rem;">{{ $pesan->email }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-accent mb-1" style="font-size: 0.85rem;">{{ $pesan->subjek }}</div>
                            <div class="text-white-50 text-truncate small" style="max-width: 350px;">
                                {{ Str::limit($pesan->pesan, 100) }}</div>
                        </td>
                        <td class="small text-white-50 d-none d-md-table-cell">
                            <div class="fw-bold text-white">{{ $pesan->created_at->translatedFormat('d M Y') }}</div>
                            <div class="x-small fw-bold text-uppercase" style="font-size: 0.6rem;">
                                {{ $pesan->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('dashboard.pesan.show', $pesan->id) }}"
                                    class="btn btn-sm btn-outline-light border-0 rounded-0 fw-black px-3"
                                    style="font-size: 0.7rem; background: rgba(255,255,255,0.05); letter-spacing: 0.1em;">BACA</a>
                                <button type="button" class="btn btn-sm border-0 rounded-0 fw-black px-3"
                                    style="font-size: 0.7rem; background: rgba(255,99,102,0.1); color: #ff6366;"
                                    data-id="{{ $pesan->id }}" data-name="{{ $pesan->subjek }}" onclick="deletePesan(this)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-white-50 italic">Kotak masuk kosong.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $pesans->links() }}
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg bg-dark-card rounded-0">
                <div class="modal-body text-center p-5">
                    <div class="mb-4 text-danger"><i class="bi bi-trash3-fill display-3"></i></div>
                    <h3 class="fw-black text-white">HAPUS PESAN?</h3>
                    <p class="text-white-50 small mb-4 px-2" id="deleteName"></p>
                    <div class="d-flex gap-3 mt-5">
                        <button type="button" class="btn flex-grow-1 py-3 fw-bold border-0 rounded-0"
                            style="background: rgba(255,255,255,0.05); color: #fff;" data-bs-dismiss="modal">BATAL</button>
                        <form id="deleteForm" method="POST" class="flex-grow-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 py-3 fw-black rounded-0">HAPUS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deletePesan(btn) {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            document.getElementById('deleteName').textContent = `Subjek: "${name}"`;
            document.getElementById('deleteForm').action = `/dashboard/pesan/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endpush

<style>
    .bg-dark-card {
        background: var(--dark-card) !important;
    }
</style>