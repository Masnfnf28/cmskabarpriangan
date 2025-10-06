<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Content Management') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="relative w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search Konten..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>
                <button onclick="openAddModal()"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i> Tambah Konten
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($konten as $k)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <a href="{{ $k->url }}" target="_blank">
                            <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}"
                                class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1 truncate">
                                {{ $k->judul }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 h-10 overflow-hidden">
                                {{ $k->caption }}</p>
                            <div class="text-xs text-gray-500 dark:text-gray-500 mb-4">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                            </div>
                            <div class="flex justify-end space-x-2 border-t dark:border-gray-700 pt-3">
                                <button onclick="editSourceModal(this)" data-modal-target="editModal"
                                    data-id="{{ $k->id }}" data-judul="{{ $k->judul }}"
                                    data-caption="{{ $k->caption }}" data-tanggal="{{ $k->tanggal }}"
                                    data-gambar="{{ asset('storage/' . $k->gambar) }}" data-url="{{ $k->url }}"
                                    class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <button onclick="kontenDelete('{{ $k->id }}','{{ $k->judul }}')"
                                    class="text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 transition-colors">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">
                        <i class="fas fa-box-open fa-3x mb-4"></i>
                        <h3 class="text-xl">Tidak ada konten yang ditemukan.</h3>
                        <p>Silakan tambahkan konten baru.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $konten->links() }}
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden" id="addModal">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl">
                <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white"><i
                            class="fas fa-plus-circle mr-2"></i> Tambah Konten Baru</h3>
                    <button onclick="closeAddModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white"><i
                            class="fas fa-times text-xl"></i></button>
                </div>
                <form method="POST" action="{{ route('konten.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="judul_add"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                            <input type="text" id="judul_add" name="judul" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="caption_add"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                            <textarea id="caption_add" name="caption" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                        <div>
                            <label for="tanggal_add"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                            <input type="date" id="tanggal_add" name="tanggal" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="gambar_add"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar</label>
                            <input type="file" id="gambar_add" name="gambar" required
                                class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
                        <div>
                            <label for="url_add"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL</label>
                            <input type="text" id="url_add" name="url" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">Simpan
                            Konten</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden" id="editModal">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl">
                <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white" id="title_source"><i
                            class="fas fa-edit mr-2"></i> Update Konten</h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="editModal"
                        class="text-gray-500 hover:text-gray-800 dark:hover:text-white"><i
                            class="fas fa-times text-xl"></i></button>
                </div>
                <form method="POST" id="formSourceModal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="judul_edit"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                            <input type="text" id="judul_edit" name="judul"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="caption_edit"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                            <textarea id="caption_edit" name="caption"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                        <div>
                            <label for="tanggal_edit"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                            <input type="date" id="tanggal_edit" name="tanggal"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="url_edit"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL</label>
                            <input type="text" id="url_edit" name="url"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Saat
                                Ini</label>
                            <img id="gambar_preview" src="" alt="Gambar Lama"
                                class="h-20 w-auto rounded-md mb-2 object-cover">
                            <label for="gambar_edit"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ganti Gambar
                                (Opsional)</label>
                            <input type="file" id="gambar_edit" name="gambar"
                                class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // --- Modal untuk TAMBAH Konten ---
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    // --- Modal untuk EDIT Konten ---
    function editSourceModal(button) {
        const modal = document.getElementById('editModal');
        const id = button.dataset.id;
        const judul = button.dataset.judul;
        const caption = button.dataset.caption;
        const tanggal = button.dataset.tanggal;
        const gambar = button.dataset.gambar;
        const url_data = button.dataset.url;
        let updateUrl = "{{ route('konten.update', ':id') }}".replace(':id', id);

        modal.classList.remove('hidden');

        modal.querySelector('#title_source').innerText = `Update: ${judul}`;
        modal.querySelector('#judul_edit').value = judul;
        modal.querySelector('#caption_edit').value = caption;
        modal.querySelector('#tanggal_edit').value = tanggal;
        modal.querySelector('#url_edit').value = url_data;
        modal.querySelector('#gambar_preview').src = gambar;
        modal.querySelector('#formSourceModal').setAttribute('action', updateUrl);
    }

    function sourceModalClose(button) {
        const modalTarget = button.dataset.modalTarget;
        document.getElementById(modalTarget).classList.add('hidden');
    }

    // --- Aksi HAPUS Konten (SweetAlert) ---
    function kontenDelete(id, judul) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `Anda akan menghapus Konten <strong>${judul}</strong>.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`/konten/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').content
                }).then(() => {
                    Swal.fire('Terhapus!', 'Data Konten telah dihapus.', 'success').then(() => location
                        .reload());
                }).catch((error) => {
                    Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
                    console.error(error);
                });
            }
        });
    }
</script>

@if (!isset($noSweetAlert))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@endif
