<x-app-layout>
    <x-page-header title="Edit Artikel" :breadcrumbs="[
        ['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'],
        ['label' => 'Artikel', 'route' => 'articles.index'],
        ['label' => 'Edit'],
    ]" />

    <div class="row">
        {{-- Form action diarahkan ke update dengan parameter ID artikel --}}
        <form action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data" method="POST"
            class="card">
            @csrf
            @method('PUT') {{-- Method PUT wajib untuk proses update di Laravel --}}

            <div class="card-header">
                <h4 class="card-title">Edit Artikel: {{ $article->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-sm-8 col-12">
                        <x-form.input name="title" label="Judul Artikel" required="true" :value="old('title', $article->title)" />
                    </div>

                    <div class="mb-3 col-sm-4 col-12">
                        <x-form.input name="author" label="Nama Penulis" :value="old('author', $article->author)" />
                    </div>

                    <div class="mb-3 col-sm-6 col-12">
                        <label class="form-label fw-bold small text-uppercase">Thumbnail Artikel</label>

                        {{-- Preview Thumbnail Lama --}}
                        <div class="mb-2">
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="Preview" class="img-thumbnail"
                                style="max-height: 150px;">
                        </div>

                        <input type="file" name="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah thumbnail.</small>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-sm-6 col-12">
                        @php
                            $tagOptions = collect([
                                (object) ['id' => 'kesehatan', 'name' => 'Kesehatan'],
                                (object) ['id' => 'mental-health', 'name' => 'Mental Health'],
                                (object) ['id' => 'tips', 'name' => 'Tips & Trik'],
                                (object) ['id' => 'parenting', 'name' => 'Parenting'],
                            ]);

                            // Ambil tags yang sudah tersimpan (asumsikan sudah dicast ke array di Model)
                            $selectedTags = old('tags', $article->tags ?? []);
                        @endphp
                        <x-form.checkbox-group type="checkbox" name="tags" label="Tags / Kategori" :options="$tagOptions"
                            :selected="$selectedTags" />
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label fw-bold small text-uppercase">Isi Konten Artikel</label>
                        <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('articles.index') }}" class="btn btn-md btn-danger">Batal</a>
                <button type="submit" class="btn btn-md btn-success shadow-sm">
                    <i class="fas fa-save me-1"></i> Perbarui Artikel
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                        'insertTable', 'undo', 'redo'
                    ],
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
        <style>
            .ck-editor__editable {
                min-height: 300px;
            }

            .img-thumbnail {
                border-radius: 8px;
                border: 2px solid #eee;
            }
        </style>
    @endpush
</x-app-layout>
