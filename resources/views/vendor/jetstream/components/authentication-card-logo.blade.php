<a href="/">
    <img  width="200" src="{{ \App\Models\Setting::where('name', 'logo')->first() ? \App\Models\Setting::where('name', 'logo')->first()->value : ''}}">
</a>
