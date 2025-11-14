

<div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Update Status Form -->
                <form action="{{ route('admin.propertyAction', $property->id) }}" method="POST" id="propertyActionForm">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered table-hover">
                        <tr class="fw-bolder">
                            <th>Remark:</th>
                            <td>
                                <textarea name="remark" placeholder="Remark" rows="5" class="form-control" required>{{ $property->remark }}</textarea>
                            </td>
                        </tr>
                        <tr class="fw-bolder">
                            <th>Status:</th>
                            <td>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Approved" {{ $property->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Resubmission" {{ $property->status == 'Resubmission' ? 'selected' : '' }}>Resubmission</option>
                                    <option value="Cancelled" {{ $property->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

