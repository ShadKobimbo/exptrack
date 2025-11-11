{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

@component('mail::message')
# Test Email

{{ $messageText }}

If you’re seeing this, your Laravel email setup is working! 🎉

Thanks,<br>
{{ config('app.name') }}
@endcomponent

