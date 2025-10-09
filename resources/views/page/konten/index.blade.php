<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Content Management') }}
            </h2>
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                <form method="GET" action="{{ route('konten.index') }}" class="relative w-full sm:w-64">
                    <input type="text" name="search" placeholder="Cari konten..." value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                            class="fas fa-search text-gray-400"></i></div>
                </form>
                <button onclick="openAddModal()"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 rounded-lg text-white font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition w-full sm:w-auto"><i
                        class="fas fa-plus"></i> Tambah Konten</button>
            </div>
        </div>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div id="alert-success"
                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <i class="fas fa-check-circle flex-shrink-0 w-4 h-4"></i>
                    <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
                    <button type="button" onclick="document.getElementById('alert-success').style.display='none'"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            {{-- Notifikasi Error --}}
             @if (session('error'))
                <div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <i class="fas fa-exclamation-triangle flex-shrink-0 w-4 h-4"></i>
                    <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
                    <button type="button" onclick="document.getElementById('alert-error').style.display='none'" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Grid Konten --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($konten as $k)
                    <div onclick="openDetailModal(this)" data-judul="{{ $k->judul }}"
                        data-caption="{{ $k->caption }}" data-gambar="{{ asset('storage/' . $k->gambar) }}"
                        data-tanggal="{{ \Carbon\Carbon::parse($k->tanggal)->isoFormat('D MMMM YYYY') }}"
                        class="cursor-pointer group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl">
                        
                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1 truncate"
                                title="{{ $k->judul }}">{{ $k->judul }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-2">
                                {!! strip_tags($k->caption) !!}</p>
                            <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1"><i
                                    class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                            </div>
                        </div>
                        <div
                            class="absolute top-3 right-3 bg-white/90 dark:bg-gray-900/80 rounded-md shadow-sm opacity-0 group-hover:opacity-100 transition-opacity flex space-x-2 p-1">
                            <button onclick="event.stopPropagation(); editSourceModal(this)"
                                data-id="{{ $k->id }}" data-judul="{{ $k->judul }}"
                                data-caption="{{ $k->caption }}" data-tanggal="{{ $k->tanggal }}"
                                data-gambar="{{ asset('storage/' . $k->gambar) }}"
                                class="text-gray-500 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition"><i
                                    class="fas fa-edit text-sm"></i></button>
                            <button
                                onclick="event.stopPropagation(); kontenDelete('{{ $k->id }}','{{ $k->judul }}')"
                                class="text-gray-500 hover:text-red-600 dark:text-gray-300 dark:hover:text-red-400 transition"><i
                                    class="fas fa-trash-alt text-sm"></i></button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-500 dark:text-gray-400"><i
                            class="fas fa-box-open fa-3x mb-4"></i>
                        <h3 class="text-xl font-semibold">Tidak ada konten ditemukan</h3>
                        <p>Silakan tambahkan konten baru.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-8">{{ $konten->appends(request()->query())->links() }}</div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-xl shadow-xl">
            <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white"><i class="fas fa-plus-circle mr-2"></i>
                    Tambah Konten Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white"><i
                        class="fas fa-times text-xl"></i></button>
            </div>
            <form method="POST" action="{{ route('konten.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mx-6 mt-4"
                        role="alert">
                        <span class="font-medium">Oops! Periksa kembali input Anda:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div><label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label><input
                            type="text" name="judul" value="{{ old('judul') }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label>
                        <textarea id="caption_add" name="caption">{{ old('caption') }}</textarea>
                    </div>
                    <div><label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label><input
                            type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div><label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar</label><input
                            type="file" id="gambar_add" name="gambar" required
                            class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 focus:outline-none">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end"><button type="submit"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">Simpan
                        Konten</button></div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-xl shadow-xl">
            <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white"><i class="fas fa-edit mr-2"></i> Edit Konten</h3>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form method="POST" id="formSourceModal" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label><input type="text" id="judul_edit" name="judul" required class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white"></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Caption</label><textarea id="caption_edit" name="caption"></textarea></div>
                    <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label><input type="date" id="tanggal_edit" name="tanggal" required class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white"></div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Saat Ini</label><img id="gambar_preview" src="" class="h-20 w-auto rounded-md mb-2 object-cover">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ganti Gambar (Opsional)</label><input type="file" id="gambar_edit" name="gambar" class="w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 focus:outline-none">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 rounded-b-xl flex justify-end"><button type="submit" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-200">Simpan Perubahan</button></div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div id="detailModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center bg-black bg-opacity-60 p-4" onclick="closeDetailModal()">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-xl shadow-xl transform transition-all duration-300" onclick="event.stopPropagation()">
            <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-t-xl flex justify-between items-center">
                <h3 id="detailJudul" class="text-lg font-semibold text-gray-800 dark:text-white"></h3>
                <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-800 dark:hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            <div class="p-6 max-h-[80vh] overflow-y-auto">
                <img id="detailGambar" src="" class="w-full h-auto rounded-lg shadow-md mb-6">
                <p id="detailTanggal" class="text-sm text-gray-500 dark:text-gray-400 mb-8"></p>
                <div id="detailCaption" class="prose dark:prose-invert max-w-none"></div>
            </div>
        </div>
    </div>
    
    <style>
      .tox-tinymce-aux, .tox-notification { z-index: 99999 !important; }
    </style>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // --- Fungsi Modal & CRUD (Didefinisikan di scope global) ---
            window.openAddModal = function() {
                document.getElementById('addModal').classList.remove('hidden');
            }
            window.closeAddModal = function() {
                if(tinymce.get('caption_add')) { tinymce.get('caption_add').setContent(''); }
                document.getElementById('addModal').classList.add('hidden');
            }
            window.closeEditModal = function() {
                document.getElementById('editModal').classList.add('hidden');
            }
            window.closeDetailModal = function() {
                document.getElementById('detailModal').classList.add('hidden');
            }

            window.openDetailModal = function(element) {
                document.getElementById('detailJudul').innerText = element.dataset.judul;
                document.getElementById('detailGambar').src = element.dataset.gambar;
                document.getElementById('detailTanggal').innerText = `Dipublikasikan pada: ${element.dataset.tanggal}`;
                // Gunakan Purify di sisi klien atau pastikan output HTML aman dari controller
                document.getElementById('detailCaption').innerHTML = element.dataset.caption;
                document.getElementById('detailModal').classList.remove('hidden');
            }

            window.editSourceModal = function(button) {
                 const modal = document.getElementById('editModal');
                 modal.classList.remove('hidden');
                 const id = button.dataset.id;
                 const updateUrl = "{{ route('konten.update', ':id') }}".replace(':id', id);
                 
                 modal.querySelector('#formSourceModal').setAttribute('action', updateUrl);
                 modal.querySelector('#judul_edit').value = button.dataset.judul;
                 
                 if (tinymce.get('caption_edit')) {
                     tinymce.get('caption_edit').setContent(button.dataset.caption);
                 }
                 
                 modal.querySelector('#tanggal_edit').value = button.dataset.tanggal;
                 modal.querySelector('#gambar_preview').src = button.dataset.gambar;
            }

            window.kontenDelete = function(id, judul) {
                Swal.fire({
                    title: 'Hapus Konten?',
                    html: `<strong>${judul}</strong> akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'dark:bg-gray-800 dark:text-gray-200' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('konten') }}/${id}`;
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
            
            // Otomatis buka kembali modal "Tambah" jika ada error validasi
            @if($errors->any())
                document.addEventListener('DOMContentLoaded', function() {
                    openAddModal();
                });
            @endif

            // Inisialisasi TinyMCE
            document.addEventListener('DOMContentLoaded', function() {
                tinymce.init({
                    selector: 'textarea#caption_add, textarea#caption_edit',
                    plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace table visualblocks wordcount autoresize',
                    toolbar: 'undo redo | blocks | bold italic underline | link media table | align lineheight | bullist numlist indent outdent | emoticons charmap | removeformat',
                    height: 350,
                    skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
                    content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default')
                });
            });
        </script>
    @endpush
</x-app-layout>

