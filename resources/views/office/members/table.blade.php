<table id="datatable" class="display">
    <thead>
    <tr>
        <th>@lang('trs.name')</th>
        <th>@lang('trs.type')</th>
        <th>@lang('trs.username')</th>
        <th>@lang('trs.gender')</th>
        <th>@lang('trs.role')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($office->members as $member)
        <tr>
            <td>{{$member->profile->fullName}}</td>
            <td>{{\App\Helper::memberType($member->type)}}</td>
            <td>{{$member->profile->username}}</td>
            <td>{{$member->profile->gender}}</td>
            <td>
                @php($i=0)
                @foreach($member->roles as $role)
                    @if ($i)
                        ,
                    @endif
                    {{$role->title}}
                    @php($i++)
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
