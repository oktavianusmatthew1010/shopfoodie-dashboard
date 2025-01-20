@extends('panel.layout.app')
@section('title', __('Setup Requests'))
@section('titlebar_actions')
    @if (!Auth::user()->isAdmin())
        <x-button href="{{ route('dashboard.support.new') }}">
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
                        {{ __('Campaign ID') }}
                    </th>
                    <th>
                        {{ __('Status') }}
                    </th>
                    <th>
                        {{ __('Category') }}
                    </th>
                    <th>
                        {{ __('Subject') }}
                    </th>
                    <th>
                        {{ __('Priority') }}
                    </th>
                    <th>
                        {{ __('Duration') }}
                    </th>
                    <th>
                        {{ __('Frequency') }}
                    </th>
                    <th>
                        {{ __('Platform') }}
                    </th>
                    <th>
                        {{ __('Target') }}
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
                            {{ $entry->ticket_id }}
                        </td>
                        <td>
                            <x-badge
                                class="text-2xs"
                                variant="{{ $entry->status === 'Answered' ? 'success' : 'secondary' }}"
                            >
                                {{ __($entry->status) }}
                            </x-badge>
                        </td>
                        <td>
                            {{ __($entry->category) }}
                        </td>
                        <td>
                            {{ __($entry->subject) }}
                        </td>
                        <td>
                            {{ __($entry->priority) }}
                        </td>
                        <td>
                            {{ $entry->duration }}
                        </td>
                        <td>
                            {{ $entry->frequency }} Times
                        </td>
                        <td>
                            {{ $entry->platform }}
                        </td>
                        <td>
                            {{ $entry->target }}
                        </td>
                        <td class="whitespace-nowrap text-end">
                            <x-button
                                size="sm"
                                href="{{ route('dashboard.support.view', $entry->ticket_id) }}"
                            >
                                {{ __('View') }}
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
