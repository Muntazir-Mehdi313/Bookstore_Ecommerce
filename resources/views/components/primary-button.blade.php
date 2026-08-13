<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-add']) }} style="padding: 10px 20px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
    {{ $slot }}
</button>