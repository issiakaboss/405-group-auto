<x-mail::message>
# New Contact Message

You have received a new message from your website contact form.

**Name:** {{ $contactData['name'] }}  
**Email:** {{ $contactData['email'] }}  
**Phone:** {{ $contactData['phone'] }}  

**Message:**  
<x-mail::panel>
{{ $contactData['message'] }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>