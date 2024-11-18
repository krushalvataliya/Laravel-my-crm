<?php

namespace Kv\MyCrm;
use Illuminate\Support\Facades\Auth;
use Dcblogdev\Xero\Models\XeroToken;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Kv\MyCrm\Console\LaravelCrmAddressTypes;
use Kv\MyCrm\Console\LaravelCrmArchive;
use Kv\MyCrm\Console\LaravelCrmContactTypes;
use Kv\MyCrm\Console\LaravelCrmFields;
use Kv\MyCrm\Console\LaravelCrmInstall;
use Kv\MyCrm\Console\LaravelCrmLabels;
use Kv\MyCrm\Console\LaravelCrmOrganisationTypes;
use Kv\MyCrm\Console\LaravelCrmPermissions;
use Kv\MyCrm\Console\LaravelCrmReminders;
use Kv\MyCrm\Console\LaravelCrmUpdate;
use Kv\MyCrm\Console\LaravelCrmXero;
use Kv\MyCrm\Http\Livewire\Components\LiveCall;
use Kv\MyCrm\Http\Livewire\Components\LiveFile;
use Kv\MyCrm\Http\Livewire\Components\LiveLunch;
use Kv\MyCrm\Http\Livewire\Components\LiveMeeting;
use Kv\MyCrm\Http\Livewire\Components\LiveNote;
use Kv\MyCrm\Http\Livewire\Components\LiveTask;
use Kv\MyCrm\Http\Livewire\Fields\CreateOrEdit;
use Kv\MyCrm\Http\Livewire\Integrations\Xero\XeroConnect;
use Kv\MyCrm\Http\Livewire\LiveActivities;
use Kv\MyCrm\Http\Livewire\LiveActivityMenu;
use Kv\MyCrm\Http\Livewire\LiveAddressEdit;
use Kv\MyCrm\Http\Livewire\LiveCalls;
use Kv\MyCrm\Http\Livewire\LiveDealBoard;
use Kv\MyCrm\Http\Livewire\LiveDealForm;
use Kv\MyCrm\Http\Livewire\LiveDeliveryDetails;
use Kv\MyCrm\Http\Livewire\LiveDeliveryItems;
use Kv\MyCrm\Http\Livewire\LiveEmailEdit;
use Kv\MyCrm\Http\Livewire\LiveFiles;
use Kv\MyCrm\Http\Livewire\LiveInvoiceLines;
use Kv\MyCrm\Http\Livewire\LiveLeadBoard;
use Kv\MyCrm\Http\Livewire\LiveLeadForm;
use Kv\MyCrm\Http\Livewire\LiveLunches;
use Kv\MyCrm\Http\Livewire\LiveMeetings;
use Kv\MyCrm\Http\Livewire\LiveNotes;
use Kv\MyCrm\Http\Livewire\LiveOrderForm;
use Kv\MyCrm\Http\Livewire\LiveOrderItems;
use Kv\MyCrm\Http\Livewire\LivePhoneEdit;
use Kv\MyCrm\Http\Livewire\LiveProductForm;
use Kv\MyCrm\Http\Livewire\LivePurchaseOrderLines;
use Kv\MyCrm\Http\Livewire\LiveQuoteBoard;
use Kv\MyCrm\Http\Livewire\LiveQuoteForm;
use Kv\MyCrm\Http\Livewire\LiveQuoteItems;
use Kv\MyCrm\Http\Livewire\LiveRelatedContactOrganisation;
use Kv\MyCrm\Http\Livewire\LiveRelatedContactPerson;
use Kv\MyCrm\Http\Livewire\LiveRelatedPerson;
use Kv\MyCrm\Http\Livewire\LiveTasks;
use Kv\MyCrm\Http\Livewire\NotifyToast;
use Kv\MyCrm\Http\Livewire\PayInvoice;
use Kv\MyCrm\Http\Livewire\SendInvoice;
use Kv\MyCrm\Http\Livewire\SendPurchaseOrder;
use Kv\MyCrm\Http\Livewire\SendQuote;
use Kv\MyCrm\Http\Middleware\Authenticate;
use Kv\MyCrm\Http\Middleware\FormComponentsConfig;
use Kv\MyCrm\Http\Middleware\HasCrmAccess;
use Kv\MyCrm\Http\Middleware\LastOnlineAt;
use Kv\MyCrm\Http\Middleware\LogUsage;
use Kv\MyCrm\Http\Middleware\RouteSubdomain;
use Kv\MyCrm\Http\Middleware\Settings;
use Kv\MyCrm\Http\Middleware\SystemCheck;
use Kv\MyCrm\Http\Middleware\TeamsPermission;
use Kv\MyCrm\Http\Middleware\XeroTenant;
use Kv\MyCrm\Models\Activity;
use Kv\MyCrm\Models\Call;
use Kv\MyCrm\Models\Client;
use Kv\MyCrm\Models\Contact;
use Kv\MyCrm\Models\Deal;
use Kv\MyCrm\Models\Delivery;
use Kv\MyCrm\Models\DeliveryProduct;
use Kv\MyCrm\Models\Email;
use Kv\MyCrm\Models\Field;
use Kv\MyCrm\Models\FieldGroup;
use Kv\MyCrm\Models\FieldModel;
use Kv\MyCrm\Models\FieldOption;
use Kv\MyCrm\Models\FieldValue;
use Kv\MyCrm\Models\File;
use Kv\MyCrm\Models\Invoice;
use Kv\MyCrm\Models\InvoiceLine;
use Kv\MyCrm\Models\Lead;
use Kv\MyCrm\Models\LeadSource;
use Kv\MyCrm\Models\Lunch;
use Kv\MyCrm\Models\Meeting;
use Kv\MyCrm\Models\Note;
use Kv\MyCrm\Models\Order;
use Kv\MyCrm\Models\OrderProduct;
use Kv\MyCrm\Models\Organisation;
use Kv\MyCrm\Models\Person;
use Kv\MyCrm\Models\Phone;
use Kv\MyCrm\Models\Pipeline;
use Kv\MyCrm\Models\PipelineStage;
use Kv\MyCrm\Models\PipelineStageProbability;
use Kv\MyCrm\Models\Product;
use Kv\MyCrm\Models\ProductPrice;
use Kv\MyCrm\Models\PurchaseOrder;
use Kv\MyCrm\Models\PurchaseOrderLine;
use Kv\MyCrm\Models\Quote;
use Kv\MyCrm\Models\QuoteProduct;
use Kv\MyCrm\Models\Setting;
use Kv\MyCrm\Models\Task;
use Kv\MyCrm\Models\XeroContact;
use Kv\MyCrm\Models\XeroInvoice;
use Kv\MyCrm\Models\XeroItem;
use Kv\MyCrm\Models\XeroPerson;
use Kv\MyCrm\Models\XeroPurchaseOrder;
use Kv\MyCrm\Observers\ActivityObserver;
use Kv\MyCrm\Observers\CallObserver;
use Kv\MyCrm\Observers\ClientObserver;
use Kv\MyCrm\Observers\ContactObserver;
use Kv\MyCrm\Observers\DealObserver;
use Kv\MyCrm\Observers\DeliveryObserver;
use Kv\MyCrm\Observers\DeliveryProductObserver;
use Kv\MyCrm\Observers\EmailObserver;
use Kv\MyCrm\Observers\FieldGroupObserver;
use Kv\MyCrm\Observers\FieldModelObserver;
use Kv\MyCrm\Observers\FieldObserver;
use Kv\MyCrm\Observers\FieldOptionObserver;
use Kv\MyCrm\Observers\FieldValueObserver;
use Kv\MyCrm\Observers\FileObserver;
use Kv\MyCrm\Observers\InvoiceLineObserver;
use Kv\MyCrm\Observers\InvoiceObserver;
use Kv\MyCrm\Observers\LeadObserver;
use Kv\MyCrm\Observers\LeadSourceObserver;
use Kv\MyCrm\Observers\LunchObserver;
use Kv\MyCrm\Observers\MeetingObserver;
use Kv\MyCrm\Observers\NoteObserver;
use Kv\MyCrm\Observers\OrderObserver;
use Kv\MyCrm\Observers\OrderProductObserver;
use Kv\MyCrm\Observers\OrganisationObserver;
use Kv\MyCrm\Observers\PersonObserver;
use Kv\MyCrm\Observers\PhoneObserver;
use Kv\MyCrm\Observers\PipelineObserver;
use Kv\MyCrm\Observers\PipelineStageObserver;
use Kv\MyCrm\Observers\PipelineStageProbabilityObserver;
use Kv\MyCrm\Observers\ProductObserver;
use Kv\MyCrm\Observers\ProductPriceObserver;
use Kv\MyCrm\Observers\PurchaseOrderLineObserver;
use Kv\MyCrm\Observers\PurchaseOrderObserver;
use Kv\MyCrm\Observers\QuoteObserver;
use Kv\MyCrm\Observers\QuoteProductObserver;
use Kv\MyCrm\Observers\SettingObserver;
use Kv\MyCrm\Observers\TaskObserver;
use Kv\MyCrm\Observers\TeamObserver;
use Kv\MyCrm\Observers\UserObserver;
use Kv\MyCrm\Observers\XeroContactObserver;
use Kv\MyCrm\Observers\XeroInvoiceObserver;
use Kv\MyCrm\Observers\XeroItemObserver;
use Kv\MyCrm\Observers\XeroPersonObserver;
use Kv\MyCrm\Observers\XeroTokenObserver;
use Kv\MyCrm\View\Composers\SettingsComposer;
use Kv\MyCrm\Observers\XeroPurchaseOrderObserver;

class MyCrmServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => \Kv\MyCrm\Policies\UserPolicy::class,
        'App\Models\User' => \Kv\MyCrm\Policies\UserPolicy::class,
        'Kv\MyCrm\Models\Team' => \Kv\MyCrm\Policies\TeamPolicy::class,
        'Kv\MyCrm\Models\Setting' => \Kv\MyCrm\Policies\SettingPolicy::class,
        'Kv\MyCrm\Models\Role' => \Kv\MyCrm\Policies\RolePolicy::class,
        'Kv\MyCrm\Models\Permission' => \Kv\MyCrm\Policies\PermissionPolicy::class,
        'Kv\MyCrm\Models\Lead' => \Kv\MyCrm\Policies\LeadPolicy::class,
        'Kv\MyCrm\Models\Deal' => \Kv\MyCrm\Policies\DealPolicy::class,
        'Kv\MyCrm\Models\Quote' => \Kv\MyCrm\Policies\QuotePolicy::class,
        'Kv\MyCrm\Models\Order' => \Kv\MyCrm\Policies\OrderPolicy::class,
        'Kv\MyCrm\Models\Invoice' => \Kv\MyCrm\Policies\InvoicePolicy::class,
        'Kv\MyCrm\Models\Client' => \Kv\MyCrm\Policies\ClientPolicy::class,
        'Kv\MyCrm\Models\Person' => \Kv\MyCrm\Policies\PersonPolicy::class,
        'Kv\MyCrm\Models\Organisation' => \Kv\MyCrm\Policies\OrganisationPolicy::class,
        'Kv\MyCrm\Models\Contact' => \Kv\MyCrm\Policies\ContactPolicy::class,
        'Kv\MyCrm\Models\Product' => \Kv\MyCrm\Policies\ProductPolicy::class,
        'Kv\MyCrm\Models\ProductCategory' => \Kv\MyCrm\Policies\ProductCategoryPolicy::class,
        'Kv\MyCrm\Models\TaxRate' => \Kv\MyCrm\Policies\TaxRatePolicy::class,
        'Kv\MyCrm\Models\Label' => \Kv\MyCrm\Policies\LabelPolicy::class,
        'Kv\MyCrm\Models\Task' => \Kv\MyCrm\Policies\TaskPolicy::class,
        'Kv\MyCrm\Models\Note' => \Kv\MyCrm\Policies\NotePolicy::class,
        'Kv\MyCrm\Models\Call' => \Kv\MyCrm\Policies\CallPolicy::class,
        'Kv\MyCrm\Models\Meeting' => \Kv\MyCrm\Policies\MeetingPolicy::class,
        'Kv\MyCrm\Models\Lunch' => \Kv\MyCrm\Policies\LunchPolicy::class,
        'Kv\MyCrm\Models\File' => \Kv\MyCrm\Policies\FilePolicy::class,
        'Kv\MyCrm\Models\Field' => \Kv\MyCrm\Policies\FieldPolicy::class,
        'Kv\MyCrm\Models\FieldGroup' => \Kv\MyCrm\Policies\FieldGroupPolicy::class,
        'Kv\MyCrm\Models\FieldOption' => \Kv\MyCrm\Policies\FieldOptionPolicy::class,
        'Kv\MyCrm\Models\Delivery' => \Kv\MyCrm\Policies\DeliveryPolicy::class,
        'Kv\MyCrm\Models\PurchaseOrder' => \Kv\MyCrm\Policies\PurchaseOrderPolicy::class,
        'Kv\MyCrm\Models\Pipeline' => \Kv\MyCrm\Policies\PipelinePolicy::class,
        'Kv\MyCrm\Models\PipelineStage' => \Kv\MyCrm\Policies\PipelineStagePolicy::class,
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot(Router $router, Filesystem $filesystem)
    {
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        Paginator::useBootstrap();

        if ((app()->version() >= 8 && class_exists('App\Models\User')) || (class_exists('App\Models\User') && ! class_exists('App\User'))) {
            class_alias(config("auth.providers.users.model"), 'App\User');
            if (class_exists('App\Models\Team')) {
                class_alias('App\Models\Team', 'App\Team');
            }
        }
        $this->registerPolicies();

        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'my-crm');
        // TBC: BS or TW mode, setting on config
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'my-crm');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        require_once __DIR__ . '/Http/Helpers/SelectOptions.php';
        require_once __DIR__ . '/Http/Helpers/PersonName.php';
        require_once __DIR__ . '/Http/Helpers/AddressLine.php';
        require_once __DIR__ . '/Http/Helpers/AutoComplete.php';
        require_once __DIR__ . '/Http/Helpers/CheckAmount.php';
        require_once __DIR__ . '/Http/Helpers/Validate.php';
        // Middleware
        $router->aliasMiddleware('auth.my-crm', Authenticate::class);

        if (config('my-crm.teams')) {
            $router->pushMiddlewareToGroup('web', TeamsPermission::class);
            $router->pushMiddlewareToGroup('crm-api', TeamsPermission::class);
            $router->pushMiddlewareToGroup('web', XeroTenant::class);
            $router->pushMiddlewareToGroup('crm-api', XeroTenant::class);
        }

        if(config('my-crm.route_subdomain')) {
            $router->pushMiddlewareToGroup('crm', RouteSubdomain::class);
        }

        $router->pushMiddlewareToGroup('crm', Settings::class);
        $router->pushMiddlewareToGroup('crm-api', Settings::class);
        $router->pushMiddlewareToGroup('crm', HasCrmAccess::class);
        $router->pushMiddlewareToGroup('crm-api', HasCrmAccess::class);
        $router->pushMiddlewareToGroup('crm', LastOnlineAt::class);
        $router->pushMiddlewareToGroup('crm', SystemCheck::class);
        $router->pushMiddlewareToGroup('crm', LogUsage::class);
        $router->pushMiddlewareToGroup('crm-api', LogUsage::class);
        $router->pushMiddlewareToGroup('crm', FormComponentsConfig::class);
        $router->pushMiddlewareToGroup('web', FormComponentsConfig::class);

        $this->registerRoutes();

        // Register Observers
        Lead::observe(LeadObserver::class);
        LeadSource::observe(LeadSourceObserver::class);
        Deal::observe(DealObserver::class);
        Quote::observe(QuoteObserver::class);
        QuoteProduct::observe(QuoteProductObserver::class);
        Order::observe(OrderObserver::class);
        OrderProduct::observe(OrderProductObserver::class);
        Invoice::observe(InvoiceObserver::class);
        InvoiceLine::observe(InvoiceLineObserver::class);
        Client::observe(ClientObserver::class);
        Person::observe(PersonObserver::class);
        Organisation::observe(OrganisationObserver::class);
        Phone::observe(PhoneObserver::class);
        Email::observe(EmailObserver::class);
        Product::observe(ProductObserver::class);
        ProductPrice::observe(ProductPriceObserver::class);
        Setting::observe(SettingObserver::class);
        Note::observe(NoteObserver::class);
        File::observe(FileObserver::class);
        Contact::observe(ContactObserver::class);
        XeroItem::observe(XeroItemObserver::class);
        XeroContact::observe(XeroContactObserver::class);
        XeroPerson::observe(XeroPersonObserver::class);
        XeroInvoice::observe(XeroInvoiceObserver::class);
        Task::observe(TaskObserver::class);
        Activity::observe(ActivityObserver::class);
        // XeroToken::observe(XeroTokenObserver::class);
        Call::observe(CallObserver::class);
        Meeting::observe(MeetingObserver::class);
        Lunch::observe(LunchObserver::class);
        Field::observe(FieldObserver::class);
        FieldGroup::observe(FieldGroupObserver::class);
        FieldOption::observe(FieldOptionObserver::class);
        FieldModel::observe(FieldModelObserver::class);
        FieldValue::observe(FieldValueObserver::class);
        Delivery::observe(DeliveryObserver::class);
        DeliveryProduct::observe(DeliveryProductObserver::class);
        PurchaseOrder::observe(PurchaseOrderObserver::class);
        PurchaseOrderLine::observe(PurchaseOrderLineObserver::class);
        XeroPurchaseOrder::observe(XeroPurchaseOrderObserver::class);
        Pipeline::observe(PipelineObserver::class);
        PipelineStage::observe(PipelineStageObserver::class);
        PipelineStageProbability::observe(PipelineStageProbabilityObserver::class);

        if (class_exists('App\Models\User')) {
            \App\Models\User::observe(UserObserver::class);
        } else {
            \App\User::observe(UserObserver::class);
        }

        if (class_exists('App\Models\Team')) {
            \App\Models\Team::observe(TeamObserver::class);
        } elseif (class_exists('App\Team')) {
            \App\Team::observe(TeamObserver::class);
        }

        // Paginate on Collection
        if (! Collection::hasMacro('paginate')) {
            Collection::macro(
                'paginate',
                function ($perPage = 30, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage),
                        $this->count(),
                        $perPage,
                        $page,
                        $options
                    ))
                        ->withPath('');
                }
            );
        }

        if ($this->app->runningInConsole()) {
            if (app()->version() >= 8.6) {
                $auditConfig = '/../config/audit-sanctum.php';
            } else {
                $auditConfig = '/../config/audit.php';
            }

            $this->publishes([
                __DIR__ . '/../config/my-crm.php' => config_path('my-crm.php'),
                __DIR__ . '/../config/permission.php' => config_path('permission.php'),
                __DIR__ . $auditConfig => config_path('audit.php'),
                __DIR__ . '/../config/columnsortable.php' => config_path('columnsortable.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/my-crm'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/my-crm'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/my-crm'),
            ], 'lang');

            // Publishing the migrations.
            $this->publishes([
                __DIR__ . '/../database/migrations/create_permission_tables.php.stub' => $this->getMigrationFileName($filesystem, 'create_permission_tables.php', 1), // Spatie Permissions
                __DIR__ . '/../database/migrations/add_teams_fields.php.stub' => $this->getMigrationFileName($filesystem, 'add_teams_fields.php', 2), // Spatie Permissions
                __DIR__ . '/../database/migrations/create_laravel_crm_tables.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_tables.php', 3),
                __DIR__ . '/../database/migrations/create_laravel_crm_settings_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_settings_table.php', 4),
                __DIR__ . '/../database/migrations/add_fields_to_roles_permissions_tables.php.stub' => $this->getMigrationFileName($filesystem, 'add_fields_to_roles_permissions_tables.php', 5),
                __DIR__ . '/../database/migrations/add_label_editable_fields_to_laravel_crm_settings_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_label_editable_fields_to_laravel_crm_settings_table.php', 6),
                __DIR__ . '/../database/migrations/add_team_id_to_laravel_crm_tables.php.stub' => $this->getMigrationFileName($filesystem, 'add_team_id_to_laravel_crm_tables.php', 7),
                __DIR__ . '/../database/migrations/create_laravel_crm_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_products_table.php', 8),
                __DIR__ . '/../database/migrations/create_laravel_crm_product_categories_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_product_categories_table.php', 9),
                __DIR__ . '/../database/migrations/create_laravel_crm_product_prices_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_product_prices_table.php', 10),
                __DIR__ . '/../database/migrations/create_laravel_crm_product_variations_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_product_variations_table.php', 11),
                __DIR__ . '/../database/migrations/create_laravel_crm_deal_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_deal_products_table.php', 12),
                __DIR__ . '/../database/migrations/add_global_to_laravel_crm_settings_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_global_to_laravel_crm_settings_table.php', 13),
                __DIR__ . '/../database/migrations/alter_fields_for_encryption_on_laravel_crm_tables.php.stub' => $this->getMigrationFileName($filesystem, 'alter_fields_for_encryption_on_laravel_crm_tables.php', 14),
                __DIR__ . '/../database/migrations/create_laravel_crm_address_types_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_address_types_table.php', 15),
                __DIR__ . '/../database/migrations/alter_type_on_laravel_crm_phones_table.php.stub' => $this->getMigrationFileName($filesystem, 'alter_type_on_laravel_crm_phones_table.php', 16),
                __DIR__ . '/../database/migrations/add_description_to_laravel_crm_labels_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_description_to_laravel_crm_labels_table.php', 17),
                __DIR__ . '/../database/migrations/add_name_to_laravel_crm_addresses_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_name_to_laravel_crm_addresses_table.php', 18),
                __DIR__ . '/../database/migrations/create_laravel_crm_contacts_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_contacts_table.php', 19),
                __DIR__ . '/../database/migrations/create_laravel_crm_contact_types_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_contact_types_table.php', 20),
                __DIR__ . '/../database/migrations/create_laravel_crm_contact_contact_type_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_contact_contact_type_table.php', 21),
                __DIR__ . '/../database/migrations/create_audits_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_audits_table.php', 22), // Laravel auditing
                __DIR__ . '/../database/migrations/create_devices_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_devices_table.php', 23), // Laravel Auth Checker
                __DIR__ . '/../database/migrations/create_logins_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_logins_table.php', 24), // Laravel Auth Checker
                __DIR__ . '/../database/migrations/update_logins_and_devices_table_user_relation.php.stub' => $this->getMigrationFileName($filesystem, 'update_logins_and_devices_table_user_relation.php', 25), // Laravel Auth Checker
                __DIR__ . '/../database/migrations/create_laravel_crm_organisation_types_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_organisation_types_table.php', 26),
                __DIR__ . '/../database/migrations/change_morph_col_names_on_laravel_crm_notes_table.php.stub' => $this->getMigrationFileName($filesystem, 'change_morph_col_names_on_laravel_crm_notes_table.php', 27),
                __DIR__ . '/../database/migrations/add_related_note_to_laravel_crm_notes_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_related_note_to_laravel_crm_notes_table.php', 28),
                __DIR__ . '/../database/migrations/add_noted_at_to_laravel_crm_notes_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_noted_at_to_laravel_crm_notes_table.php', 29),
                __DIR__ . '/../database/migrations/create_laravel_crm_quotes_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_quotes_table.php', 30),
                __DIR__ . '/../database/migrations/create_laravel_crm_quote_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_quote_products_table.php', 31),
                __DIR__ . '/../database/migrations/create_laravel_crm_files_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_files_table.php', 32),
                __DIR__ . '/../database/migrations/add_mime_to_laravel_crm_files_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_mime_to_laravel_crm_files_table.php', 33),
                __DIR__ . '/../database/migrations/create_xero_tokens_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_xero_tokens_table.php', 34),
                __DIR__ . '/../database/migrations/create_laravel_crm_xero_items_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_xero_items_table.php', 35),
                __DIR__ . '/../database/migrations/create_laravel_crm_xero_contacts_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_xero_contacts_table.php', 36),
                __DIR__ . '/../database/migrations/create_laravel_crm_xero_people_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_xero_people_table.php', 37),
                __DIR__ . '/../database/migrations/add_reference_to_laravel_crm_quotes_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_reference_to_laravel_crm_quotes_table.php', 38),
                __DIR__ . '/../database/migrations/create_laravel_crm_tasks_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_tasks_table.php', 39),
                __DIR__ . '/../database/migrations/add_deleted_at_to_laravel_crm_activities_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_deleted_at_to_laravel_crm_activities_table.php', 40),
                __DIR__ . '/../database/migrations/create_laravel_crm_timezones_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_timezones_table.php', 41),
                __DIR__ . '/../database/migrations/add_team_id_to_xero_tokens_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_team_id_to_xero_tokens_table.php', 42),
                __DIR__ . '/../database/migrations/create_laravel_crm_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_orders_table.php', 43),
                __DIR__ . '/../database/migrations/create_laravel_crm_order_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_order_products_table.php', 44),
                __DIR__ . '/../database/migrations/create_laravel_crm_invoices_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_invoices_table.php', 45),
                __DIR__ . '/../database/migrations/create_laravel_crm_invoice_lines_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_invoice_lines_table.php', 46),
                __DIR__ . '/../database/migrations/add_reference_to_laravel_crm_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_reference_to_laravel_crm_orders_table.php', 47),
                __DIR__ . '/../database/migrations/create_laravel_crm_calls_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_calls_table.php', 48),
                __DIR__ . '/../database/migrations/create_laravel_crm_meetings_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_meetings_table.php', 49),
                __DIR__ . '/../database/migrations/create_laravel_crm_lunches_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_lunches_table.php', 50),
                __DIR__ . '/../database/migrations/add_location_to_laravel_crm_activities_tables.php.stub' => $this->getMigrationFileName($filesystem, 'add_location_to_laravel_crm_activities_table.php', 51),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_invoices_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_invoices_table.php', 52),
                __DIR__ . '/../database/migrations/create_laravel_crm_usage_requests_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_usage_requests_table.php', 53),
                __DIR__ . '/../database/migrations/add_label_type_to_laravel_crm_fields_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_label_type_to_laravel_crm_fields_table.php', 54),
                __DIR__ . '/../database/migrations/create_laravel_crm_field_models_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_field_models_table.php', 55),
                __DIR__ . '/../database/migrations/create_laravel_crm_field_groups_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_field_groups_table.php', 56),
                __DIR__ . '/../database/migrations/add_team_id_to_laravel_crm_usage_requests_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_team_id_to_laravel_crm_usage_requests_table.php', 57),
                __DIR__ . '/../database/migrations/alter_field_group_id_on_laravel_crm_fields_table.php.stub' => $this->getMigrationFileName($filesystem, 'alter_field_group_id_on_laravel_crm_fields_table.php', 58),
                __DIR__ . '/../database/migrations/add_system_to_laravel_crm_fields_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_system_to_laravel_crm_fields_table.php', 59),
                __DIR__ . '/../database/migrations/add_comments_to_laravel_crm_quote_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_comments_to_laravel_crm_quote_products_table.php', 60),
                __DIR__ . '/../database/migrations/add_comments_to_laravel_crm_order_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_comments_to_laravel_crm_order_products_table.php', 61),
                __DIR__ . '/../database/migrations/create_laravel_crm_deliveries_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_deliveries_table.php', 62),
                __DIR__ . '/../database/migrations/create_laravel_crm_delivery_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_delivery_products_table.php', 63),
                __DIR__ . '/../database/migrations/alter_url_on_laravel_crm_usage_requests_table.php.stub' => $this->getMigrationFileName($filesystem, 'alter_url_on_laravel_crm_usage_requests_table.php', 64),
                __DIR__ . '/../database/migrations/create_laravel_crm_clients_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_clients_table.php', 65),
                __DIR__ . '/../database/migrations/create_laravel_crm_xero_invoices_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_xero_invoices_table.php', 66),
                __DIR__ . '/../database/migrations/add_contact_to_laravel_crm_addresses_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_contact_to_laravel_crm_addresses_table.php', 67),
                __DIR__ . '/../database/migrations/add_phone_to_laravel_crm_addresses_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_phone_to_laravel_crm_addresses_table.php', 68),
                __DIR__ . '/../database/migrations/add_name_to_laravel_crm_clients_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_name_to_laravel_crm_clients_table.php', 69),
                __DIR__ . '/../database/migrations/add_delivery_dates_to_laravel_crm_deliveries_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_delivery_dates_to_laravel_crm_deliveries_table.php', 70),
                __DIR__ . '/../database/migrations/add_client_to_laravel_crm_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_client_to_laravel_crm_orders_table.php', 71),
                __DIR__ . '/../database/migrations/add_client_to_laravel_crm_leads_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_client_to_laravel_crm_leads_table.php', 72),
                __DIR__ . '/../database/migrations/add_client_to_laravel_crm_deals_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_client_to_laravel_crm_deals_table.php', 73),
                __DIR__ . '/../database/migrations/add_client_to_laravel_crm_quotes_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_client_to_laravel_crm_quotes_table.php', 74),
                __DIR__ . '/../database/migrations/add_account_codes_to_laravel_crm_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_account_codes_to_laravel_crm_products_table.php', 75),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_quotes_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_quotes_table.php', 76),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_orders_table.php', 77),
                __DIR__ . '/../database/migrations/add_quote_product_id_to_laravel_crm_order_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_quote_product_id_to_laravel_crm_order_products_table.php', 78),
                __DIR__ . '/../database/migrations/add_quantity_to_laravel_crm_delivery_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_quantity_to_laravel_crm_delivery_products_table.php', 79),
                __DIR__ . '/../database/migrations/create_laravel_crm_tax_rates_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_tax_rates_table.php', 80),
                __DIR__ . '/../database/migrations/add_order_product_id_to_laravel_crm_invoice_lines_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_order_product_id_to_laravel_crm_invoice_lines_table.php', 81),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_deliveries_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_deliveries_table.php', 82),
                __DIR__ . '/../database/migrations/alter_value_on_laravel_crm_field_values_table.php.stub' => $this->getMigrationFileName($filesystem, 'alter_value_on_laravel_crm_field_values_table.php', 83),
                __DIR__ . '/../database/migrations/add_comments_to_laravel_crm_invoice_lines_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_comments_to_laravel_crm_invoice_lines_table.php', 84),
                __DIR__ . '/../database/migrations/add_default_to_laravel_crm_tax_rates_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_default_to_laravel_crm_tax_rates_table.php', 85),
                __DIR__ . '/../database/migrations/create_laravel_crm_industries_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_industries_table.php', 86),
                __DIR__ . '/../database/migrations/add_extra_fields_to_laravel_crm_organisations_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_extra_fields_to_laravel_crm_organisations_table.php', 87),
                __DIR__ . '/../database/migrations/create_laravel_crm_purchase_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_purchase_orders_table.php', 88),
                __DIR__ . '/../database/migrations/create_laravel_crm_purchase_order_lines_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_purchase_order_lines_table.php', 89),
                __DIR__ . '/../database/migrations/create_laravel_crm_xero_purchase_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_xero_purchase_orders_table.php', 90),
                __DIR__ . '/../database/migrations/add_tax_type_to_laravel_crm_tax_rates_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_tax_type_to_laravel_crm_tax_rates_table.php', 91),
                __DIR__ . '/../database/migrations/add_barcode_to_laravel_crm_products_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_barcode_to_laravel_crm_products_table.php', 92),
                __DIR__ . '/../database/migrations/create_laravel_crm_field_options_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_field_options_table.php', 93),
                __DIR__ . '/../database/migrations/alter_type_on_laravel_crm_fields_table.php.stub' => $this->getMigrationFileName($filesystem, 'alter_type_on_laravel_crm_fields_table.php', 94),
                __DIR__ . '/../database/migrations/add_soft_delete_to_laravel_crm_field_values_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_soft_delete_to_laravel_crm_field_values_table.php', 95),
                __DIR__ . '/../database/migrations/add_terms_to_laravel_crm_purchase_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_terms_to_laravel_crm_purchase_orders_table.php', 96),
                __DIR__ . '/../database/migrations/add_delivery_type_to_laravel_crm_purchase_orders_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_delivery_type_to_laravel_crm_purchase_orders_table.php', 97),
                __DIR__ . '/../database/migrations/create_laravel_crm_pipelines_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_pipelines_table.php', 98),
                __DIR__ . '/../database/migrations/create_laravel_crm_pipeline_stage_probabilities_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_pipeline_stage_probabilities_table.php', 99),
                __DIR__ . '/../database/migrations/create_laravel_crm_pipeline_stages_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_laravel_crm_pipeline_stages_table.php', 100),
                __DIR__ . '/../database/migrations/add_pipeline_to_laravel_crm_models_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_pipeline_to_laravel_crm_models_table.php', 101),
                __DIR__ . '/../database/migrations/add_user_to_laravel_crm_settings_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_user_to_laravel_crm_settings_table.php', 102),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_leads_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_leads_table.php', 103),
                __DIR__ . '/../database/migrations/add_prefix_to_laravel_crm_deals_table.php.stub' => $this->getMigrationFileName($filesystem, 'add_prefix_to_laravel_crm_deals_table.php', 104),
            ], 'migrations');

            // Publishing the seeders
            if (! class_exists('LaravelCrmTablesSeeder')) {
                if (app()->version() >= 8) {
                    $this->publishes([
                        __DIR__ . '/../database/seeders/LaravelCrmTablesSeeder.php' => database_path(
                            'seeders/LaravelCrmTablesSeeder.php'
                        ),
                    ], 'seeders');
                } else {
                    $this->publishes([
                        __DIR__ . '/../database/seeders/LaravelCrmTablesSeeder.php' => database_path(
                            'seeds/LaravelCrmTablesSeeder.php'
                        ),
                    ], 'seeders');
                }
            }

            // Registering package commands.
            $this->commands([
                LaravelCrmInstall::class,
                LaravelCrmUpdate::class,
                LaravelCrmPermissions::class,
                LaravelCrmLabels::class,
                LaravelCrmAddressTypes::class,
                LaravelCrmOrganisationTypes::class,
                LaravelCrmXero::class,
                LaravelCrmReminders::class,
                LaravelCrmContactTypes::class,
                LaravelCrmFields::class,
                LaravelCrmArchive::class,
            ]);

            // Register the model factories
            if (app()->version() < 8) {
                $this->app->make('Illuminate\Database\Eloquent\Factory')
                     ->load(__DIR__.'/../database/factories');
            }
        }

        // Livewire components
        Livewire::component('phone-edit', LivePhoneEdit::class);
        Livewire::component('email-edit', LiveEmailEdit::class);
        Livewire::component('address-edit', LiveAddressEdit::class);
        Livewire::component('notes', LiveNotes::class);
        Livewire::component('note', LiveNote::class);
        Livewire::component('tasks', LiveTasks::class);
        Livewire::component('task', LiveTask::class);
        Livewire::component('calls', LiveCalls::class);
        Livewire::component('call', LiveCall::class);
        Livewire::component('meetings', LiveMeetings::class);
        Livewire::component('meeting', LiveMeeting::class);
        Livewire::component('lunches', LiveLunches::class);
        Livewire::component('lunch', LiveLunch::class);
        Livewire::component('files', LiveFiles::class);
        Livewire::component('file', LiveFile::class);
        Livewire::component('related-contact-organisations', LiveRelatedContactOrganisation::class);
        Livewire::component('related-contact-people', LiveRelatedContactPerson::class);
        Livewire::component('related-people', LiveRelatedPerson::class);
        Livewire::component('live-lead-form', LiveLeadForm::class);
        Livewire::component('live-lead-board', LiveLeadBoard::class);
        Livewire::component('deal-form', LiveDealForm::class);
        Livewire::component('live-deal-board', LiveDealBoard::class);
        Livewire::component('quote-form', LiveQuoteForm::class);
        Livewire::component('live-quote-board', LiveQuoteBoard::class);
        Livewire::component('notify-toast', NotifyToast::class);
        Livewire::component('quote-items', LiveQuoteItems::class);
        Livewire::component('order-form', LiveOrderForm::class);
        Livewire::component('order-items', LiveOrderItems::class);
        Livewire::component('delivery-items', LiveDeliveryItems::class);
        Livewire::component('activity-menu', LiveActivityMenu::class);
        Livewire::component('xero-connect', XeroConnect::class);
        Livewire::component('activities', LiveActivities::class);
        Livewire::component('send-quote', SendQuote::class);
        Livewire::component('invoice-lines', LiveInvoiceLines::class);
        Livewire::component('send-invoice', SendInvoice::class);
        Livewire::component('pay-invoice', PayInvoice::class);
        Livewire::component('product-form', LiveProductForm::class);
        Livewire::component('purchase-order-lines', LivePurchaseOrderLines::class);
        Livewire::component('fields.create-or-edit', CreateOrEdit::class);
        Livewire::component('send-purchase-order', SendPurchaseOrder::class);
        Livewire::component('delivery-details', LiveDeliveryDetails::class);

        if ($this->app->runningInConsole()) {
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);

                $schedule->command('laravelcrm:reminders')
                    ->name('laravelCrmReminders')
                    ->everyMinute()
                    ->withoutOverlapping();

                $schedule->command('laravelcrm:archive')
                    ->name('laravelCrmArchiving')
                    ->daily()
                    ->withoutOverlapping();

                if (config('xero.clientId') && config('xero.clientSecret')) {
                    $schedule->command('xero:keep-alive')
                        ->name('laravelCrmXeroKeepAlive')
                        ->everyFiveMinutes();
                    $schedule->command('laravelcrm:xero contacts')
                        ->name('laravelCrmXeroContacts')
                        ->everyTenMinutes()
                        ->withoutOverlapping();
                    $schedule->command('laravelcrm:xero products')
                        ->name('laravelCrmXeroProducts')
                        ->everyTenMinutes()
                        ->withoutOverlapping();
                }
            });
        }

        View::composer('*', SettingsComposer::class);

        Blade::if('hasleadsenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('leads', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasdealsenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('deals', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasquotesenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('quotes', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasordersenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('orders', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasinvoicesenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('invoices', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasdeliveriesenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('deliveries', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('haspurchaseordersenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('purchase-orders', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });

        Blade::if('hasteamsenabled', function () {
            if(is_array(config('my-crm.modules')) && in_array('teams', config('my-crm.modules'))) {
                return true;
            } elseif(! config('my-crm.modules')) {
                return true;
            }
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/package.php', 'my-crm');
        $this->mergeConfigFrom(__DIR__ . '/../config/my-crm.php', 'my-crm');

        // Register the main class to use with the facade
        $this->app->singleton('my-crm', function () {
            return new LaravelCrm();
        });

        $this->app->register(LaravelCrmEventServiceProvider::class);
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            if (config('my-crm.user_interface')) {
                $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
            }
        });
    }

    protected function routeConfiguration()
    {
        if (config('my-crm.route_subdomain')) {
            $host = explode(".", request()->getHost());
            if (count($host) == 3) { // .com
                $domain = config('my-crm.route_subdomain').'.'.$host[(count($host) - 2)].'.'.end($host);
            } elseif (count($host) == 4) { // .com.au
                $domain = config('my-crm.route_subdomain').'.'.$host[(count($host) - 3)].'.'.$host[(count($host) - 2)].'.'.end($host);
            }
        }

        return [
            'domain' => $domain ?? null,
            'prefix' => (config('my-crm.route_prefix')) ? config('my-crm.route_prefix') : null,
            'middleware' => array_unique(array_merge(['web','crm','crm-api'], config('my-crm.route_middleware') ?? [])),
        ];
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem, $filename, $order): string
    {
        $timestamp = date('Y_m_d_His', strtotime("+$order sec"));

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $filename) {
                return $filesystem->glob($path.'*_'.$filename);
            })->push($this->app->databasePath()."/migrations/{$timestamp}_".$filename)
            ->first();
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies() as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * Get the policies defined on the provider.
     *
     * @return array
     */
    public function policies()
    {
        return $this->policies;
    }
}
