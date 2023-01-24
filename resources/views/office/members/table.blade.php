<div id="app">
    <members-table
        :members_data="{{json_encode($data)}}"
        :super_user="{{$current_member->isSuperAdmin($office->id) ? 1 : 0}}"></members-table>
</div>
