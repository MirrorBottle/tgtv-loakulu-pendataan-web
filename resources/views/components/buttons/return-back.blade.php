@props(["small"=>""])

<button type="button" class="btn btn-secondary {{($small=='true')? 'btn-sm' : ''}}" onclick="history.back(-1)"><i class="fa fa-reply"></i> Kembali</button>