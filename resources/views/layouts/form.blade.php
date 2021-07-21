
@if (!isset($partial) || !$partial)
    <form wire:submit.prevent="save">
@endif

 @yield($section)

@if (!isset($partial) || !$partial)
    <!-- Actions -->
        @include('components.forms.form-actions', ['delete' => false])
    </form>
@endif
