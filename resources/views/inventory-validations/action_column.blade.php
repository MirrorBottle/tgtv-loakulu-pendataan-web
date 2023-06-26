<div>
  <x-buttons.custom-post
    index-route='{!!route("$module_name.index")!!}'
    route='{!!route("$module_name.confirmed", $data)!!}'
    class='btn-success' 
    icon='flaticon-381-success'
    title="Dikonfirmasi"
    small="true"
  />
  <x-buttons.edit
    route='{!!route("$module_name.edit", $data)!!}'
    icon='flaticon-381-close'
    class='btn-warning'
    title="Ditolak"
    small="true"
  />
</div>
