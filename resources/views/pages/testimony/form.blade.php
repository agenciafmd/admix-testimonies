<x-page.form
        title="{{ $testimony->exists ? __('Update :name', ['name' => __(config('admix-testimonies.name'))]) : __('Create :name', ['name' => __(config('admix-testimonies.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label
                    for="form.is_active">
                {{ str(__('admix-testimonies::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle
                    name="form.is_active"
                    :large="true"
                    :label-on="__('Yes')"
                    :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.name"
                    :label="__('admix-testimonies::fields.name')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.product"
                    :label="__('admix-testimonies::fields.product')"
            />
        </div>
        <div class="col-md-12 mb-3">
            <x-form.textarea
                    name="form.description"
                    :label="__('admix-testimonies::fields.description')"/>
        </div>
        <div class="col-md-12 mb-3">
            <x-form.image
                    name="form.image"
                    :label="__('admix-testimonies::fields.image')"
                    :cropConfig="[
                        'aspectRatio' => 1,
                    ]"
            />
        </div>
    </div>
    <x-slot:complement>
        @if($testimony->exists)
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.id')"
                        :value="$testimony->id"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.slug')"
                        :value="$testimony->slug"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.created_at')"
                        :value="$testimony->created_at->format(config('admix.timestamp.format'))"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.updated_at')"
                        :value="$testimony->updated_at->format(config('admix.timestamp.format'))"
                />
            </div>
        @endif
    </x-slot:complement>
</x-page.form>
