<x-app-layout>
    <x-page-header title="Artikel" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Artikel']]" />
    
    <div class="row">
        <form action="{{ route('articles.store') }}" enctype="multipart/form-data" method="POST" class="card">
            @csrf
            <div class="card-header">
                <h4 class="card-title">Tambah Artikel</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-sm-8 col-12">
                        <x-form.input name="title" label="Judul Artikel" required="true" placeholder="Masukkan judul menarik..." />
                    </div>

                    <div class="mb-3 col-sm-4 col-12">
                        <x-form.input name="author" label="Nama Penulis" :value="auth()->user()->name" />
                    </div>

                    <div class="mb-3 col-sm-6 col-12">
                        <label class="form-label fw-bold small text-uppercase">Thumbnail Artikel</label>
                        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                        @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-sm-6 col-12">
                        @php
                            // Contoh mapping tags sederhana, idealnya ini dari database
                            $tagOptions = collect([
                                (object)['id' => 'kesehatan', 'name' => 'Kesehatan'],
                                (object)['id' => 'mental-health', 'name' => 'Mental Health'],
                                (object)['id' => 'tips', 'name' => 'Tips & Trik'],
                                (object)['id' => 'parenting', 'name' => 'Parenting'],
                            ]);
                        @endphp
                        <x-form.checkbox-group type="checkbox" name="tags" label="Tags / Kategori" :options="$tagOptions" />
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label fw-bold small text-uppercase">Isi Konten Artikel</label>
                        <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @error('content') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('articles.index') }}" class="btn btn-md btn-danger">Kembali</a>
                <button type="submit" class="btn btn-md btn-success shadow-sm">
                    <i class="fas fa-save me-1"></i> Simpan Artikel
                </button>
            </div>
        </form>
    </div>

    {{-- Script untuk Text Editor --}}
    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <style>
        /* Mengatur tinggi editor */
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
    @endpush
</x-app-layout>