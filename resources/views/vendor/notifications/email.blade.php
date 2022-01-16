@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Упс!
@else
# Вітання!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
З повагою,<br>Оргкомітет фестивалю Ханіфест
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
    Якщо у вас виникли проблеми з кнопкою "{{ $actionText }}" , скопіюйте посилання в адресний рядок вашого браузера : [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
