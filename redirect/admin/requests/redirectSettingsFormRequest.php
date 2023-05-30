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
            'placeholder' => 'string',

            'site:html' => 'string',
        ];
    }

    public function attributes(): array
    {
        return [
            'placeholder' => 'placeholder',

            'site:html' => 'Site HTML',
        ];
    }
}