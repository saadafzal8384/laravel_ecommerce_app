<!-- Add Brand Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeBrand">
                <div class="modal-body" style="background: #cccccc; color: #000000;">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Brand Name
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Brand Slug
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Status</label>
                        <input type="checkbox" wire:model.defer="status">
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                        <p>* Checked means Hidden and un-checked means Visible</p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyBrand">
                <div class="modal-body" style="background: #cccccc; color: #000000;">
                   <h5>Do you really want to delete this Brand ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-inverse-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateBrand">
                <div class="modal-body" style="background: #cccccc; color: #000000;">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Brand Name
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Brand Slug
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">
                            Status</label>
                        <input type="checkbox" wire:model.defer="status">
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                        <p>* Checked means Hidden and un-checked means Visible</p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
