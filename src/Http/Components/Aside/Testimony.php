<?php

namespace Agenciafmd\Testimonies\Http\Components\Aside;

use Agenciafmd\Testimonies\Models\Testimony as TestimonyModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;

class Testimony extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public string $url = '',
        public bool $active = false,
        public bool $visible = false,
    ) {}

    public function render(): View
    {
        $this->icon = __(config('admix-testimonies.icon'));
        $this->label = __(config('admix-testimonies.name'));
        $this->url = route('admix.testimonies.index');
        $this->active = request()?->currentRouteNameStartsWith('admix.testimonies');
        $this->visible = Gate::allows('view', TestimonyModel::class);

        return view('admix::components.aside.item');
    }
}
