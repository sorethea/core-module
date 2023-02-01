<div>
    {{ $getState() }}
    <x-filament-popover::preview :model="$model"
                                 :view="'your-view-blade'"
                                 :viewData="[]"
                                 :allowHTML="true"
                                 :arrow="false"
                                 :theme="'light'"
                                 :interactive="true"
                                 :placement="'bottom'"
                                 :animation="'shift-away'"
    >
        Show tooltip!
    </x-filament-popover::preview>
</div>
