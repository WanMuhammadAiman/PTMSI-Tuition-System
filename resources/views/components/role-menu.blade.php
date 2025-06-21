@role('admin')
    <li>
        <a href="{{ route('admin.index') }}" class="hover:text-white">Manage Students</a>
    </li>
    <li>
        <a href="{{ route('admin.subjects.index') }}" class="hover:text-white">Manage Classes</a>
    </li>
@endrole


@role('tutor')
    <li>
        <a href="{{ route('tutor.material-upload') }}" class="hover:text-white">Manage Materials</a>
    </li>
@endrole
