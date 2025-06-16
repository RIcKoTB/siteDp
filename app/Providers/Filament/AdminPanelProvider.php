<?php

namespace App\Providers\Filament;

use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\RoleResource;
use App\Models\PracticeResourcess;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Resources\{ContactInfoResource,
    PartnerResource,
    GalleryImageResource,
    NewsResource,
    PostResource,
    PracticalCategoryResource,
    PracticeResource,
    TeamMemberResource,
    HistoryEventResource,
    CoreValueResource,
    AlumniResource,
    TestimonialResource,
    PracticeModuleResource,
    PracticeScheduleResource,
    ProgramOverviewResource,
    InstructorResource,
    CourseTopicResource,
    CourseRequirementResource,
    DiplomaTopicResource,
    DiplomaRequirementResource,
    DiplomaTimelineResource,
    DiplomaLinkResource,
    FaqResource,
    SurveyCategoryResource,
    CommentResource,
    SurveyResponseResource};

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            // Явна реєстрація ресурсів з правильного неймспейсу
            ->resources($this->discoverResources(app_path('Filament/Resources')))

            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    protected function discoverResources(string $directory): array
    {
        $resources = [];

        foreach (File::allFiles($directory) as $file) {
            $relativePath = $file->getRelativePathname(); // eg: Practical/TestLinkResource.php
            $class = str_replace(['/', '.php'], ['\\', ''], $relativePath);
            $fqcn = 'App\\Filament\\Resources\\' . $class;

            if (class_exists($fqcn) && is_subclass_of($fqcn, \Filament\Resources\Resource::class)) {
                $resources[] = $fqcn;
            }
        }

        return $resources;
    }


}
