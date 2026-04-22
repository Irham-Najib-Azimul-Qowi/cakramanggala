@extends('layouts.dashboard')

@section('title', 'Pesan Masuk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Pesan Masuk</h3>
        <p class="text-muted small">Kelola pesan dari form kontak website.</p>
    </div>
</div>

{{-- Wide Message Cards --}}
<div class="vstack gap-3">
    @forelse($pesans as $pesan)
        <div class="wide-card p-3 {{ !$pesan->is_read ? 'unread' : '' }}">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <div class="msg-icon {{ !$pesan->is_read ? 'active' : '' }}">
                        <i class="bi bi-chat-left-dots{{ !$pesan->is_read ? '-fill' : '' }}"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <h6 class="fw-bold mb-0">{{ $pesan->nama }}</h6>
                        @if(!$pesan->is_read)
                            <span class="badge bg-danger rounded-pill smaller-badge">BARU</span>
                        @endif
                    </div>
                    <div class="text-primary fw-600 small mb-1">{{ $pesan->subjek }}</div>
                    <div class="text-muted smaller text-truncate" style="max-width: 600px;">
                        {{ Str::limit($pesan->pesan, 120) }}
                    </div>
                </div>
                <div class="col-auto d-none d-md-block text-end">
                    <div class="small fw-bold">{{ $pesan->created_at->format('d/m/Y') }}</div>
                    <div class="smaller text-muted">{{ $pesan->created_at->diffForHumans() }}</div>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.pesan.show', $pesan->id) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold">
                            Baca
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center delete-btn" 
                                style="width: 32px; height: 32px;" data-id="{{ $pesan->id }}" data-name="{{ $pesan->subjek }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 p-5 text-center rounded-4" style="background: var(--surface-panel);">
            <i class="bi bi-chat-square-x display-1 text-muted opacity-25"></i>
            <p class="text-muted mt-3">Tidak ada pesan masuk.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $pesans->links() }}
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-body text-center p-5">
                <i class="bi bi-trash text-danger display-1 mb-4"></i>
                <h4 class="fw-bold">Hapus Pesan?</h4>
                <p class="text-muted" id="deleteName"></p>
                <div class="d-flex gap-2 mt-5">
                    <button type="button" class="btn btn-light flex-grow-1 rounded-pill py-2" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="flex-grow-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 rounded-pill py-2">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .wide-card {
        background: var(--surface-panel);
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        transition: all 0.25s ease;
        position: relative;
    }

    .wide-card.unread { border-left: 4px solid var(--accent); }

    .wide-card:hover {
        transform: translateX(5px);
        border-color: var(--accent);
        box-shadow: 0 10px 30px rgba(7, 17, 12, 0.05);
    }

    .msg-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--surface-soft);
        color: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .msg-icon.active { background: rgba(242, 182, 97, 0.1); color: var(--accent); }

    .smaller-badge { font-size: 0.6rem; padding: 2px 6px; }
    .smaller { font-size: 0.75rem; }
    .fw-600 { font-weight: 600; }
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteForm').action = `/dashboard/pesan/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
});
</script>
@endpush
