<x-mail::message>
# Hello {{ $contactData['name'] }},

Thank you for reaching out to **405 Auto Group**. We have successfully received your message regarding your interest in our luxury vehicles and import services.

Our team is reviewing your request and will get back to you within **24 hours**.

<x-mail::panel>
**Summary of your message:**  
> "{{ $contactData['message'] }}"
</x-mail::panel>

Best regards,<br>
**405 Auto Group Team**  
<small>4309 NW 39th St, Oklahoma City, OK 73112</small>
</x-mail::message>