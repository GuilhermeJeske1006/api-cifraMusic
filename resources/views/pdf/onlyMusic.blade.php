
 <div>
    <h2> {{ $data['title'] }} | {{ $data['singer']['name_singer'] }}</h2>
       {{ $data['bpm'] != null ? 'BPM: ' . $data['bpm'] : ''  }} |
        {{ isset($data['rhythm']['name_rhythm']) ? 'Ritmo:'. $data['rhythm']['name_rhythm'] : '' }}

</div>
<br>
<div>
    {!! $data['lyrics'] !!}
</div>