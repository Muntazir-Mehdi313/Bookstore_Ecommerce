<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn']) }} style="padding: 10px 20px; background-color: #e5e7eb; color: #374151; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
    {{ $slot }}
</button>