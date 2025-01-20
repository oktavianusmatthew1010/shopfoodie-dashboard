@php
    $categories = ['Campaign', 'Festival', 'Improvement', 'Feedback', 'Founder Stories'];
    $priorities = ['Low', 'Normal', 'High', 'Critical'];
    $aichat = ['Yes', 'No'];
    $duration = ['1 Month', '2 Month', '3 Month', '6 Month','1 Year'];
    $frequency = ['1', '2', '3', '6','10'];
    $platform = ['Facebook', 'Instagram', 'x', 'Linkied','Tiktok'];
    $holidays = ['Chinese New Year', 'Christmas', 'Happy New Year', 'Diwali','Idul Fitri'];
    

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
                label="{{ __('Support Priority') }}"
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
                id="frequency"
                name="frequency"
                type="select"
                required
                label="{{ __('Setup Frequency') }}"
                size="lg"
            >
                @foreach ($frequencys as $frequency)
                    <option
                        value="{{ $frequency }}"
                        @selected($loop->first)
                    >
                        {{ __($frequency) }}
                    </option>
                @endforeach
            </x-forms.input>
            <x-forms.input
                class:container="w-full"
                id="subject"
                name="subject"
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
@endpush
