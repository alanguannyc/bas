@component('mail::message')

This is to confirm that we received your nomination for {{ $nomination->name }} in the category of {{ $nomination->category }}. Please be advised that you may make changes to your nominations, or even add or delete a nominee. You can also confirm your hotel’s nominations by simply checking your online dashboard by following this link:

@component('mail::button', ['url' => 'https://bas.hanyc.org/dashboard'])
View
@endcomponent

Thank you!
@endcomponent
