@if (session('_message') !== null)
    <script>
        alert("{{ session('_message') }}")
    </script>

    @php
        session()->forget('_message');
    @endphp
@endif