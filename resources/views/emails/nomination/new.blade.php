@component('mail::message')
Thanks for submitting your nomination {{ $nomination->name }} for {{ $nomination->category }}.

Please check your nominations in your portal.

@component('mail::button', ['url' => 'http://bas.test/dashboard'])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
