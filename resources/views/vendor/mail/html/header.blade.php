@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'MockPay')
<img src="{{ asset('logo.png') }}" class="logo" alt="MockPay Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
