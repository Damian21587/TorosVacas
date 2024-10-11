<?php

namespace App\Providers;

use App\View\Components\Btnlink;
use App\View\Components\BtnlinkAdd;
use App\View\Components\ContentCardTab;
use App\View\Components\ContentIndex;
use App\View\Components\ContentSection;
use App\View\Components\Form;
use App\View\Components\FormCheckbox;
use App\View\Components\FormComboboxDuallistbox;
use App\View\Components\FormCombonum;
use App\View\Components\FormDatefield;
use App\View\Components\FormFileImage;
use App\View\Components\FormNumberspinner;
use App\View\Components\FormTextarea;
use App\View\Components\FormTextemail;
use App\View\Components\FormTextfield;
use App\View\Components\FormTextpassword;
use App\View\Components\FormTexttelephone;
use App\View\Components\TableColumnActions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        $this->registerPolicies();
      //  $this->shareData();
        $this->getComponents();
        $this->getDirectives();
    }

    private function getComponents()
    {
        // Componentes para usar en formularios tales como create, edit
        Blade::component('form', Form::class);
        Blade::component('form-checkbox', FormCheckbox::class);
        Blade::component('form-comboenum', FormCombonum::class);
        Blade::component('form-datefield', FormDatefield::class);
        Blade::component('form-combobox-duallistbox', FormComboboxDuallistbox::class);
        Blade::component('form-file-image', FormFileImage::class);
        Blade::component('form-numberspinner', FormNumberspinner::class);
        Blade::component('form-textarea', FormTextarea::class);
        Blade::component('form-textfield', FormTextfield::class);
        Blade::component('form-textemail', FormTextemail::class);
        Blade::component('form-textpassword', FormTextpassword::class);
        Blade::component('form-texttelephone', FormTexttelephone::class);
        Blade::component('btnlink', Btnlink::class);
        Blade::component('btnlink-add', BtnlinkAdd::class);
        Blade::component('content-index', ContentIndex::class);
        Blade::component('content-card-tab', ContentCardTab::class);
        Blade::component('content-section', ContentSection::class);
        Blade::component('table-column-actions', TableColumnActions::class);
    }

    private function getDirectives()
    {
        /**
         * Make a string's first character uppercase in blade using php function ucfirst.
         *
         * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
         * @version  1.0.0
         */
        Blade::directive('ucfirst', function ($s) {
            return "<?php echo ucfirst(trans($s)); ?>";
        });

        /**
         * Format a date to timestamp.
         *
         * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
         * @version  1.0.0
         */
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
        });

        /**
         * Format a date to DD/MM/YYYY.
         *
         * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
         * @version  1.0.0
         */
        Blade::directive('date', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y'); ?>";
        });

        /**
         * Format a hour to g:i a.
         *
         * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
         * @version  1.0.0
         */
        Blade::directive('hour', function ($expression) {
            return "<?php echo date('g:i a', strtotime($expression)); ?>";
        });

        /**
         * Format a number to currency
         *
         * @author Ing. Miguel Diaz Riveaux <mdriveaux2015@gmail.com>
         * @version  1.0.0
         */
        Blade::directive('currency', function ($money) {
            return "<?php echo '$' . number-format($money, 2); ?>";
        });

        /*Blade::directive('currency-language', function ($money, $lang) {
            $numberFormatter = new \NumberFormatter($lang, \NumberFormatter::CURRENCY);
            $symbol = $numberFormatter->getSymbol(\NumberFormatter::INTL-CURRENCY-SYMBOL); // got USD
            return "<?php echo $numberFormatter->formatCurrency($money, $symbol); ?>";
        });

        Blade::directive('currency-letters', function ($money) {
            $numberFormatter = new \NumberFormatter(config('app.locale'), \NumberFormatter::SPELLOUT);
            return "<?php echo $numberFormatter->format($money); ?>";
        });*/
    }
}
