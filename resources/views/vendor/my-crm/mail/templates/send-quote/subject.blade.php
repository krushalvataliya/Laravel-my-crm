Quote {{ $quote->reference }} from {{ \Kv\MyCrm\Models\Setting::where('name', 'organisation_name')->first()->value }} for {{ $quote->organisation->name ?? null }}.