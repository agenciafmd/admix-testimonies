<?php

use Agenciafmd\Testimonies\Http\Livewire\Pages\Testimony\Form;
use Agenciafmd\Testimonies\Http\Livewire\Pages\Testimony\Index;
use Agenciafmd\Testimonies\Models\Testimony;
use Livewire\Livewire;

it('can render index route of testimonies', function () {
    asAdmix()
        ->get(route('admix.testimonies.index'))
        ->assertOk();
});

it('can see item on index route of testimonies', function () {
    $model = create(Testimony::class);

    asAdmix()
        ->get(route('admix.testimonies.index'))
        ->assertOk()
        ->assertSee($model->name);
});

it('can render create route of testimonies', function () {
    asAdmix()
        ->get(route('admix.testimonies.create'))
        ->assertOk();
});

it('can insert item on create route of testimonies', function () {
    asAdmix();
    $model = make(Testimony::class);

    Livewire::test(Form::class)
        ->set('model.is_active', $model->is_active)
        ->set('model.name', $model->name)
        ->call('submit');

    test()->assertDatabaseHas(table(Testimony::class), [
        'name' => $model->name,
    ]);
});

it('can render and see a item on edit route of testimonies', function () {
    $model = create(Testimony::class);

    asAdmix()
        ->get(route('admix.testimonies.edit', $model))
        ->assertOk()
        ->assertSee($model->name);
});

it('can edit item on edit route of testimonies', function () {
    asAdmix();
    $model = create(Testimony::class);

    Livewire::test(Form::class, ['faq' => $model->id])
        ->set('model.name', $model->name . ' - edited')
        ->call('submit');

    test()->assertDatabaseHas(table(Testimony::class), [
        'name' => $model->name . ' - edited',
    ]);
});

it('can delete item on index route of testimonies', function () {
    asAdmix();
    $model = create(Testimony::class);

    Livewire::test(Index::class)
        ->call('bulkDelete', $model->id);

    test()->assertSoftDeleted(table(Testimony::class), [
        'id' => $model->id,
    ]);
});

it('can render and see a item on trash route of testimonies', function () {
    $model = create(Testimony::class);
    $model->delete();

    asAdmix()
        ->get(route('admix.testimonies.trash'))
        ->assertOk()
        ->assertSee($model->name);
});

it('can restore item on trash route of testimonies', function () {
    asAdmix();

    $model = create(Testimony::class);
    $model->delete();

    Livewire::test(Index::class)
        ->set('isTrash', true)
        ->call('bulkRestore', $model->id);

    test()->assertDatabaseHas(table(Testimony::class), [
        'id' => $model->id,
        'deleted_at' => null,
    ]);
});
