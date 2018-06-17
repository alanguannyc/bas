@component('mail::message')

@component('mail::panel')
<h4>{{ $user->name }}</h4><p>just regestered an account.</p>
@endcomponent



@component('mail::button', ['url' => 'http://bas.test/admin/member/' . $user->id])

View Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
