<?php

namespace Pterodactyl\Http\Requests\Admin\Extensions\bpidentifierreplace;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class bpidentifierreplaceSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'rname' => 'string',
            'rurl' => 'string',
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