<?php

namespace App\Providers\Filament;

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
            ->resources([
                UserResource::class,
                RoleResource::class,
                ServiceResource::class,

                // Контент
                ContactInfoResource::class,
                PartnerResource::class,
                GalleryImageResource::class,
                NewsResource::class,
                PostResource::class,
                CommentResource::class,

                // About / Team / History
                TeamMemberResource::class,
                HistoryEventResource::class,
                CoreValueResource::class,

                // Alumni
                AlumniResource::class,
                TestimonialResource::class,

                // Практика
                PracticeModuleResource::class,
                PracticeScheduleResource::class,
                PracticeResource::class,

                // Program / OPP
                ProgramOverviewResource::class,
                InstructorResource::class,

                // Course Topics
                PracticalCategoryResource::class,
                CourseTopicResource::class,
                CourseRequirementResource::class,

                // Diploma
                DiplomaTopicResource::class,
                DiplomaRequirementResource::class,
                DiplomaTimelineResource::class,
                DiplomaLinkResource::class,

                // FAQ
                FaqResource::class,

                // Survey
                SurveyCategoryResource::class,
                SurveyResponseResource::class,

            ])
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
}
