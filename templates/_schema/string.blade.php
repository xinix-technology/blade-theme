<input class="radius"
    type="text"
    name="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $label }}"
    autocomplete="off"
    {{ (f('controller.method') === 'read') ? 'readonly disabled' : '' }}
/>
