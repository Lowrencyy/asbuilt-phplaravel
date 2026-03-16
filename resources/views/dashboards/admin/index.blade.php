<x-layout>

    <div class="col-span-full">
        Lineman Dashboard - {{ $user->name }} - Subcon: {{ optional($user->subcontractor)->name }}
    </div>

    @push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    @endpush

</x-layout>