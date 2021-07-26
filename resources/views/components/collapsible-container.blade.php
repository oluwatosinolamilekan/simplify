<div class="mt-5 md:mt-0 md:col-span-2"  x-data="{
                                                  open: false,
                                                  get isOpen() { return this.open },
                                                  toggle() { this.open = ! this.open },
                                                }">
    <div class="px-4 py-5 text-right sm:p-6 shadow sm:rounded-md">
        <!-- TODO @Sofia: Clicking this button should collapse / expand the form below; Initially it should be hidden -->
{{--        <x-success-anchor @click="toggle()"> + Add </x-success-anchor>--}}
        <x-add-form>
            <x-slot name="buttonName">
               <span  x-text="!open ? 'Add Funding' : 'Cancel Funding' ">
               </span>
            </x-slot>
        </x-add-form>
    </div>
    <div x-show="isOpen">
        {{$form}}
    </div>
</div>
