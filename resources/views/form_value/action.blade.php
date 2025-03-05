@can('edit-submitted-form')
    <a href="{{ route('formvalues.edit', $formValue->id) }}" target="_blank" title="{{ __('Edit Survey') }}"
        class="btn btn-info mr-1" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"><i
            class="fas fa-edit mr-0"></i> </a>
@endcan

@can('show-submitted-form')
    <a href="{{ route('formvalues.show', $formValue->id) }}" title="{{ __('View Survey') }}"
        class="btn btn-primary  mr-1" data-toggle="tooltip" data-original-title="{{ __('View') }}"><i
            class="fas fa-eye mr-0"></i> </span></a>
@endcan

@can('download-submitted-form')
    <a href="{{ route('download.form.values.pdf', $formValue->id) }}" title="{{ __('Download PDF') }}"
        class="btn btn-success  mr-1" data-toggle="tooltip" data-original-title="{{ __('Download') }}"><i
            class="fas fa-file-download mr-0"></i></a>
@endcan

@can('delete-submitted-form')
    <a href="#" class="btn btn-danger delete-action" data-form-id="delete-form-{{ $formValue->id }}"><i
            class="fas fa-trash mr-0"></i> </a>
    {!! Form::open(['method' => 'DELETE', 'route' => ['formvalues.destroy', $formValue->id], 'id' => 'delete-form-' . $formValue->id]) !!}
    {!! Form::close() !!}
@endcan
