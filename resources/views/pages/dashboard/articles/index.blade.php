<x-app-layout>
    <x-slot name="title">Daftar Artikel</x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Artikel</h4>
                    <a href="{{ route('articles.create') }}" class="btn btn-md btn-primary">
                        <i class="bi bi-plus
                            me-1"></i> Tambah Artikel
                    </a>
                </div>
                <div class="card-body">
                    <x-table :headers="['No', 'Judul', 'Penulis', 'Tanggal Dibuat', 'Aksi']">
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->author }}</td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>