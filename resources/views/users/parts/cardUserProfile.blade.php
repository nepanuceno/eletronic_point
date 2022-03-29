<div class="row">
    <div class="col-md-6 mx-auto">
        <input type="file" name="image" id="image-file" class="image d-none d-print-block">

        <x-adminlte-profile-widget name="{{ $user->name }}" desc="{{ $user->getRoleNames()->first() }}" theme="info"
            img="{{ $user->adminlte_image() }}" footer-class="bg-gradient-dark" header-class="text-center">

            <x-adminlte-profile-col-item id='profile-user-image' style="cursor: pointer;" class="border-right button one" icon="fas fa-2x fa-portrait" text="Alterar Foto" badge="purple" size=6/>
            <x-adminlte-profile-col-item class="button one" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" style="cursor: pointer;" icon="fas fa-2x fa-key" text="Altear Senha" badge="purple" size=6/>

            @if(count($user->getRoleNames()) > 1)
                <x-adminlte-profile-row-item icon="fas fa-tags" title="{{ __('users.label_roles') }}" class="text-cente 1r border-bottom border-secondary"/>
            @endif

            @foreach($user->getRoleNames() as $key=>$v)
                @if($key > 1)
                    <x-adminlte-profile-col-item text="{{ $v }}" badge="info" size=2/>
                @endif
            @endforeach
        </x-adminlte-profile-widget>
    </div>
</div>
