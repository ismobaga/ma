<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.settings';

    protected static string | \UnitEnum | null $navigationGroup = 'Configuration';

    protected static ?string $title = 'Paramètres';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Section::make('Informations du site')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Nom du site')
                            ->required(),
                        Forms\Components\TextInput::make('site_tagline')
                            ->label('Slogan'),
                    ])->columns(2),

                Forms\Components\Section::make('Contact')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Numéro WhatsApp')
                            ->placeholder('223XXXXXXXX'),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Téléphone'),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Email')
                            ->email(),
                        Forms\Components\Textarea::make('address')
                            ->label('Adresse'),
                    ])->columns(2),

                Forms\Components\Section::make('Réseaux sociaux')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url(),
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url(),
                    ])->columns(2),

                Forms\Components\Section::make("Page d'accueil — Hero")
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Titre principal'),
                        Forms\Components\TextInput::make('hero_subtitle')
                            ->label('Sous-titre'),
                        Forms\Components\TextInput::make('hero_button_text')
                            ->label('Texte du bouton'),
                        Forms\Components\TextInput::make('hero_button_link')
                            ->label('Lien du bouton'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Paramètres sauvegardés')
            ->success()
            ->send();
    }
}
