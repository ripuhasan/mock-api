    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <form action="{{ route($info->route_destroy, $row->id) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
          <div class="modal-content">
              <div class="modal-body text-center">
                  <h5 class="modal-title" id="deleteModalLabel">{{ __('default.are_you_sure') }}</h5>
                  <p class="text-danger mt-2">{{ __('default.you_want_to_delete_this') }}</p>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">{{ __('default.btn_confirm') }}</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('default.btn_close') }}</button>
              </div>
          </div><!-- /.modal-content -->
        </form>
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->