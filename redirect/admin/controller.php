<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\bpidentifierreplace;

use Illuminate\View\View;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Helpers\BlueprintExtensionLibrary;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\Http\Requests\Admin\Extensions\landingportal\bpidentifierreplaceSettingsFormRequest;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class bpidentifierreplaceExtensionController extends Controller
{

    /**
     * ^#identifier#^ExtensionController constructor.
     */
    public function __construct(
        private BlueprintExtensionLibrary $blueprint,
    
        private ViewFactory $view,
        private ConfigRepository $config,
        private SettingsRepositoryInterface $settings,
        ) {
    }

    /**
     * Return the admin index view.
     */
    public function index(): View
    {
        #shell_exec("echo ".$this->blueprint->db('get', 'landingportal', 'site:html')." > /var/www/pterodactyl/public/extensions/home/index.html");
        return $this->view->make(
            'admin.extensions.^#identifier#^.index', [
                'blueprint' => $this->blueprint,
                'root' => "/admin/extensions/blueprint",
            ]
        );
    }

    /**
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function update(bpidentifierreplaceSettingsFormRequest $request): RedirectResponse
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('bpidentifierreplace::' . $key, $value);
        }

        return redirect()->route('admin.extensions.^#identifier#^.index');
    }
}