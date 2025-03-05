@can('edit-form')
    @if ($form->json)
        @php
            $hashids = new Hashids('', 20);
            
            $id = $hashids->encodeHex($form->id);
            
        @endphp
        <a class="btn  btn-primary embed_form" href="javascript:void(0)" title="{{ __('Embed form') }}"
            onclick="copyToClipboard('#embed-form-{{ $form->id }}')" id="embed-form-{{ $form->id }}"
            data-url='<iframe src="{{ route('forms.survey', $id) }}" scrolling="auto" align="bottom" style="height:100vh;" width="100%"></iframe>'><i
                class="fa fa-code"></i></a>
        <a class="btn  btn-primary copy_form" onclick="copyToClipboard('#copy-form-{{ $form->id }}')"
            href="javascript:void(0)" title="{{ __('Copy Form URL') }}" id="copy-form-{{ $form->id }}"
            data-url="{{ route('forms.survey', $id) }}"><i class="fa fa-copy"></i></a>
    @endif
@endcan

@can('fill-form')
    @if ($form->json)

        <a class="btn  btn-primary edit_form" href="{{ route('forms.fill', $form->id) }}" title="{{ __('Fill Form') }}"
            id="edit-form" data-action="form/{{ $form->id }}/fill"><i class="fa fa-list"></i></a>
    @endif
@endcan
@can('duplicate-form')
    <a href="#" class="btn  btn-success" data-toggle="tooltip" data-original-title="{{ __('Duplicate') }}"
        onclick="document.getElementById('duplicate-form-{{ $form->id }}').submit();"><i class="far fa-clone"></i></a>
    
@endcan
@can('edit-form')
    <a class="btn  btn-primary edit_form" href="{{ route('forms.design', $form->id) }}" id="edit-form"
        data-action="form/{{ $form->id }}/design"><i class="fa fa-paint-brush"></i></a>
@endcan

@can('edit-form')
    <a class="btn  btn-info edit_form" href="{{ route('forms.edit', $form->id) }}" id="edit-form"
        data-action="form/{{ $form->id }}/edit"><i class="fa fa-edit"></i></a>
@endcan
@can('delete-form')
    <a href="#" class="btn btn-danger delete-action" data-form-id="delete-form-{{ $form->id }}"><i
            class="fas fa-trash mr-0"></i> </a>
    {!! Form::open(['method' => 'DELETE', 'route' => ['forms.destroy', $form->id], 'id' => 'delete-form-' . $form->id]) !!}
    {!! Form::close() !!}
@endcan
@can('duplicate-form') 
    {!! Form::open(['method' => 'POST', 'route' => ['forms.duplicate'], 'id' => 'duplicate-form-' . $form->id]) !!}
    <input type="hidden" value="{{ $form->id }}" name="form_id">
    {!! Form::close() !!}
@endcan