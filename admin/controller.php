<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\__identifier__;

use Illuminate\View\View;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Helpers\BlueprintExtensionLibrary;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class __identifier__SettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'rname' => 'string|not_regex:/\//',
            'rurl' => 'string|url:http,https',
            'rdel' => 'string',
        ];
    }

    public function attributes(): array
    {
        return [
            'rname' => 'Redirect Name',
            'rurl' => 'Redirect URL',
            'rdel' => 'Redirect to Remove',
        ];
    }
}

class __identifier__ExtensionController extends Controller
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
    if($this->blueprint->dbGet('^#identifier#^', 'rname') == null) {$this->blueprint->dbSet('^#identifier#^', 'rname', '');}
    if($this->blueprint->dbGet('^#identifier#^', 'rurl') == null) {$this->blueprint->dbSet('^#identifier#^', 'rurl', '');}
    if($this->blueprint->dbGet('^#identifier#^', 'rdel') == null) {$this->blueprint->dbSet('^#identifier#^', 'rdel', '');}

    # ADD REDIRECT
    if($this->blueprint->dbGet('^#identifier#^', 'rname') != "" && $this->blueprint->dbGet('^#identifier#^', 'rurl') != "") {
      shell_exec("cd ^#path#^;bash ^#datapath#^/scripts/addRedirect.sh ".$this->blueprint->dbGet('^#identifier#^', 'rname')." ".$this->blueprint->dbGet('^#identifier#^', 'rurl'));
      $this->blueprint->dbSet('^#identifier#^', 'rname', '');
      $this->blueprint->dbSet('^#identifier#^', 'rurl', '');
    };

    # REMOVE REDIRECT
    if($this->blueprint->dbGet('^#identifier#^', 'rdel') != "") {
      shell_exec("cd ^#path#^;bash ^#datapath#^/scripts/removeRedirect.sh ".$this->blueprint->dbGet('^#identifier#^', 'rdel'));
      $this->blueprint->dbSet('^#identifier#^', 'rdel', '');
    };

    # LIST REDIRECTS
    $redirs=shell_exec("cd ^#path#^;bash ^#datapath#^/scripts/listRedirect.sh");
    if($redirs == "") {
      $redirs="You don't have any redirects, time to make one!";
    };

    return $this->view->make(
      'admin.extensions.^#identifier#^.index', [
        'blueprint' => $this->blueprint,
        'redirects' => $redirs,
        'root' => "/admin/extensions/blueprint",
      ]
    );
  }

  /**
   * @throws \Pterodactyl\Exceptions\Model\DataValidationException
   * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
   */
  public function update(__identifier__SettingsFormRequest $request): RedirectResponse
  {
    foreach ($request->normalize() as $key => $value) {
      $this->settings->set('^#identifier#^::' . $key, $value);
    }

    return redirect()->route('admin.extensions.^#identifier#^.index');
  }
}
