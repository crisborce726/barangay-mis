<!-- Delete Modal -->
<div class="modal fade" id="ResSecDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title text-white" id="exampleModalLabel">Delete Resident Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <form action="{{ route('delete.res.sec') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE') 
                <h1 class="text-danger text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                </h1>
                    <p class="text-center">
                        Are you sure you want to delete?
                    </p>
                    <input type="text" name="res_id" id="res_id" hidden>
                    <input type="text" name="id" id="id" hidden>
                    <input type="text" name="sector_id" id="sector_id" hidden>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Delete Modal -->