<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Content Management') }}
            </h2>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                {{-- FORM PENCARIAN --}}
                <form method="GET" action="{{ route('konten.index') }}" class="relative w-full sm:w-64">
                    <input type="text" name="search" placeholder="Cari konten..." value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </form>

                <button onclick="openAddModal()"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 rounded-lg text-white font-semibold
                        hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    <i class="fas fa-plus"></i> Tambah Konten
                </button>
            </div>
        </div>
    </x-slot>

    {{-- GRID KONTEN --}}
    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($konten as $k)
                    <div
                        class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden
                        transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl">

                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}"
                            class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1 truncate">
                                {{ $k->judul }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-2">
                                {{ $k->caption }}
                            </p>
                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                <i class="fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                            </div>
                        </div>

                        {{-- Tombol aksi --}}
                        <div
                            class="absolute top-3 right-3 bg-white/90 dark:bg-gray-900/80 rounded-md shadow-sm
                            opacity-0 group-hover:opacity-100 transition-opacity flex space-x-2 p-1">
                            <button onclick="editSourceModal(this)" data-id="{{ $k->id }}"
                                data-judul="{{ $k->judul }}" data-caption="{{ $k->caption }}"
                                data-tanggal="{{ $k->tanggal }}" data-gambar="{{ asset('storage/' . $k->gambar) }}"
                                class="text-gray-500 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <button onclick="kontenDelete('{{ $k->id }}','{{ $k->judul }}')"
                                class="text-gray-500 hover:text-red-600 dark:text-gray-300 dark:hover:text-red-400 transition">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400">
                        <i class="fas fa-box-open fa-3x mb-4"></i>
                        <h3 class="text-xl font-semibold">Tidak ada konten ditemukan</h3>
                        <p>Silakan tambahkan konten baru.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $konten->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl">
            <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Konten Baru
                </h3>
                <button onclick="closeAddModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('konten.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                        <input type="text" name="judul" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                        <textarea name="caption" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ now()->format('Y-m-d') }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar</label>
                        <input type="file" id="gambar_add" name="gambar" required
                            class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 focus:outline-none">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Konten
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl">
            <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                    <i class="fas fa-edit mr-2"></i> Edit Konten
                </h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form method="POST" id="formSourceModal" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                        <input type="text" id="judul_edit" name="judul" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                        <textarea id="caption_edit" name="caption" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                        <input type="date" id="tanggal_edit" name="tanggal" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Saat
                            Ini</label>
                        <img id="gambar_preview" src="" class="h-20 w-auto rounded-md mb-2 object-cover">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ganti Gambar
                            (Opsional)</label>
                        <input type="file" id="gambar_edit" name="gambar"
                            class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 focus:outline-none">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

{{-- SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // --- FUNGSI-FUNGSI UTAMA ---
    const openAddModal = () => document.getElementById('addModal').classList.remove('hidden');
    const closeAddModal = () => document.getElementById('addModal').classList.add('hidden');
    const closeEditModal = () => document.getElementById('editModal').classList.add('hidden');

    function editSourceModal(button) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        const id = button.dataset.id;
        const updateUrl = "{{ route('konten.update', ':id') }}".replace(':id', id);
        modal.querySelector('#formSourceModal').setAttribute('action', updateUrl);
        modal.querySelector('#judul_edit').value = button.dataset.judul;
        modal.querySelector('#caption_edit').value = button.dataset.caption;
        modal.querySelector('#tanggal_edit').value = button.dataset.tanggal;
        modal.querySelector('#gambar_preview').src = button.dataset.gambar;
    }

    function kontenDelete(id, judul) {
        Swal.fire({
            title: 'Hapus Konten?',
            html: `<strong>${judul}</strong> akan dihapus secara permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`/konten/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').content
                }).then(() => {
                    Swal.fire('Terhapus!', 'Konten berhasil dihapus.', 'success')
                        .then(() => location.reload());
                }).catch(() => {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
                });
            }
        });
    }

    function validateImageFile(fileInput) {
        if (!fileInput) return;

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
                if (file.size > maxSizeInBytes) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran Terlalu Besar!',
                        text: 'Ukuran File Tidak Boleh Melebihi 1 MB.',
                    });
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        if (this.height >= this.width) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Orientasi Salah!',
                                text: 'Foto yang di-upload wajib berorientasi Landscape (melebar).',
                            });
                            event.target.value = '';
                        }
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // --- PERBAIKAN UTAMA: Jalankan kode setelah halaman siap ---
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputAdd = document.getElementById('gambar_add');
        const fileInputEdit = document.getElementById('gambar_edit');

        validateImageFile(fileInputAdd);
        validateImageFile(fileInputEdit);
    });
</script>

