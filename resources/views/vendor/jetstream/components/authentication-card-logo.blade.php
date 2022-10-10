<a href="/">
    <img src="{{ \App\Models\Setting::where('name', 'logo')->first() ? \App\Models\Setting::where('name', 'logo')->first()->value : ''}}">
</a>
