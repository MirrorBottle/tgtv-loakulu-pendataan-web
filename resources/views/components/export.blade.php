<div id="export-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download Laporan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="{{ $endpoint }}">
                <div class="modal-body">
                    @if (in_array('date', $forms))
                        <div class="row">
                            <div class="col-12 mb-3">
                              <p class="mb-1">Date Range Pick</p>
                              <input class="form-control input-daterange-datepicker" type="text"
                                  name="daterange" value="01/01/2015 - 01/31/2015">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btn-sm" type="submit">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>
