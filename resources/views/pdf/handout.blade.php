<div>
    
</div>
<hr>
@if(isset($data) && is_array($data) && count($data) > 0)
@foreach($data as $music)
<div>
    <h2> {{ $music['title'] ?? '' }} | {{ $music['singer']['name_singer'] ?? '' }}</h2>
    {{ $music['bpm'] ?? '' }} |
    {{ $music['rhythm']['name_rhythm'] ?? '' }}

</div>
<br>
<div>
    {!! $music['lyrics'] ?? '' !!}
</div>
<hr>

@endforeach
@else
<p>No music data available.</p>
@endif