@php
    $state = $getState();

    $stateIcon = $getStateIcon() ?? ($state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle');
    $stateColor = $getStateColor() ?? ($state ? 'success' : 'danger');

    $stateColor = [
        'danger' => 'text-danger-500',
        'primary' => 'text-primary-500',
        'secondary' => 'text-gray-700',
        'success' => 'text-success-500',
        'warning' => 'text-warning-500',
    ][$stateColor] ?? $stateColor;
@endphp

<div class="px-4 py-3">
    @if ($state !== null)
        <x-dynamic-component
            :component="$stateIcon"
            :class="'w-6 h-6' . ' ' . $stateColor"
        />
    @endif
</div>
