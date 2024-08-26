<?php

namespace App\Filament\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login;
use Illuminate\Validation\ValidationException;

class CustomLogin extends Login
{

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getAgenceFormComponent(),
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return
            TextInput::make('login')
            ->label('Nom/Email')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);

}
    protected function getAgenceFormComponent(): Component
    {
        return
            Select::make('agence')
                ->label('Agence')
                ->options([
                    'MBOUDA' => 'MBOUDA',
                    'BAFOUSSAM' => 'BAFOUSSAM',
                    'Dschang'  =>'Dschang',
                    'La_Direction'  =>'La_Direction'
                ])
                ->required()
                ->extraInputAttributes(['tabindex' => 1]);

    }
    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL ) ? 'email' : 'name';

        return [
            //'agence'  => $data['agence'],
            $login_type => $data['login'],
            'password'  => $data['password'],
        ];
    }
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
