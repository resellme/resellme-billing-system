<img width="50px" src="{{ \App\Models\Setting::where('name', 'logo')->first() ? \App\Models\Setting::where('name', 'logo')->first()->value : ''}}">
