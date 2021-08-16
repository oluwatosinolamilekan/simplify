
@if (!isset($nested) || !$nested)
    <div class="mt-10 sm:mt-0">
        <div class="mt-6 md:grid md:grid-cols-3 md:gap-6">
            @if(isset($titleSection)) @yield($titleSection) @endif
            <div class="mt-5 md:mt-0 md:col-span-6">
@endif

@if (!isset($partial) || !$partial)
    <form wire:submit.prevent="save">
@endif

 @yield($section)

@if (!isset($partial) || !$partial)
        <!-- Actions -->
        @include('components.forms.form-actions', ['delete' => isset($delete)])
    </form>
@endif

@if (!isset($nested) || !$nested)
            </div>
        </div>
    </div>
@endif
