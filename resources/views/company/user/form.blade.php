@extends('layouts.form', ['partial' => $partial, 'section' => 'companyUser'])
@section('companyUser')

    @if(!$nested)
        <x-jet-section-title>
            <x-slot name="title">{{ __('User Profile Information') }}</x-slot>
            <x-slot name="description">{{ __('Fill account\'s profile information.')}}</x-slot>
        </x-jet-section-title>
    @endif

    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
        <div class="grid grid-cols-6 gap-6">
            @include('company.user.partials.user-form', ['user' => $user, 'editable' => !$userCompanyAccess->exists])
        </div>

        <div class="col-span-6 sm:col-span-6">
            <x-jet-input-error for="userCompanyAccess.user_id" class="mt-3" />
            <x-jet-input-error for="userCompanyAccess.company_id" class="mt-3" />
        </div>

        <x-jet-section-border />

        <div class="grid grid-cols-6 gap-6">
            @include('company.user.partials.company-access-form', ['userCompanyAccess' => $userCompanyAccess])
        </div>

    </div>

@endsection
