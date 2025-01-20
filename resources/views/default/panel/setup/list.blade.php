@extends('panel.layout.app')
@section('title', __('Setup Campaign'))
@section('titlebar_actions')
    @if (!Auth::user()->isAdmin())
        <x-button href="{{ route('dashboard.setup.new') }}">
            {{ __('Create New Setup Request') }}
            <x-tabler-plus class="size-4" />
        </x-button>
    @endif
@endsection
@section('content')
    <div class="py-10">
        <x-table>
            <x-slot:head>
                <tr>
                    <th>
                        {{ __(' ID') }}
                    </th>
                    <th>
                        {{ __('Status') }}
                    </th>
                    <th>
                        {{ __('Post Date') }}
                    </th>
                    <th>
                        {{ __('Campaign') }}
                    </th>
                    <th>
                        {{ __('Subject') }}
                    </th>
                    <th>
                        {{ __('Content') }}
                    </th>
                    <th>
                        {{ __('Image') }}
                    </th>
                   
                    <th class="text-end">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </x-slot:head>
            <x-slot:body>
                @foreach ($items as $entry)
                    <tr>
                        <td>
                            {{ $entry->id }}
                        </td>
                        <td>
                            <x-badge
                                class="text-2xs"
                                variant="{{ $entry->status === 'Answered' ? 'success' : 'secondary' }}"
                            >
                                Unposted
                            </x-badge>
                        </td>
                        <td>
                           
                        {{ __($entry->posted) }}
                            
                        </td>
                        <td>
                            {{ __($entry->campaign_name) }}
                        </td>
                        <td>
                            {{ __($entry->campaign_type) }}
                        </td>
                        <td>
                            {{ __($entry->description) }}
                        </td>
                        <td>
    <img src="{{ $entry->images }}" alt="Image" style="width: 200px;">
                       
                        <td class="whitespace-nowrap text-end">
                            <x-button
                                size="sm"
                                href="{{ route('dashboard.setup.view', $entry->id) }}"
                            >
                                {{ __('EDIT') }}
                            </x-button>
                        </td>
                    </tr>
                @endforeach

            </x-slot:body>
        </x-table>
    </div>
@endsection

@push('script')
    <script src="{{ custom_theme_url('/assets/libs/tom-select/dist/js/tom-select.base.min.js') }}"></script>
    <script src="{{ custom_theme_url('/assets/js/panel/support.js') }}"></script>
@endpush
