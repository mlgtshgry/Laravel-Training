<div class="flex flex-col gap-2 items-center">
    @foreach($keygroups as $keys)
        <div class="flex gap-2 flex-wrap justify-center">
            @foreach ($keys as $key)
                <button type="submit" name="guess" value="{{ $key }}"
                    @disabled(is_array($disabledKeys)? in_array($key,$disabledKeys) : $disabledKeys )
                    class="btn btn-square btn-outline btn-md @if(is_array($disabledKeys) && in_array($key, $disabledKeys)) btn-disabled @endif"
                >
                    {{ $key }}
                </button>
            @endforeach
        </div>
    @endforeach    
</div>