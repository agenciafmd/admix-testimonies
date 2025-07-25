<?php

namespace Agenciafmd\Testimonies\Livewire\Pages\Testimony;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Testimonies\Models\Testimony;

class Index extends BaseIndex
{
    protected $model = Testimony::class;

    protected string $indexRoute = 'admix.testimonies.index';

    protected string $trashRoute = 'admix.testimonies.trash';

    protected string $creteRoute = 'admix.testimonies.create';

    protected string $editRoute = 'admix.testimonies.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix-testimonies.name'));

        parent::configure();
    }
}
