@props(['status'])

@php
    // Mapping status ke warna dan label
    $statusConfig = [
        'pending' => [
            'class' => 'bg-warning text-dark',
            'icon' => 'fa-clock',
            'label' => 'Menunggu',
        ],
        'confirmed' => [
            'class' => 'bg-primary text-white',
            'icon' => 'fa-check-circle',
            'label' => 'Dikonfirmasi',
        ],
        'complete' => [
            'class' => 'bg-success text-white',
            'icon' => 'fa-calendar-check',
            'label' => 'Selesai',
        ],
        'cancelled' => [
            'class' => 'bg-danger text-white',
            'icon' => 'fa-times-circle',
            'label' => 'Dibatalkan',
        ],
    ];

    // Ambil config berdasarkan status, atau gunakan default jika status tidak dikenal
    $config = $statusConfig[$status] ?? [
        'class' => 'bg-secondary text-white',
        'icon' => 'fa-info-circle',
        'label' => ucfirst($status),
    ];
@endphp

<span
    {{ $attributes->merge(['class' => 'badge ' . $config['class'] . ' px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-none']) }}
    style="font-size: 0.75rem; font-weight: 600;">
    <i class="fas {{ $config['icon'] }} me-1"></i>
    {{ $config['label'] }}
</span>
