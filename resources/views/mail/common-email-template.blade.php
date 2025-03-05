@component('mail::message')

{{__('Hello,')}}<br>

{{__('Welcome to ')}} {{$app_name}}.<br>

{{__('Email')}} : {!!$email!!}<br>
 
{{__('Password')}} : {!!$password!!}<br>

Thanks,<br>
{{ config('app.name') }}

@component('mail::footer')
© {{ date('Y') }} {{config('app.name')}}. @lang('All rights reserved.')
@endcomponent

@endcomponent