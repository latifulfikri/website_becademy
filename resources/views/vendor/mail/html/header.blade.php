@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://fikriyuwi.com/assets/becademy/logo-text.png" class="logo" alt="Becademy Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
