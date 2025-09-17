@php
    $keyValues = App\Models\KeyValue::all();
    $icons = [
        'fas fa-handshake',
        'fas fa-smile',
        'fas fa-lightbulb',
        'fas fa-users',
        'fas fa-tools',
        'as fa-user-shield',
    ];
@endphp
<section class="core-values-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="sec-title mb_70 centred sec-title-animation animation-style2">
                    <h2 class="title-animation core-value-title">{{ __('message.core_value') }}</h2>
                </div>
            </div>
            @foreach ($keyValues as $key => $keyValue)
                <div class="col-lg-3 col-md-6">
                    <div class="core-value-item">
                        @if ($key == 0)
                            <i class="flaticon-team {{ $icons[$key] }}"></i> <!-- Icon -->
                        @elseif ($key == 1)
                            <i class="flaticon-team {{ $icons[$key] }}"></i>
                        @elseif ($key == 2)
                            <i class="flaticon-team {{ $icons[$key] }}"></i>
                        @elseif ($key == 3)
                            <i class="flaticon-team {{ $icons[$key] }}"></i>
                        @elseif ($key == 4)
                            <i class="flaticon-team {{ $icons[$key] }}"></i>
                        @else
                            <i class="flaticon-team {{ $icons[$key] }}"></i>
                        @endif
                        <h5>{{ $keyValue->getTranslation('title', app()->getLocale()) }}</h5>
                        <p class="text-justify">{{ $keyValue->getTranslation('description', app()->getLocale()) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
