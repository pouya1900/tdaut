<div id="app">
    <supports-table
        :supports_data="{{json_encode($data)}}" :is_admin="{{isset($admin) ? 1 : 0}}"></supports-table>
</div>
