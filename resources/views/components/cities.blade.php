<tr>
    <td scope="row">
        <input class="form-check-input" type="checkbox" value="{{ $user->id }}" modelid="{{ $user->id }}" />
    </td>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->phone }}</td>
    <td>{{ $user->user_type }}</td>

    <td>
        <select class="form-control" title="نوع المستخدم" wire:ignore.self>
            @foreach ($user->branches as $branch)
                <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
            @endforeach
        </select>
    </td>

    <td>
        <div class="switch">
            <label>
                نشط
                <input type="checkbox" wire:click="status({{ $user->id }})" {{ $user->user_status == 'active' ? 'checked' : '' }}>
                <span class="lever"></span>
                غير نشط
            </label>
        </div>
    </td>

    <td>
        <div class="d-flex justify-content-between">

            <a type="button" class="btn-sm text-danger  fa-lg delete" modelid="{{ $user->id }}" title="Delete">
                <i class="fas fa-trash-can"></i>
            </a>

            <a type="button" class="btn-sm text-primary fa-lg edit" href="#" data-toggle="modal"
                data-target="#create-edit-user" modelid="{{ $user->id }}" title="Edit">
                <i class="far fa-pen-to-square"></i>
            </a>

            <a type="button" class="btn-sm text-primary fa-lg" href="#modelid" modelid="{{ $user->id }}"
                title="Show">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </td>
</tr>
