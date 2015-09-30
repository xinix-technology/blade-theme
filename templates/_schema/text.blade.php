<textarea class="radius"
    type="text"
    name="{{ $name }}"
    placeholder="{{ $label }}"
    autocomplete="off"
    {{ (f('controller.method') === 'read') ? 'readonly disabled' : '' }}
>{{ $value }}</textarea>
