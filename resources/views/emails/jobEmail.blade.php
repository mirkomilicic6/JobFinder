@component('mail::message')

Hi, {{$data['friend_name']}}, {{$data['your_name']}} has recommended this job for you. Please follow link for more information.

@component('mail::button', ['url' => $data['jobUrl']])
Follow this link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
