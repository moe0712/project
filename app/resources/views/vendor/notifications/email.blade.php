@component('mail::message')
{{-- 挨拶 --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')

@else
# こんにちは！
@endif
@endif

{{-- イントロライン --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- アクションボタン --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- アウトロライン --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- 結びの挨拶 --}}
@if (! empty($salutation))
{{ $salutation }}
@else
よろしくお願いいたします,<br>
{{ config('app.name') }}
@endif

{{-- サブコピー --}}
@isset($actionText)
@slot('subcopy')
「{{ $actionText }}」ボタンをクリックできない場合は、以下のURLをコピーしてブラウザに貼り付けてください。
URL: [{{ $displayableActionUrl }}]({{ $actionUrl }})
@endslot
@endisset
@endcomponent
