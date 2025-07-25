<?php

namespace Agenciafmd\Testimonies\Livewire\Pages\Testimony;

use Agenciafmd\Testimonies\Models\Testimony;
use Agenciafmd\Ui\Traits\WithMediaSync;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;

class Component extends LivewireComponent
{
    use AuthorizesRequests, WithFileUploads, WithMediaSync;

    public Form $form;

    public Testimony $testimony;

    public function mount(Testimony $testimony): void
    {
        ($testimony->exists) ? $this->authorize('update', Testimony::class) : $this->authorize('create', Testimony::class);

        $this->testimony = $testimony;
        $this->form->setModel($testimony);
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->testimony->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.testimonies.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix-testimonies::pages.testimony.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }
}
