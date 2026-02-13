<div class="page-header">
    <h3 class="fw-bold mb-3">{{ $title }}</h3>

    @if(count($breadcrumbs))
        <ul class="breadcrumbs mb-3">
            @foreach($breadcrumbs as $index => $breadcrumb)
                
                <li class="nav-item {{ $index === 0 ? 'nav-home' : '' }}">
                    
                    @if(isset($breadcrumb['route']))
                        <a href="{{ route($breadcrumb['route']) }}">
                            @if(isset($breadcrumb['icon']))
                                <i class="{{ $breadcrumb['icon'] }}"></i>
                            @endif
                            {{ $breadcrumb['label'] ?? '' }}
                        </a>
                    @else
                        <a href="#">
                            {{ $breadcrumb['label'] ?? '' }}
                        </a>
                    @endif

                </li>

                @if(!$loop->last)
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                @endif

            @endforeach
        </ul>
    @endif
</div>
