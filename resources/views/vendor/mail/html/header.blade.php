@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" class="logo" alt="Logo" loading="lazy">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
