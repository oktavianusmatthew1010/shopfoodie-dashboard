@php
    $categories = ['Campaign', 'Festival', 'Public Holiday', 'Thematic Promotion', 'Frequency Of Founder','Special Promote Date'];
    $priorities = ['Low', 'Normal', 'High', 'Critical'];
    $aichat = ['Yes', 'No'];
    $durations = ['-','1 Month', '2 Month', '3 Month', '6 Month','1 Year'];
    $frequencies = ['1', '2', '3', '6','10'];
    $platforms = ['Facebook', 'Instagram', 'x', 'Linkied','Tiktok'];
    $targets = ['Get More Customers', 'Get More Calls', 'Get More views', 'Get More Booking','Get More Orders'];
    $holidays = ['Chinese New Year', 'Christmas', 'Happy New Year', 'Diwali','Idul Fitri'];
    $menus = ['Set A - Kaya Toast with Butter Set', 'Set B - Kaya Toast with Butter Set', 'Chicken Char Siew Toastwich', 'Fish Otah Toastwich'];
    

@endphp
@extends('panel.layout.app')
@section('title', 'Campaign Request #' . $ticket->id)
@section('titlebar_actions', '')

@section('content')
    <div class="py-10">
        <x-card size="none">
            <div class="flex h-[75vh] overflow-hidden max-md:h-auto max-md:flex-col">
                <div class="w-full">
                <div class="py-10">
        <form
            class="mx-auto flex w-full flex-wrap justify-between gap-y-5 lg:w-5/12"
            id="support_form"
            onsubmit="return sendSupportForm();"
        >
            
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
    id="calendar"
    name="calendar"
    type="date"
    value="{{$ticket->posted}}"
    label="{{ __('Date Post') }}"
    size="lg"
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
                value="{{ $ticket->campaign_name }}"
                size="lg"
                label="{{ __('Subject') }}"
            />

            <x-forms.input
                class:container="w-full"
                id="message"
                name="message"
                rows="5"
                type="textarea"
                placeholder="{{ $ticket->description }}"
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
                {{ __('Edit') }}
            </x-button>
            
        </form>
    </div>
                </div>

                <div class="flex w-1/4 shrink-0 grow-0 flex-col border-s font-medium text-heading-foreground max-md:w-full">
                    <p class="m-0 flex flex-wrap items-center gap-2 border-b px-5 py-4">
                        <x-tabler-ticket class="size-5" />
                        #{{ $ticket->id }}
                    </p>
                    <p class="m-0 flex flex-wrap items-center gap-2 border-b px-5 py-4">
                        <x-tabler-pencil-minus class="size-5" />
                        {{ $ticket->description }}
                    </p>
                    <p class="m-0 flex flex-wrap items-center gap-2 border-b px-5 py-4">
                        <x-tabler-layout-2 class="size-5" />
                        {{ __($ticket->campaign_type) }}
                    </p>
                    <p class="m-0 flex flex-wrap items-center gap-2 border-b px-5 py-4">
                        <x-tabler-chart-bubble class="size-5" />
                        {{ __($ticket->posted) }}
                    </p>
                </div>
            </div>
        </x-card>
    </div>
@endsection

@push('script')
    <script src="{{ custom_theme_url('/assets/js/panel/support.js') }}"></script>
@endpush
