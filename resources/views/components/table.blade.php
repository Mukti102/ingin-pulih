@props(['headers' => []])

<div class="table-responsive shadow-sm rounded">
    <table id="basic-datatables" class="table table-hover align-middle bg-white mb-0">
        <thead class="table-light" >
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="text-uppercase small fw-bold py-3 px-4 text-dark" style="letter-spacing: 0.05em;">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if($slot->isEmpty())
                <tr>
                    <td colspan="{{ count($headers) }}" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox d-block fs-2 mb-2"></i>
                        Tidak ada data yang tersedia.
                    </td>
                </tr>
            @else
                {{ $slot }}
            @endif
        </tbody>
    </table>
</div>

<style>
    /* Agar tampilan tabel lebih modern */
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #f8f9fa;
    }
    .table tbody td {
        padding: 1rem 1.5rem;
        color: #495057;
        border-bottom: 1px solid #f8f9fa;
    }
    .table-hover tbody tr:hover {
        background-color: #fbfcfe;
    }
</style>