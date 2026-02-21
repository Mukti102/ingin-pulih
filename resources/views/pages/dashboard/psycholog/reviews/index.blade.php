<x-app-layout>
    <x-page-header title="Daftar Review" :breadcrumbs="[['label' => '', 'route' => 'dashboard', 'icon' => 'icon-home'], ['label' => 'Daftar Review']]" />

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Ulasan Client</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Booking</th>
                                    <th>Nama Client</th>
                                    <th>Rating</th>
                                    <th>Komentar</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="fw-bold text-primary">{{ $review->booking->code }}</span></td>
                                        <td>{{ $review->booking->user->name }}</td>
                                        <td>
                                            <div class="text-warning">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                @endfor
                                                <span class="text-muted small">({{ $review->rating }})</span>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ Str::limit($review->comment, 50) }}</small>
                                        </td>
                                        <td>
                                            @if($review->published)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="{{ route('reviews.toggle-publish', $review->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $review->published ? 'btn-success' : 'btn-warning' }}" title="{{ $review->published ? 'Jadikan Draft' : 'Publikasikan' }}">
                                                        <i class="fa {{ $review->published ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                                    </button>
                                                </form>

                                                {{-- Delete --}}
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>