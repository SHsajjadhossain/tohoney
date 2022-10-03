@component('mail::message')
# New Offer
# 20% Flat Discount!!

It Apllies On All Products! Click on the bellow button to see all offers

@component('mail::button', ['url' => 'https://www.creativeitinstitute.com/', 'color' => 'success'])
View Offer
@endcomponent

@component('mail::panel')
New products arrived Daily.
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
