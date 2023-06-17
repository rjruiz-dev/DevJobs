{{-- md:w-1/2: centra el formulario en la pantalla no toma todo el ancho --}}
{{-- space-y-5: separa cada div dentro del formulario --}}
{{-- con livewire no se requiere @csrf --}}
{{-- para poder comunicar los datos del form al componente y poderlo enviar utilizar wire:submit.prevent='crearVacante' --}}
<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            {{-- validar con livewire cambiar name por wire:model --}}
            {{-- name="titulo"  --}}
            wire:model="titulo" 
            :value="old('titulo')"  
            placeholder="Título Vacante"
        />   
        {{-- @error('titulo'): es el nombre definido con wire:model="titulo" --}}
        @error('titulo')
            {{-- $message: el error --}}
            {{-- llamando al componente mostrarAlerta --}}
            {{-- pasar el error ":" indica que es un valor dinamico --}}
            <livewire:mostrar-alerta :message="$message" />
        @enderror     
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select 
            id="salario"
            wire:model="salario"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
        >    
            <option>-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id}}">{{ $salario->salario }}</option>
            @endforeach    
        </select>         
        @error('salario')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror 
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select 
            id="categoria"
            wire:model="categoria"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
        >  
        <option>-- Seleccione --</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id}}">{{ $categoria->categoria }}</option>
        @endforeach       
        </select> 
        @error('categoria')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror      
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"  
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        @error('empresa')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror           
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Último dia para postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')"              
        /> 
        @error('ultimo_dia')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror      
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea 
            wire:model="descripcion" 
            placeholder="Descripción general del puesto, experiencia"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72" 
        >
        </textarea>  
        @error('descripcion')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror  
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="imagen"
            accept="image/*"             
        /> 
        
        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen Actual')" />
            {{-- asset: apunta a archivos estaticos --}}
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vacante' . $titulo }}">
        </div>
        {{-- <div class="my-5 w-80">           
            @if ($imagen)
                Imagen:                
                <img src="{{ $imagen->temporaryUrl() }}" >    
            @endif
        </div> --}}

        @error('imagen')           
            <livewire:mostrar-alerta :message="$message" />
        @enderror         
    </div>

    <div>
        <x-primary-button>
            Guardar Cambios
        </x-primary-button>
    </div>

</form>