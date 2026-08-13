@if(session('success') || session('error'))
    @php $type = session('success') ? 'success' : 'error'; @endphp

    <div id="flashToast" class="toast toast-{{ $type }}">
        {{ session($type) }}
    </div>

    <script>
        setTimeout(function () {
            var toast = document.getElementById('flashToast');
            if (toast) {
                toast.classList.add('toast-hide');
                setTimeout(function () { toast.remove(); }, 400);
            }
        }, 3000);
    </script>
@endif