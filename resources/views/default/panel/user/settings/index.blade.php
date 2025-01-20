@extends('panel.layout.app')
@section('title', __('My Account'))
@php
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $categories = ['Casual', 'Upscale', 'Family-Friendly'];
    
    @endphp
@section('content')
    <div class="py-10">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <form
                        id="user_edit_form"
                        onsubmit="return userProfileSave();"
                        action=""
                        enctype="multipart/form-data"
                    >
                    <div
                        class="mb-4 rounded-xl p-3"
                        style="background-color: rgba(157, 107, 221, 0.1);"
                    >  
                   
                       

                        <x-card
                            class="max-md:text-center"
                            szie="lg"
                        >

                           
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input
                                    class="form-control"
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ $user->name }}"
                                >
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Surname') }}</label>
                                <input
                                    class="form-control"
                                    id="surname"
                                    type="text"
                                    name="surname"
                                    value="{{ $user->surname }}"
                                >
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Phone') }}</label>
                                <input
                                    class="form-control"
                                    id="phone"
                                    data-mask="+0000000000000"
                                    data-mask-visible="true"
                                    type="text"
                                    name="phone"
                                    placeholder="+000000000000"
                                    autocomplete="off"
                                    value="{{ $user->phone }}"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input
                                    class="form-control"
                                    type="email"
                                    value="{{ $user->email }}"
                                    disabled
                                >
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Address Line 1') }}</label>
                                <x-forms.input
                                    id="address"
                                    type="text"
                                    name="address"
                                    value="{{ $user->address }}"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Postal Code') }}</label>
                                <x-forms.input
                                    id="postal"
                                    type="text"
                                    name="postal"
                                    value="{{ $user->postal }}"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('City') }}</label>
                                <x-forms.input
                                    id="city"
                                    type="text"
                                    name="city"
                                    value="{{ $user->city }}"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('State') }}</label>
                                <x-forms.input
                                    id="state"
                                    type="text"
                                    name="state"
                                    value="{{ $user->state }}"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Country') }}</label>
                                <select
                                    class="form-select"
                                    id="country"
                                    type="text"
                                    name="country"
                                >
                                    @include('panel.admin.users.countries')
                                </select>
                            </div>
                            <hr class="my-5">
                            <h4> @lang('Change Password') </h4>
                            <x-alert class="!mt-2 mb-3">
                                <p>
                                    {{ __('Please leave empty if you don’t want to change your password.') }}
                                </p>
                            </x-alert>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Old Password') }}</label>
                                <input
                                    class="form-control"autocomplete="off"
                                    id="old_password"
                                    type="password"
                                    name="old_password"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('New Password') }}</label>
                                <input
                                    class="form-control"autocomplete="off"
                                    id="new_password"
                                    type="password"
                                    name="new_password"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Confirm Your New Password') }}</label>
                                <input
                                    class="form-control"
                                    id="new_password_confirmation"
                                    type="password"
                                    name="new_password_confirmation"
                                    autocomplete="off"
                                />
                            </div>

                           
                        </x-card>
                        <x-card class="mt-5">

                            <h4> Restaurant Detail</h4>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Logo') }}</label>
                                <input
                                    class="form-control"
                                    id="avatar"
                                    type="file"
                                    name="avatar"
                                >
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Restaurant Name') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_name"
                                    type="text"
                                    name="restaurant"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Restaurant Description') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_des"
                                    type="text"
                                    name="restaurant_des"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Restaurant Location') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="text"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Price Range') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="text"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Restaurant Image') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="file"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Founder Name') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="text"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Founder Story') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="text"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="mb-[10px]">
                                <label class="form-label">{{ __('Founder Image') }}</label>
                                <input
                                    class="form-control"
                                    id="restaurant_location"
                                    type="file"
                                    name="restaurant_location"
                                    autocomplete="off"
                                />
                            </div>
                            
                            
                        </x-card>
                        <h1 class="text-lg font-bold mb-4">Brand Voice & Style</h1>
                        <x-forms.input
                class:container="w-full md:w-[48%]"
                id="category"
                type="select"
                name="category"
                required
                label="{{ __('Brand Voice') }}"
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
                        <div class="mb-4">
            <label for="primary_color" class="block text-gray-700 font-medium">Primary Color</label>
            <input type="color" id="primary_color" name="primary_color" class="mt-1 w-full h-10 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="secondary_color" class="block text-gray-700 font-medium">Secondary Color</label>
            <input type="color" id="secondary_color" name="secondary_color" class="mt-1 w-full h-10 border border-gray-300 rounded">
        </div>
                        <x-card class="mt-5">
    <h4>{{ __('Opening Hours') }}</h4>



    @foreach ($days as $day)
        <div class="mb-[10px]">
            <label class="form-label">{{ __($day . ' Opening Hours') }}</label>
            <div class="d-flex gap-3">
                <input
                    class="form-control"
                    id="{{ strtolower($day) }}_open"
                    type="time"
                    name="opening_hours[{{ strtolower($day) }}][open]"
                />
                <input
                    class="form-control"
                    id="{{ strtolower($day) }}_close"
                    type="time"
                    name="opening_hours[{{ strtolower($day) }}][close]"
                />
            </div>
        </div>
    @endforeach
</x-card>
<div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction'],
                defaultView: 'dayGridMonth',
                selectable: true,
                editable: true,
                dateClick: function(info) {
                    let eventTitle = prompt('Enter event title:');
                    
                },
                eventDrop: function(info) {
                    
                },
                eventClick: function(info) {
                   
                }
            });

            calendar.render();
        });
    </script>
                        @if ($app_is_demo and Auth::user()->isAdmin())
                                <a
                                    class="btn btn-primary w-full"
                                    onclick="return toastr.info('Admin settings disabled on Demo version.')"
                                >
                                    {{ __('Save') }}
                                </a>
                            @else
                                <button
                                    class="btn btn-primary w-full"
                                    id="user_edit_button"
                                    form="user_edit_form"
                                >
                                    {{ __('Save') }}
                                </button>
                            @endif
                        
                        <x-card class="mt-5">

                            <h4> @lang('Delete Account') </h4>
                            <p>
                                {{ __('If you no longer want to use your account, you can request to delete it.') }}
                            </p>
                            <div class="col-12">
                                <a
                                    class="btn btn-danger"
                                    href="{{ route('dashboard.user.settings.deleteAccount') }}"
                                >
                                    {{ __('Request Account Deletion') }}
                                </a>
                            </div>
                        </x-card>

                   
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ custom_theme_url('/assets/js/panel/user.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
@endpush
