@php
    $categories = ['Campaign', 'Festival', 'Public Holiday', 'Thematic Promotion', 'Frequency Of Founder','Special Promote Date'];
    $priorities = ['Low', 'Normal', 'High', 'Critical'];
    $aichat = ['Yes', 'No'];
    $durations = ['-','1 Month', '2 Month', '3 Month', '6 Month','1 Year'];
    $frequencies = ['Daily', 'Weekly', 'Be Weekly', 'Monthly','Yearly'];
    $platforms = ['Facebook', 'Instagram', 'x', 'Linkied','Tiktok'];
    $targets = ['Get More Customers', 'Get More Calls', 'Get More views', 'Get More Booking','Get More Orders'];
    $holidays = ['Chinese New Year', 'Christmas', 'Happy New Year', 'Diwali','Idul Fitri'];
    $menus = ['Set A - Kaya Toast with Butter Set', 'Set B - Kaya Toast with Butter Set', 'Chicken Char Siew Toastwich', 'Fish Otah Toastwich'];
    

@endphp

@extends('panel.layout.app')
@section('title', __('New Setup Request'))
@section('titlebar_actions', '')
@section('titlebar_title', __('Create New Setup Request'))
@section('titlebar_subtitle', __('Create new setup request. We will answer as soon as possible.'))

@section('content')
    <div class="py-10">
        <form
            class="mx-auto flex w-full flex-wrap justify-between gap-y-5 lg:w-5/12"
            id="support_form"
            onsubmit="return sendSupportForm();"
        >
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="category"
                type="select"
                name="category"
                required
                label="{{ __('Support Category') }}"
                size="lg"
            >
                @foreach ($categories as $category)
                    <option
                        value="{{ $category }}"
                        @selected($loop->first)
                    >
                        {{ __($category) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="priority"
                name="priority"
                type="select"
                required
                label="{{ __('Support Priority') }}"
                size="lg"
            >
                @foreach ($priorities as $priority)
                    <option
                        value="{{ $priority }}"
                        @selected($loop->first)
                    >
                        {{ __($priority) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="holiday"
                name="holiday"
                type="select"
                required
                label="{{ __('Public Holiday') }}"
                size="lg"
            >
                @foreach ($holidays as $holiday)
                    <option
                        value="{{ $holiday }}"
                        @selected($loop->first)
                    >
                        {{ __($holiday) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
    class:container="w-full md:w-[48%]"
    id="duration"
    type="select"
    name="duration"
    required
    label="{{ __('Setup Duration') }}"
    size="lg"
>
    @foreach ($durations as $duration)
        <option
            value="{{ $duration }}"
            @selected($loop->first)
        >
            {{ __($duration) }}
        </option>
    @endforeach
</x-forms.input>
            <x-forms.input
    class:container="w-full md:w-[48%]"
    id="calendar_start"
    name="calendar_start"
    type="date"
    label="{{ __('Choose Date for 1 Month Setup') }}"
    size="lg"
/>
<x-forms.input
    class:container="w-full md:w-[48%]"
    id="calendar_end"
    name="calendar_end"
    type="date"
    label="{{ __('Choose Date for 1 Month Setup') }}"
    size="lg"
/>
<x-forms.input
                class:container="w-full"
                id="number"
                name="number"
                placeholder="{{ __('Please enter subject of the support request') }}"
                required
                size="lg"
                label="{{ __('Frequency Number') }}"
            />            
<x-forms.input
                class:container="w-full md:w-[48%]"
                id="frequency"
                type="select"
                name="frequency"
                required
                label="{{ __('Setup Frequency') }}"
                size="lg"
            >
                @foreach ($frequencies as $frequency)
                    <option
                        value="{{ $frequency }}"
                        @selected($loop->first)
                    >
                        {{ __($frequency) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="platform"
                name="platform"
                type="select"
                required
                label="{{ __('Setup Platform') }}"
                size="lg"
            >
                @foreach ($platforms as $platform)
                    <option
                        value="{{ $platform }}"
                        @selected($loop->first)
                    >
                        {{ __($platform) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="target"
                name="target"
                type="select"
                required
                label="{{ __('Setup Target') }}"
                size="lg"
            >
                @foreach ($targets as $target)
                    <option
                        value="{{ $target }}"
                        @selected($loop->first)
                    >
                        {{ __($target) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full md:w-[48%]"
                id="subject"
                name="subject"
                type="select"
                required
                label="{{ __('Choose Menu') }}"
                size="lg"
            >
                @foreach ($menus as $menu)
                    <option
                        value="{{ $menu }}"
                        @selected($loop->first)
                    >
                        {{ __($menu) }}
                    </option>
                @endforeach
            </x-forms.input>
            
            <x-forms.input
                class:container="w-full"
                id="title"
                name="title"
                placeholder="{{ __('Please enter subject of the support request') }}"
                required
                size="lg"
                label="{{ __('Subject') }}"
            />

            <x-forms.input
                class:container="w-full"
                id="message"
                name="message"
                rows="5"
                type="textarea"
                placeholder="{{ __('Please enter your message') }}"
                required
                size="lg"
                label="{{ __('Message') }}"
            />
           
    

            <x-button
                class="w-full"
                id="support_button"
                size="lg"
                type="submit"
            >
                {{ __('Send') }}
            </x-button>
            
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ custom_theme_url('/assets/js/panel/support.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const durationSelect = document.getElementById('duration');
        const calendarInput = document.getElementById('calendar_start');
        const calendarEnd = document.getElementById('calendar_end');

        // Function to toggle calendar visibility based on duration
        function toggleCalendar() {
            if (durationSelect.value === '-') {
                calendarInput.classList.add('hidden'); 
                calendarEnd.classList.add('hidden'); // Show calendar input
            } else {
                calendarInput.classList.remove('hidden'); 
                calendarEnd.classList.remove('hidden');// Hide calendar input
            }
        }

        // Run on page load to handle initial state
        toggleCalendar();

        // Listen for changes in the duration select
        durationSelect.addEventListener('change', toggleCalendar);
    });
</script>
@endpush
