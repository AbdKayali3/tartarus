<?php

namespace LaraZeus\Tartarus\Filament\Clusters\System\Resources;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\Chaos\Filament\ChaosResource;
use LaraZeus\Chaos\Forms\Components\MultiLang;
use LaraZeus\Tartarus\Filament\Clusters\System\Resources\TagResource\Pages;
use LaraZeus\Tartarus\TartarusPlugin;
use Spatie\Tags\Tag;

class TagResource extends ChaosResource
{
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return TartarusPlugin::get()->getLabel(__CLASS__);
    }

    public static function getModel(): string
    {
        return config('tags.tag_model');
    }

    public static function canViewAny(): bool
    {
        return ! in_array(static::class, TartarusPlugin::get()->getDisabledResources())
            && parent::canViewAny();
    }

    public static function form(Form $form): Form
    {
        return ChaosResource\ChaosForms::make(
            $form,
            [
                Section::make()
                    ->columns(2)
                    ->schema([
                        MultiLang::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__(static::langFile() . '.name')),
                        /*MultiLang::make('slug')
                            ->live(onBlur: true)
                            ->hidden()
                            ->label(__(static::langFile() . '.slug'))
                            ->unique(ignorable: fn (?Model $record): ?Model => $record)
                            ->required()
                            ->maxLength(255),*/
                        Select::make('type')
                            ->label(__(static::langFile() . '.type'))
                            ->columnSpan(2)
                            ->options(TartarusPlugin::getModel('TagType')),
                    ]),
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return ChaosResource\ChaosTables::make(
            static::class,
            $table,
            [
                TextColumn::make('name')
                    ->toggleable()
                    ->searchable()
                    ->sortable()
                    ->label(__(static::langFile() . '.name')),

                TextColumn::make('type')
                    ->toggleable()
                    ->searchable()
                    ->sortable()
                    ->label(__(static::langFile() . '.type')),
                TextColumn::make('slug')
                    ->toggleable()
                    ->searchable()
                    ->sortable()
                    ->label(__(static::langFile() . '.slug')),
                TextColumn::make('items_count')
                    ->toggleable()
                    ->getStateUsing(
                        function (Tag $record): int {
                            // @phpstan-ignore-next-line
                            return method_exists($record, $record->type?->name)
                                // @phpstan-ignore-next-line
                                ? $record->{$record?->type->name}()->count()
                                : 0;
                        }
                    ),
            ],
            filters: [
                SelectFilter::make('type')
                    ->options(TartarusPlugin::getModel('TagType'))
                    ->label(__(static::langFile() . 'type')),
            ]
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
