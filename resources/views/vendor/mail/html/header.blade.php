@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{-- <img src="{{ asset('assets/img/events-3.jpg') }}" class="logo" alt="Laravel Logo"> --}}
                <img src="https://lpt.poltekharber.ac.id/assets/poltek.png" class="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
